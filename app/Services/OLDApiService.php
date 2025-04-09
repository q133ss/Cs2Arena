<?php

namespace App\Services;

class OLDApiService
{
    private string $serverIp;
    private int $serverPort;
    private int $timeout;

    public function __construct(string $ip, int $port = 27015, int $timeout = 2)
    {
        $this->serverIp = $ip;
        $this->serverPort = $port;
        $this->timeout = $timeout;
    }

    /**
     * Получаем информацию о сервере
     *
     * @return array|null
     */
    public function getServerInfo(): ?array
    {
        try {
            $socket = @fsockopen(
                "udp://" . $this->serverIp,
                $this->serverPort,
                $errno,
                $errstr,
                $this->timeout
            );

            if (!$socket) {
                Log::error("Не удалось подключиться к серверу CS2: {$errstr} ({$errno})");
                return null;
            }

            stream_set_timeout($socket, $this->timeout);
            stream_set_blocking($socket, true);

            // Отправляем запрос A2S_INFO
            $challengeToken = $this->sendInfoRequest($socket);
            if ($challengeToken !== null) {
                return $this->parseServerInfo($this->sendChallengeRequest($socket, $challengeToken));
            }

            fclose($socket);
            return null;
        } catch (Exception $e) {
            Log::error("Ошибка при получении информации о сервере CS2: " . $e->getMessage());
            return null;
        }
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
