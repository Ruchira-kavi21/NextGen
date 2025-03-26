<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\SecondHandPartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\CustomerController;

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/index', function () {
    return view('index');
})->name('index');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/signup', [SignupController::class, 'showSignupForm'])->name('signup');
Route::post('/signup', [SignupController::class, 'store'])->name('signup.store');

Route::middleware(['auth:customer'])->group(function () {
    Route::post('/logout', function (Illuminate\Http\Request $request) {
        Auth::guard('customer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    })->name('customer.logout');

    Route::get('/customer/profile', [CustomerController::class, 'profile'])->name('customer.profile');
    Route::get('/customer/edit-profile', [CustomerController::class, 'editProfile'])->name('customer.edit_profile');
    Route::put('/customer/profile', [CustomerController::class, 'updateProfile'])->name('customer.update_profile');
});

Route::get('/secondhand', [SecondHandPartController::class, 'index'])->name('secondhand.index');
Route::get('/secondhand/create', [SecondHandPartController::class, 'create'])->name('secondhand.create');
Route::post('/secondhand', [SecondHandPartController::class, 'store'])->name('secondhand.store');
Route::get('/secondhand/{id}', [SecondHandPartController::class, 'show'])->name('secondhand.show');
Route::post('/secondhand/{id}/buy', [SecondHandPartController::class, 'buy'])->name('secondhand.buy');
Route::get('/secondhand/{id}/buy', [SecondHandPartController::class, 'showBuyForm'])->name('secondhand.buy_form');

Route::middleware([\App\Http\Middleware\SellerAuth::class])->group(function () {
    Route::get('/sellers/parts/{id}/edit', [SellerController::class, 'editPart'])->name('seller.edit_part'); // Added
    Route::put('/sellers/parts/{id}', [SellerController::class, 'updatePart'])->name('seller.update_part'); // Added
    Route::delete('/sellers/parts/{id}', [SellerController::class, 'deletePart'])->name('seller.delete_part');
    Route::get('/sellers/dashboard', [SellerController::class, 'dashboard'])->name('sellers.dashboard');
    Route::get('/sellers/sell', [SellerController::class, 'showSellForm'])->name('seller.sell_form');
    Route::post('/sellers/sell', [SellerController::class, 'sell'])->name('seller.sell');
    Route::post('/sellers/logout', [SellerController::class, 'logout'])->name('seller.logout');
    
});
Route::get('/profile', function () {
    return view('sellers.profile');
})->name('profile');
Route::middleware([\App\Http\Middleware\AdminAuth::class])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/approve/{id}', [AdminController::class, 'approve'])->name('admin.approve');
    Route::post('/admin/decline/{id}', [AdminController::class, 'decline'])->name('admin.decline');
    Route::post('/admin/delete-seller/{id}', [AdminController::class, 'deleteSeller'])->name('admin.delete_seller');
    Route::post('/admin/delete-customer/{id}', [AdminController::class, 'deleteCustomer'])->name('admin.delete_customer');
    Route::get('/admin/export-sales-report', [AdminController::class, 'exportSalesReport'])->name('admin.export_sales_report');
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout'); 
    Route::post('/admin/add-seller', [AdminController::class, 'addSeller'])->name('admin.add_seller');
    Route::post('/admin/edit-seller/{id}', [AdminController::class, 'editSeller'])->name('admin.edit_seller');
    Route::post('/admin/add-customer', [AdminController::class, 'addCustomer'])->name('admin.add_customer');
    Route::post('/admin/edit-customer/{id}', [AdminController::class, 'editCustomer'])->name('admin.edit_customer');
    Route::post('/admin/add-part', [AdminController::class, 'addPart'])->name('admin.add_part');
    Route::post('/admin/edit-part/{id}', [AdminController::class, 'editPart'])->name('admin.edit_part');
});
Route::get('/editprofile', function () {
    return view('customer.editprofile');
})->name('editprofile');

