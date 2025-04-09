<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class SteamController extends Controller
{
    public function login()
    {
        try {
            // Формируем параметры без кодирования realm
            $realm = url('/'); // Должен совпадать с доменом в Steamworks
            $returnTo = url('/steam/callback');

            $params = [
                'openid.ns'         => 'http://specs.openid.net/auth/2.0',
                'openid.mode'       => 'checkid_setup',
                'openid.return_to'  => $returnTo,
                'openid.realm'      => $realm,
                'openid.identity'   => 'http://specs.openid.net/auth/2.0/identifier_select',
                'openid.claimed_id' => 'http://specs.openid.net/auth/2.0/identifier_select',
            ];

            // Правильное кодирование только нужных параметров
            $steamLoginUrl = 'https://steamcommunity.com/openid/login?'.http_build_query($params, '', '&', PHP_QUERY_RFC3986);

            Log::debug('Steam Auth Redirect', [
                'realm' => $realm,
                'return_to' => $returnTo,
                'final_url' => $steamLoginUrl
            ]);

            return redirect()->away($steamLoginUrl);

        } catch (\Exception $e) {
            Log::error('Login Redirect Error', ['error' => $e->getMessage()]);
            return redirect('/')->with('error', 'Ошибка перенаправления');
        }
    }

    public function callback(Request $request)
    {
        try {
            Log::debug('Steam Callback Received', $request->all());

            // Проверяем обязательные параметры
            $requiredParams = [
                'openid_assoc_handle',
                'openid_claimed_id',
                'openid_identity',
                'openid_return_to',
                'openid_response_nonce',
                'openid_assoc_handle',
                'openid_signed',
                'openid_sig',
                'openid_op_endpoint',
            ];

            foreach ($requiredParams as $param) {
                if (!$request->has($param)) {
                    Log::error('Missing Parameter', ['param' => $param]);
                    return redirect('/')->with('error', 'Недостаточно данных для аутентификации');
                }
            }

            // Формируем параметры для проверки
            $params = [
                'openid.ns'         => 'http://specs.openid.net/auth/2.0',
                'openid.mode'       => 'check_authentication',
                'openid.assoc_handle' => $request->openid_assoc_handle,
                'openid.signed'     => $request->openid_signed,
                'openid.sig'        => $request->openid_sig,
                'openid.op_endpoint' => $request->openid_op_endpoint,
                'openid.claimed_id' => $request->openid_claimed_id,
                'openid.identity'   => $request->openid_identity,
                'openid.return_to'  => $request->openid_return_to,
            ];

            // Добавляем подписанные параметры
            $signed = explode(',', $request->openid_signed);
            foreach ($signed as $item) {
                $paramName = "openid_$item";
                if ($request->has($paramName)) {
                    $params["openid.$item"] = $request->$paramName;
                }
            }

            Log::debug('Validation Request Params', $params);

            // Отправляем запрос
            $response = Http::asForm()
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                    'Accept' => 'text/html'
                ])
                ->timeout(15)
                ->post('https://steamcommunity.com/openid/login', $params);

            Log::debug('Steam Validation Response', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            if ($response->successful() && str_contains($response->body(), 'is_valid:true')) {
                return $this->handleSuccessfulAuth($request);
            }

            return $this->handleFailedAuth($response);

        } catch (\Exception $e) {
            Log::error('Auth Process Failed', ['error' => $e->getMessage()]);
            return redirect('/')->with('error', 'Ошибка аутентификации');
        }
    }

    private function handleSuccessfulAuth(Request $request)
    {
        $steamId = $this->extractSteamId($request->openid_claimed_id);

        if (!$steamId) {
            Log::error('Invalid SteamID', ['claimed_id' => $request->openid_claimed_id]);
            return redirect('/')->with('error', 'Неверный формат SteamID');
        }

        try {
            // Получаем данные профиля из Steam API (если нужно)
            $steamProfile = $this->getSteamProfile($steamId);

            $user = User::firstOrCreate(
                ['steam_id' => $steamId],
                [
                    'username' => $steamProfile['personaname'] ?? 'SteamUser_'.$steamId,
                    'avatar_url' => $steamProfile['avatarfull'] ?? 'https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/fe/fef49e7fa7e1997310d705b2a6158ff8dc1cdfeb.jpg',
                    'social_links' => json_encode([
                        'steam' => $steamProfile['profileurl'] ?? "https://steamcommunity.com/profiles/{$steamId}"
                    ]),
                    'country' => $steamProfile['loccountrycode'] ?? null,
                    'email' => null, // Steam не предоставляет email по умолчанию
                    'cw_count' => 0,
                    'cw_wins' => 0,
                    'cw_losses' => 0,
                    'mix_count' => 0,
                    'mix_wins' => 0,
                    'mix_losses' => 0,
                    'total_matches' => 0,
                    'rank_mix' => 0,
                    'rank_cw' => 0,
                    'is_deleted' => false,
                    'remember_token' => null
                ]
            );

            Auth::login($user, true);
            return to_route('profile.index')->with('success', 'Успешный вход!');

        } catch (\Exception $e) {
            Log::error('User Creation Failed', ['error' => $e->getMessage()]);
            return redirect('/')->with('error', 'Ошибка создания пользователя');
        }
    }

    protected function getSteamProfile($steamId)
    {
        $apiKey = env('STEAM_API_KEY');
        if (!$apiKey) {
            return [];
        }

        try {
            $response = Http::get('https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/', [
                'key' => $apiKey,
                'steamids' => $steamId
            ]);

            return $response->json()['response']['players'][0] ?? [];
        } catch (\Exception $e) {
            Log::error('Steam API Error', ['error' => $e->getMessage()]);
            return [];
        }
    }

    private function extractSteamId(string $claimedId): ?string
    {
        if (preg_match('/^https?:\/\/steamcommunity\.com\/openid\/id\/(\d+)$/', $claimedId, $matches)) {
            return $matches[1];
        }
        return null;
    }

    private function handleFailedAuth($response)
    {
        $errorMessage = 'Неизвестная ошибка аутентификации';

        if ($response->status() === 400) {
            $errorMessage = 'Неверные параметры запроса';
        } elseif (str_contains($response->body(), 'is_valid:false')) {
            $errorMessage = 'Недействительная подпись запроса';
        }

        Log::error('Steam Auth Failed', [
            'status' => $response->status(),
            'error' => $errorMessage,
            'response' => substr($response->body(), 0, 500)
        ]);

        return redirect('/')->with('error', $errorMessage);
    }
}
