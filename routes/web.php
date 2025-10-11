<?php


use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\BannarController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\SmtpController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\SubSubCategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WebController;
use App\Http\Controllers\Affiliate\AffiliateAuthController;
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
Route::get('/checkout', [WebsiteController::class, 'checkout'])->name('checkout');
Route::post('/order-store', [WebsiteController::class, 'orderStore'])->name('order.store');
Route::get('categories/{slug}', [WebsiteController::class, 'categories'])->name('categories');
Route::get('/live-search', [WebsiteController::class, 'liveSearch'])->name('product.liveSearch');
Route::post('/coupon/validate', [WebsiteController::class, 'validateCoupon'])->name('coupon.validate');

// Track Order
Route::get('/track-order', [WebsiteController::class, 'trackorder'])->name('track.order');


Route::get('/reviews', [WebsiteController::class, 'reviews'])->name('reviews');
Route::get('/contacts', [WebsiteController::class, 'contacts'])->name('contacts');
Route::post('/contacts-store', [WebsiteController::class, 'contactStore'])->name('contact.store');


// Registration & Login
Route::get('affiliate/register', [AffiliateAuthController::class, 'showRegister'])->name('affiliate.register');
Route::post('affiliate/register', [AffiliateAuthController::class, 'register'])->name('affiliate.register.submit');

Route::get('affiliate/login', [AffiliateAuthController::class, 'showLogin'])->name('affiliate.login');
Route::post('affiliate/login', [AffiliateAuthController::class, 'login'])->name('affiliate.login.submit');

Route::middleware('auth:affiliate')->group(function () {
    Route::get('affiliate/dashboard', [AffiliateAuthController::class, 'dashboard'])->name('affiliate.dashboard');
    Route::post('affiliate/logout', [AffiliateAuthController::class, 'logout'])->name('affiliate.logout');
});


Auth::routes(); // ✅ Removed ['verify' => true]

Route::middleware(['auth', 'no.admin'])->group(function () {

    // Route::get('/home', function () {
    //     return view('home');
    // })->name('home');

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




// Admin Auth
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login.form');
Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.login');
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');


Route::prefix('admin')
    // ->middleware(['auth:admin', 'admin.only', 'role:super-admin'])
    ->middleware(['auth:admin', 'admin.only', 'admin.has.role'])
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminProfileController::class, 'dashboard'])->name('dashboard');
        // Route::get('/dashboard', function () {
        //     return view('admin.dashboard');
        // })->name('dashboard');

        Route::get('/profile/settings', [AdminProfileController::class, 'settings'])->name('profile.settings');
        Route::put('/profile/settings', [AdminProfileController::class, 'updateSettings'])->name('profile.settings.update');

        Route::get('/change-password', [AdminProfileController::class, 'changePassword'])->name('change.password');
        Route::put('/change-password', [AdminProfileController::class, 'updatePassword'])->name('change.password.update');


        Route::resource('settings', SettingController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);

        Route::resource('products', ProductController::class);
        Route::get('/products/remove-image/{id}', [ProductController::class, 'removeImage'])->name('products.removeImage');

        // AJAX routes
        Route::get('ajax/subcategories/{category}', [ProductController::class, 'getSubCategories']);
        Route::get('ajax/subsubcategories/{subcategory}', [ProductController::class, 'getSubSubCategories']);

        Route::resource('categories', CategoryController::class);
        Route::resource('subcategories', SubCategoryController::class);
        Route::resource('subsubcategories', SubSubCategoryController::class)->parameters(['subsubcategories' => 'subSubCategory']);
        // Ajax for dynamic subcategories
        Route::get('ajax/subcategories/{category}', [SubSubCategoryController::class, 'getSubCategories'])->name('ajax.subcategories');
        Route::get('ajax/subsubcategories/{subcategory}', [SubSubCategoryController::class, 'getSubSubCategories']);


        Route::resource('brands', BrandController::class);
        Route::resource('colors', ColorController::class);
        Route::resource('sizes', SizeController::class);


        // <<===========WEBSITE===========>>>

        // SMTP
        Route::get('smtp/{id}', [WebController::class, 'smtpindex'])->name('smtp.edit');
        Route::post('smtp/{id}', [WebController::class, 'smtp'])->name('smtp.update');
        // Pixel
        Route::get('pixel/{id}', [WebController::class, 'pixelindex'])->name('pixel.edit');
        Route::post('pixel/{id}', [WebController::class, 'pixel'])->name('pixel.update');


        // Marketing SETUP PAGE
        Route::get('marketing/setup', [WebController::class, 'marketingSetup'])->name('marketing.setup');
        Route::post('facebook/{id}', [WebController::class, 'facebook'])->name('facebook.update');
        Route::post('google/{id}', [WebController::class, 'google'])->name('google.update');

        // PAYMENT SETUP PAGE
        Route::get('payment/setup', [WebController::class, 'paymentSetup'])->name('payment.setup');
        Route::post('bkash/{id}', [WebController::class, 'bkash'])->name('bkash.update');
        Route::post('nagad/{id}', [WebController::class, 'nagad'])->name('nagad.update');
        Route::post('sslcz/{id}', [WebController::class, 'sslcz'])->name('sslcz.update');
        // CURIORE 
        Route::get('courier', [WebController::class, 'curiore'])->name('courier.setup');
        Route::post('stredfast/{id}', [WebController::class, 'stredfast'])->name('stredfast.update');
        Route::post('pathau/{id}', [WebController::class, 'pathau'])->name('pathau.update');
        Route::post('redx/{id}', [WebController::class, 'redx'])->name('redx.update');
        Route::post('curiores/{id}', [WebController::class, 'curiores'])->name('curiores.update');
        //Coupon
        Route::resource('coupons', CouponController::class);
        Route::resource('bannars', BannarController::class);

    // <<<<<--Orders-->>>>>

    Route::get('all-orders', [OrderController::class, 'allOrders'])->name('all-orders');
    Route::get('/orders/{order}',[OrderController::class, 'show'])->name('admin.orders.show');
    Route::get('pending-orders', [OrderController::class, 'pendingOrders'])->name('pending-orders');
    Route::get('processing-orders', [OrderController::class, 'processingOrders'])->name('processing-orders');
    Route::get('on-the-way-orders', [OrderController::class, 'onTheWayOrders'])->name('on-the-way-orders');
    Route::get('hold-orders', [OrderController::class, 'holdOrders'])->name('hold-orders');
    Route::get('courier-orders', [OrderController::class, 'courierOrders'])->name('courier-orders');
    Route::get('complete-orders', [OrderController::class, 'completeOrders'])->name('complete-orders');
    Route::get('cancelled-orders', [OrderController::class, 'cancelledOrders'])->name('cancelled-orders');

    Route::get('orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');



    });


// php artisan migrate:refresh --path=database/migrations/22025_10_05_153148_create_categories_table.php
