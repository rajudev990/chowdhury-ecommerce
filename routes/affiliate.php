<?php


use App\Http\Controllers\Affiliate\AffiliateAuthController;
use App\Http\Controllers\Affiliate\AffiliateController;
use Illuminate\Support\Facades\Route;




// Affiliate Registration & Login
Route::get('affiliate/register', [AffiliateAuthController::class, 'showRegister'])->name('affiliate.register');
Route::post('affiliate/register', [AffiliateAuthController::class, 'register'])->name('affiliate.register.submit');

// Affiliate Dashboard
Route::prefix('affiliate')->name('affiliate.')->group(function () {

    Route::get('login', [AffiliateAuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AffiliateAuthController::class, 'login'])->name('login.submit');
    Route::post('logout', [AffiliateAuthController::class, 'logout'])->name('logout');

    Route::middleware('auth:affiliate')->group(function () {
        Route::get('dashboard', [AffiliateController::class, 'dashboard'])->name('dashboard');
        Route::get('settings', [AffiliateController::class, 'settings'])->name('affiliate.settings');
        Route::get('profile', [AffiliateController::class, 'profile'])->name('affiliates.profile');
        Route::get('profile/edit', [AffiliateController::class, 'profileEdit'])->name('affiliate.profile.edit');
        Route::put('/profile/update', [AffiliateController::class, 'update'])->name('profile.update');
        Route::get('/change-password', [AffiliateController::class, 'passwordEdit'])->name('password.edit');
        Route::post('/password-update', [AffiliateController::class, 'updatePassword'])->name('password.update');

        Route::get('offers', [AffiliateController::class, 'offers'])->name('offers');
        Route::get('earnings', [AffiliateController::class, 'earnings'])->name('earnings');
        Route::get('withdraw', [AffiliateController::class, 'withdraw'])->name('withdraw');
        // Route to show the withdrawal request page
        Route::get('/withdraw-create', [AffiliateController::class, 'showWithdrawPage'])->name('withdraw.create');
        Route::post('/withdraw-store', [AffiliateController::class, 'storeWithdraw'])->name('withdraw.store');


    });
});
