<?php


use App\Http\Controllers\HomeController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\SslCommerzPaymentController;

Route::get('auth/{provider}', [WebsiteController::class, 'redirect'])->name('social.redirect');
Route::get('auth/{provider}/callback', [WebsiteController::class, 'callback'])->name('social.callback');


Route::get('/cmd', function () {
    Artisan::call('storage:link');
    Artisan::call('optimize:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    return 'Done';
});




// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index'])->name('pay');
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);


Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END



Route::get('/', [WebsiteController::class, 'index'])->name('index');
Route::get('/products', [WebsiteController::class, 'products'])->name('products');
Route::get('/product/{slug}', [WebsiteController::class, 'productSingle'])->name('product.single');

Route::get('/product/{slug}/{affiliate_id}', [WebsiteController::class, 'productSingleAffiliate'])->name('product.show');

Route::get('/checkout', [WebsiteController::class, 'checkout'])->name('checkout');
Route::post('/order-store', [WebsiteController::class, 'orderStore'])->name('order.store');
Route::get('categories/{slug}', [WebsiteController::class, 'categories'])->name('categories');
Route::get('/live-search', [WebsiteController::class, 'liveSearch'])->name('product.liveSearch');
Route::post('/coupon/validate', [WebsiteController::class, 'validateCoupon'])->name('coupon.validate');

// Track Order
Route::get('/track-order', [WebsiteController::class, 'trackorder'])->name('track.order');
Route::get('/success/{order_id}', [WebsiteController::class, 'orderSuccess'])->name('order.success');



Route::get('/reviews', [WebsiteController::class, 'reviews'])->name('reviews');
Route::get('/contacts', [WebsiteController::class, 'contacts'])->name('contacts');
Route::post('/contacts-store', [WebsiteController::class, 'contactStore'])->name('contact.store');


Auth::routes(); // ✅ Removed ['verify' => true]



// User Dashboard
Route::middleware(['auth', 'no.admin'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('settings', [HomeController::class, 'settings'])->name('user.settings');
    Route::get('profile', [HomeController::class, 'profile'])->name('user.profile');
    Route::get('profile/edit', [HomeController::class, 'profileEdit'])->name('user.profile.edit');
    Route::put('/profile/update', [HomeController::class, 'update'])->name('user.profile.update');
    Route::get('password/edit', [HomeController::class, 'passwordEdit'])->name('user.password.edit');
    Route::post('/password-update', [HomeController::class, 'updatePassword'])->name('user.password.update');
    Route::post('/wishlist/add', [WishlistController::class, 'store'])->name('wishlist.store');
    Route::get('/wishlist/list', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::get('/order/list', [WishlistController::class, 'Orderindex'])->name('order.index');
    Route::get('/order/view/{id}', [WishlistController::class, 'orderView'])->name('order.view');
});

require __DIR__.'/admin.php';
require __DIR__.'/vendor.php';
require __DIR__.'/affiliate.php';




// php artisan migrate:refresh --path=database/migrations/22025_10_05_153148_create_categories_table.php
