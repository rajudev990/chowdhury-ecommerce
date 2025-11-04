<?php

namespace App\Services\Couriers;

use Illuminate\Support\Facades\Http;

class PathaoService implements CourierInterface
{
    protected $base;
    protected $clientId;
    protected $clientSecret;
    protected $username;
    protected $password;

    public function __construct()
    {
        $this->base = config('services.pathao.base') ?: env('PATHAO_BASE_URL');
        $this->clientId = env('PATHAO_CLIENT_ID');
        $this->clientSecret = env('PATHAO_CLIENT_SECRET');
        $this->username = env('PATHAO_USERNAME');
        $this->password = env('PATHAO_PASSWORD');
    }

    protected function getToken()
    {
        $res = Http::asForm()->post($this->base . '/aladdin/api/v1/issue-token', [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'username' => $this->username,
            'password' => $this->password,
            'grant_type' => 'password',
        ]);

        if ($res->successful() && isset($res->json()['access_token'])) {
            return $res->json()['access_token'];
        }
        return null;
    }

    public function createShipment(array $payload): array
    {
        $token = $this->getToken();
        if (!$token) {
            return ['success' => false, 'message' => 'Token error'];
        }

        // payload mapping — Pathao expects certain fields (store_id, receiver_name, phone, address, city, zone or full_address in newer APIs)
        $body = [
            'store_id' => $payload['store_id'] ?? env('PATHAO_STORE_ID'),
            'receiver_name' => $payload['receiver_name'],
            'receiver_phone' => $payload['receiver_phone'],
            'receiver_address' => $payload['receiver_address'],
            'delivery_type' => $payload['delivery_type'] ?? 48,
            'item_type' => $payload['item_type'] ?? 1,
            'amount_to_collect' => $payload['amount_to_collect'] ?? 0,
            'item_description' => $payload['item_description'] ?? 'goods',
        ];

        // New Pathao feature: can accept full_address; if available pass that instead of city/zone.
        if (!empty($payload['full_address'])) {
            $body['full_address'] = $payload['full_address'];
        } else {
            $body['receiver_city'] = $payload['receiver_city'] ?? null;
            $body['receiver_zone'] = $payload['receiver_zone'] ?? null;
            $body['receiver_area'] = $payload['receiver_area'] ?? null;
        }

        $res = Http::withToken($token)->post($this->base . '/aladdin/api/v1/orders', $body);

        $json = $res->json();

        if ($res->successful() && isset($json['data']['order_id'])) {
            // response structure may vary: adjust as per real response
            return [
                'success' => true,
                'tracking_id' => $json['data']['order_id'] ?? null,
                'raw' => $json,
            ];
        }

        return [
            'success' => false,
            'message' => $json['message'] ?? 'Pathao error',
            'raw' => $json,
        ];
    }

    public function trackShipment(string $trackingId): array
    {
        $token = $this->getToken();
        if (!$token) return ['success' => false, 'message' => 'Token error'];

        $res = Http::withToken($token)->get($this->base . "/aladdin/api/v1/orders/track/{$trackingId}");
        return ['success' => $res->successful(), 'raw' => $res->json()];
    }
}
