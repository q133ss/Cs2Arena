<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ApiService
{
    private int $timeout;
    private int $cacheTtl;

    public function __construct(int $timeout = 2, int $cacheTtl = 10)
    {
        $this->timeout = $timeout;
        $this->cacheTtl = $cacheTtl;
    }

    /**
     * Получаем информацию о всех серверах с кэшированием
     */
    public function getServersWithInfo(array $servers): array
    {
        return array_map(function($server) {
            $addressParts = explode(':', $server['ip_address']);
            $ip = $addressParts[0];
            $port = $addressParts[1] ?? 27015;

            $cacheKey = $this->getCacheKey($server['id']);

            try {
                return Cache::remember($cacheKey, $this->cacheTtl, function () use ($ip, $port, $server) {
                    $info = $this->getSingleServerInfo($ip, $port);

                    return array_merge($server, [
                        'server_info' => $info,
                        'online' => !empty($info),
                        'current_players' => $info['players'] ?? 0,
                        'current_map' => $info['map'] ?? null,
                    ]);
                });
            } catch (\Exception $e) {
                Log::error("Ошибка кэширования информации о сервере CS2 {$ip}:{$port}: " . $e->getMessage());

                // Возвращаем сервер с признаком оффлайн-статуса
                return array_merge($server, [
                    'server_info' => null,
                    'online' => false,
                    'current_players' => 0,
                    'current_map' => null,
                ]);
            }
        }, $servers);
    }

    /**
     * Получаем информацию об одном сервере
     */
    private function getSingleServerInfo(string $ip, int $port): ?array
    {
        try {
            $socket = @fsockopen(
                "udp://" . $ip,
                $port,
                $errno,
                $errstr,
                $this->timeout
            );

            if (!$socket) {
                Log::error("Не удалось подключиться к серверу CS2 {$ip}:{$port} - {$errstr} ({$errno})");
                return null;
            }

            stream_set_timeout($socket, $this->timeout);
            stream_set_blocking($socket, true);

            $challengeToken = $this->sendInfoRequest($socket);
            if ($challengeToken !== null) {
                return $this->parseServerInfo($this->sendChallengeRequest($socket, $challengeToken));
            }

            fclose($socket);
            return null;
        } catch (\Exception $e) {
            Log::error("Ошибка при получении информации о сервере CS2 {$ip}:{$port}: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Генерируем ключ для кэша
     */
    private function getCacheKey(string $id): string
    {
        return "cs2_server_{$id}_info";
    }

    /**
     * Отправляем запрос A2S_INFO
     *
     * @param resource $socket
     * @return string|null
     */
    private function sendInfoRequest($socket): ?string
    {
        // Запрос A2S_INFO с заголовком "Source Engine Query"
        $packet = "\xFF\xFF\xFF\xFF\x54Source Engine Query\x00";
        fwrite($socket, $packet);

        $response = fread($socket, 4096);

        if ($response === false || strlen($response) < 4) {
            return null;
        }

        // Проверяем, является ли ответ challenge-запросом
        if (substr($response, 0, 5) === "\xFF\xFF\xFF\xFF\x41") {
            return substr($response, 5, 4);
        }

        return null;
    }

    /**
     * Отправляем challenge-запрос
     *
     * @param resource $socket
     * @param string $challengeToken
     * @return string|null
     */
    private function sendChallengeRequest($socket, string $challengeToken): ?string
    {
        $packet = "\xFF\xFF\xFF\xFF\x54Source Engine Query\x00" . $challengeToken;
        fwrite($socket, $packet);

        $response = fread($socket, 4096);
        return $response !== false ? $response : null;
    }

    /**
     * Парсим информацию о сервере
     *
     * @param string|null $response
     * @return array|null
     */
    private function parseServerInfo(?string $response): ?array
    {
        if (!$response || strlen($response) < 20) {
            return null;
        }

        // Пропускаем заголовок (0xFF 0xFF 0xFF 0xFF 0x49)
        $offset = 6;

        // Получаем информацию о сервере
        $serverInfo = [
            'protocol' => ord($response[$offset++]),
            'name' => $this->parseString($response, $offset),
            'map' => $this->parseString($response, $offset),
            'folder' => $this->parseString($response, $offset),
            'game' => $this->parseString($response, $offset),
            'id' => ord($response[$offset++]) | (ord($response[$offset++]) << 8),
            'players' => ord($response[$offset++]),
            'max_players' => ord($response[$offset++]),
            'bots' => ord($response[$offset++]),
            'server_type' => $this->getServerType(ord($response[$offset++])),
            'environment' => $this->getEnvironment(ord($response[$offset++])),
            'visibility' => ord($response[$offset++]),
            'vac' => ord($response[$offset++]),
        ];

        // Для CS2 может быть дополнительная информация
        if ($offset < strlen($response)) {
            $serverInfo['version'] = $this->parseString($response, $offset);
        }

        return $serverInfo;
    }

    /**
     * Парсим строку из ответа
     *
     * @param string $response
     * @param int &$offset
     * @return string
     */
    private function parseString(string $response, int &$offset): string
    {
        $string = '';
        while ($offset < strlen($response) && $response[$offset] !== "\x00") {
            $string .= $response[$offset++];
        }
        $offset++; // Пропускаем null-terminator
        return $string;
    }

    /**
     * Получаем тип сервера
     *
     * @param int $type
     * @return string
     */
    private function getServerType(int $type): string
    {
        return match ($type) {
            'd' => 'Dedicated',
            'l' => 'Non-dedicated',
            'p' => 'SourceTV',
            default => 'Unknown',
        };
    }

    /**
     * Получаем окружение сервера
     *
     * @param int $env
     * @return string
     */
    private function getEnvironment(int $env): string
    {
        return match ($env) {
            'l' => 'Linux',
            'w' => 'Windows',
            'm' => 'Mac',
            default => 'Unknown',
        };
    }
}
