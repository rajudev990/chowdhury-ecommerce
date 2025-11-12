<?php


use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AffiliatesController;
use App\Http\Controllers\Admin\AffiliateWithdrawController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\BannarController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CampingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductCommisionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\SubSubCategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VendorsController;
use App\Http\Controllers\Admin\WebController;
use Illuminate\Support\Facades\Route;
// Super Admin Auth
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

        Route::post('/currency-update', [AdminProfileController::class, 'updateCurrency'])->name('currency.update');


        Route::resource('settings', SettingController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);

        Route::resource('products', ProductController::class);
        Route::get('/products/remove-image/{id}', [ProductController::class, 'removeImage'])->name('products.removeImage');
        Route::get('/seller/product', [ProductController::class, 'sellerProduct'])->name('seller.product');

        // AJAX routes Category Subcategory Sub Sub Category
        Route::get('ajax/subcategories/{category}', [ProductController::class, 'getSubCategories']);
        Route::get('ajax/subsubcategories/{subcategory}', [ProductController::class, 'getSubSubCategories']);

        Route::resource('categories', CategoryController::class);
        Route::resource('subcategories', SubCategoryController::class);
        Route::resource('subsubcategories', SubSubCategoryController::class)->parameters(['subsubcategories' => 'subSubCategory']);
        // Ajax for dynamic Product Subcategory
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
        Route::post('tag-manager/{id}', [WebController::class, 'TagManager'])->name('tag-manager.update');

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
         //orders
        Route::get('all-orders', [OrderController::class, 'allOrders'])->name('all-orders');
        Route::get('orders/{id}', [OrderController::class, 'show'])->name('orders.show');
        Route::post('/orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
         //Pending Orders
        Route::get('pending-orders', [OrderController::class, 'pendingOrders'])->name('pending-orders');
        Route::get('processing-orders', [OrderController::class, 'processingOrders'])->name('processing-orders');
        Route::get('on-the-way-orders', [OrderController::class, 'onTheWayOrders'])->name('on-the-way-orders');
        Route::get('hold-orders', [OrderController::class, 'holdOrders'])->name('hold-orders');
        Route::get('courier-orders', [OrderController::class, 'courierOrders'])->name('courier-orders');
        Route::get('complete-orders', [OrderController::class, 'completeOrders'])->name('complete-orders');
        Route::get('cancelled-orders', [OrderController::class, 'cancelledOrders'])->name('cancelled-orders');


        Route::post('/orders/{order}/{courier}', [App\Http\Controllers\Admin\OrderController::class, 'assignCourier'])->name('orders.courier');
        Route::post('/orders/{order}/fraud-check', [App\Http\Controllers\Admin\OrderController::class, 'fraudCheck'])->name('orders.fraudCheck');
       
       Route::get('stock-report', [OrderController::class,'stock_report'])->name('stock_report');
       Route::get('order-report', [OrderController::class,'order_report'])->name('order_report');
   

        
        // <<<<<--Affiliate-->>>>>
        Route::resource('all-users',AffiliatesController::class);

        // <<<<<--Vendor-->>>>>
        Route::resource('all-sellers',VendorsController::class);
        Route::get('sellers-withdrawal', [VendorsController::class, 'sellersWithdrawal'])->name('sellers-withdrawal');
        Route::post('sellers-withdrawal/{id}/status', [VendorsController::class, 'updateStatus'])->name('sellers-withdrawal.updateStatus');

        
        // product commision
        Route::resource('product-commission',ProductCommisionController::class);


        Route::resource('marketer-withdraw', AffiliateWithdrawController::class);
        Route::post('marketer-withdraw/{id}/status', [AffiliateWithdrawController::class, 'updateStatus'])->name('marketer-withdraw.updateStatus');

        Route::resource('campings',CampingController::class);



       

    });
