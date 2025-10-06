<?php


use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\CouponController;
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
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;


Route::get('auth/{provider}', [WebsiteController::class, 'redirect'])->name('social.redirect');
Route::get('auth/{provider}/callback', [WebsiteController::class, 'callback'])->name('social.callback');


Route::get('/cmd',function(){
    Artisan::call('storage:link');
    Artisan::call('optimize:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    return 'Done';
});



Route::get('/',[WebsiteController::class,'index'])->name('index');
Route::get('/products',[WebsiteController::class,'products'])->name('products');
Route::get('/reviews',[WebsiteController::class,'reviews'])->name('reviews');
Route::get('/contacts',[WebsiteController::class,'contacts'])->name('contacts');
Route::post('/contacts-store',[WebsiteController::class,'contactStore'])->name('contact.store');


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

    Route::get('/dashboard',[HomeController::class,'index'])->name('dashboard');

    Route::get('settings', [HomeController::class, 'settings'])->name('user.settings');
    Route::get('profile', [HomeController::class, 'profile'])->name('user.profile');
    Route::get('profile/edit', [HomeController::class, 'profileEdit'])->name('user.profile.edit');
    Route::put('/profile/update', [HomeController::class, 'update'])->name('user.profile.update');
    Route::get('password/edit', [HomeController::class, 'passwordEdit'])->name('user.password.edit');
    Route::post('/password-update', [HomeController::class, 'updatePassword'])->name('user.password.update');
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


        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

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
        Route::get('ajax/subcategories/{category}', [SubSubCategoryController::class,'getSubCategories'])->name('ajax.subcategories');
        Route::get('ajax/subsubcategories/{subcategory}', [SubSubCategoryController::class, 'getSubSubCategories']);


        Route::resource('brands', BrandController::class);
        Route::resource('colors', ColorController::class);
        Route::resource('sizes', SizeController::class);


        // <<===========WEBSITE===========>>>

        // Stread Fast
        Route::get('stred_fast/{id}', [WebController::class, 'StreadFastIndex'])->name('stred_fast.edit');
        Route::post('stred_fast/{id}', [WebController::class, 'StreadFast'])->name('stred_fast.update');
         // curiore
        Route::get('curiore/{id}', [WebController::class, 'CuriorIndex'])->name('curiore.edit');
        Route::post('curiore/{id}', [WebController::class, 'Curiore'])->name('curiore.update');
         // Pathau
        Route::get('pathau/{id}', [WebController::class, 'pathauIndex'])->name('pathau.edit');
        Route::post('pathau/{id}', [WebController::class, 'pathau'])->name('pathau.update');
          // SMTP
        Route::get('smtp/{id}', [WebController::class, 'smtpindex'])->name('smtp.edit');
        Route::post('smtp/{id}', [WebController::class, 'smtp'])->name('smtp.update');
        // Pixel
        Route::get('pixel/{id}', [WebController::class, 'pixelindex'])->name('pixel.edit');
        Route::post('pixel/{id}', [WebController::class, 'pixel'])->name('pixel.update');
        // REDX
        Route::get('redx/{id}', [WebController::class, 'redxindex'])->name('redx.edit');
        Route::post('redx/{id}', [WebController::class, 'redx'])->name('redx.update');
    
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
        Route::get('coriore', [WebController::class, 'curiore'])->name('curiore.setup');
        Route::post('stredfast/{id}', [WebController::class, 'stredfast'])->name('stredfast.update');
        Route::post('pathau/{id}', [WebController::class, 'pathau'])->name('pathau.update');
        Route::post('redx/{id}', [WebController::class, 'redx'])->name('redx.update');
        Route::post('curiores/{id}', [WebController::class, 'curiores'])->name('curiores.update');
        //Coupon
        Route::resource('coupons', CouponController::class);
    



    });


// php artisan migrate:refresh --path=database/migrations/22025_10_05_153148_create_categories_table.php
