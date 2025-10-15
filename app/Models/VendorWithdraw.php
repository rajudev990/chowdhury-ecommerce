<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorWithdraw extends Model
{
    protected $guarded = [];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class,'vendor_id');
    }
}
