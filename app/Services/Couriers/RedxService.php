<?php 

namespace App\Services\Couriers;

use Illuminate\Support\Facades\Http;

class RedxService implements CourierInterface
{
    protected $base;

    public function __construct()
    {
        $this->base = env('REDX_BASE_URL');
    }

    public function createShipment(array $payload): array
    {
        // Example: RedX OpenAPI expects store creation / parcel create endpoints.
        $res = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('REDX_API_TOKEN'),
            'Accept' => 'application/json',
        ])->post($this->base . '/parcel/create', $payload);

        if ($res->successful()) {
            $json = $res->json();
            return [
                'success' => true,
                'tracking_id' => $json['data']['tracking_id'] ?? $json['data']['parcel_id'] ?? null,
                'raw' => $json,
            ];
        }

        return ['success' => false, 'raw' => $res->json()];
    }

    public function trackShipment(string $trackingId): array
    {
        $res = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('REDX_API_TOKEN'),
        ])->get($this->base . "/parcel/track/{$trackingId}");

        return ['success' => $res->successful(), 'raw' => $res->json()];
    }
}
