<?php 

namespace App\Services\Couriers;

use Illuminate\Support\Facades\Http;

class SteadfastService implements CourierInterface
{
    protected $base;
    public function __construct()
    {
        $this->base = env('STEADFAST_BASE_URL');
    }

    public function createShipment(array $payload): array
    {
        $res = Http::withHeaders([
            'API-KEY' => env('STEADFAST_API_KEY'),
            'API-SECRET' => env('STEADFAST_API_SECRET'),
        ])->post($this->base . '/create-parcel', $payload);

        if ($res->successful()) {
            $json = $res->json();
            return [
                'success' => true,
                'tracking_id' => $json['data']['tracking_id'] ?? null,
                'raw' => $json,
            ];
        }

        return ['success' => false, 'raw' => $res->json()];
    }

    public function trackShipment(string $trackingId): array
    {
        $res = Http::withHeaders([
            'API-KEY' => env('STEADFAST_API_KEY'),
        ])->get($this->base . "/track/{$trackingId}");
        return ['success' => $res->successful(), 'raw' => $res->json()];
    }
}
