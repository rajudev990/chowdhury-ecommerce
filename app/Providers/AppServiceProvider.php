<?php

namespace App\Providers;

use App\Models\Smtp;
use App\Models\SslCommerc;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Blade::if('anycan', function (...$permissions) {
            $user = Auth::guard('admin')->user();
            foreach ($permissions as $permission) {
                if ($user && $user->can($permission)) {
                    return true;
                }
            }
            return false;
        });


        // SSLCommerz config load from DB
        $ssl = SslCommerc::first();

        if ($ssl) {
            config([
                'sslcommerz.store_id'       => $ssl->sslcz_store_id,
                'sslcommerz.store_password' => $ssl->sslcz_store_password,
                'sslcommerz.is_live'        => $ssl->sslcommerz_sandbox === 'live' ? true : false,
            ]);
        }

         // SSLCommerz config load from DB
        $smtp = Smtp::first();

        if ($smtp) {
            config([
                'mail.mail_mailer' => $smtp->mail_mailer,
                'mail.mail_host' => $smtp->mail_host,
                'mail.mail_port' => $smtp->mail_port,
                'mail.mail_username' => $smtp->mail_username,
                'mail.mail_password' => $smtp->mail_password,
                'mail.mail_encryption' => $smtp->mail_encryption,
                'mail.mail_from_address' => $smtp->mail_from_address,
                'mail.mail_from_name' => $smtp->mail_from_name,
            ]);
        }




    }
}
