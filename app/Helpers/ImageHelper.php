<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageHelper
{
    public static function uploadImage($image, $folder = 'uploads')
    {
        if ($image && $image->isValid()) {
            $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs($folder, $imageName, 'public');
            return $imagePath;
        }

        return null;
    }
}
