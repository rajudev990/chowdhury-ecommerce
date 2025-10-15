<?php


use App\Http\Controllers\Admin\VendorOrderController;
use App\Http\Controllers\Admin\VendorProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\Auth\VendorLoginController;
use App\Http\Controllers\Vendor\VendorController;






// Vendor
Route::prefix('vendor')->name('vendor.')->group(function () {
    Route::get('login', [VendorLoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [VendorLoginController::class, 'login'])->name('login.submit');
    Route::post('logout', [VendorLoginController::class, 'logout'])->name('logout');

    Route::middleware('auth:vendor')->group(function () {

        Route::get('/dashboard', [VendorController::class, 'dashboard'])->name('dashboard');
        Route::get('/profile/settings', [VendorController::class, 'settings'])->name('profile.settings');
        Route::put('/profile/settings', [VendorController::class, 'updateSettings'])->name('profile.update');
        Route::get('/change-password', [VendorController::class, 'changePassword'])->name('change.password');
        Route::put('/change-password', [VendorController::class, 'updatePassword'])->name('change.password.update');
    });

        //  <<< Product & Orders >>>

        Route::resource('products',VendorProductController::class);
        Route::get('/products/remove-image/{id}', [VendorProductController::class, 'removeImage'])->name('products.removeImage');
        
        Route::get('/product/commissions', [VendorProductController::class, 'productCommissions'])->name('products.commissions');
        Route::post('product-commission-store', [VendorProductController::class, 'productCommissionsStore'])->name('product-commission.store');

        // AJAX routes
         Route::get('ajax/subcategories/{category}', [VendorProductController::class, 'getSubCategories'])->name('ajax.subcategories');
        Route::get('ajax/subsubcategories/{subcategory}', [VendorProductController::class, 'getSubSubCategories']);

       
        
        
        
        

      //orders
        Route::get('all-orders', [VendorOrderController::class, 'allOrders'])->name('all-orders');

       
        Route::get('pending-orders', [VendorOrderController::class, 'pendingOrders'])->name('pending-orders');
        Route::get('processing-orders', [VendorOrderController::class, 'processingOrders'])->name('processing-orders');
        Route::get('on-the-way-orders', [VendorOrderController::class, 'onTheWayOrders'])->name('on-the-way-orders');
        Route::get('hold-orders', [VendorOrderController::class, 'holdOrders'])->name('hold-orders');
        Route::get('courier-orders', [VendorOrderController::class, 'courierOrders'])->name('courier-orders');
        Route::get('complete-orders', [VendorOrderController::class, 'completeOrders'])->name('complete-orders');
        Route::get('cancelled-orders', [VendorOrderController::class, 'cancelledOrders'])->name('cancelled-orders');

        Route::get('revenue', [VendorOrderController::class, 'revenue'])->name('revenue');

        Route::get('orders/{id}', [VendorOrderController::class, 'show'])->name('orders.show');
        Route::post('/orders/{order}/update-status', [VendorOrderController::class, 'updateStatus'])->name('orders.updateStatus');


        Route::get('withdrawal', [VendorOrderController::class, 'withdraw'])->name('withdrawal');
        // Route to show the withdrawal request page
        Route::get('/withdrawal-create', [VendorOrderController::class, 'showWithdrawPage'])->name('withdrawal.create');
        Route::post('/withdrawal-store', [VendorOrderController::class, 'storeWithdraw'])->name('withdrawal.store');


});
