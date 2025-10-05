<?php

namespace App\Providers;

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
        
        // বাংলা সংখ্যায় রূপান্তরের Blade directive
        Blade::directive('bnDate', function ($expression) {
            return "<?php
            \$engToBn = ['0'=>'০','1'=>'১','2'=>'২','3'=>'৩','4'=>'৪','5'=>'৫','6'=>'৬','7'=>'৭','8'=>'৮','9'=>'৯'];
            \$date = \\Carbon\\Carbon::parse($expression)->locale('bn')->isoFormat('D MMMM YYYY');
            echo str_replace(array_keys(\$engToBn), array_values(\$engToBn), \$date);
        ?>";
        });

        Blade::if('anycan', function (...$permissions) {
            $user = auth()->user();
            foreach ($permissions as $permission) {
                if ($user && $user->can($permission)) {
                    return true;
                }
            }
            return false;
        });
    }
}
