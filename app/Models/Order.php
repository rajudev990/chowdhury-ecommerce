<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            // যদি order_id আগে সেট না করা থাকে
            if (empty($order->order_id)) {
                $lastOrder = self::orderBy('id', 'desc')->first();
                if ($lastOrder) {
                    $lastId = (int) $lastOrder->order_id;
                    $order->order_id = $lastId + 1;
                } else {
                    $order->order_id = 10000; // 👈 প্রথম order শুরু হবে 10000 থেকে
                }
            }
        });
    }

    public function vendors()
    {
        return $this->belongsToMany(Vendor::class, 'order_items', 'order_id', 'vendor_id');
    }
}
