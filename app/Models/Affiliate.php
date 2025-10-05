<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Affiliate extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'affiliate'; // custom guard

    protected $fillable = [
        'fname', 'lname', 'email', 'phone', 'username', 'password',
        'website_url', 'social_media_link', 'promotion_method', 'referal_name_id','image', 'status'
    ];

    protected $hidden = ['password', 'remember_token'];
}
