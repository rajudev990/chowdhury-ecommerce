<?php 

namespace App\Services\Couriers;

interface CourierInterface
{
    public function createShipment(array $payload): array; // create order -> returns ['success'=>bool,'tracking_id'=>..., 'raw'=>...]
    public function trackShipment(string $trackingId): array;
}
