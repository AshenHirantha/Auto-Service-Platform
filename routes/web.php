<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Middleware\RedirectBasedOnUserType;
use App\Http\Middleware\EnsureUserTypeAccess;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SettingController;

use App\Http\Controllers\Vendor\DashboardController;
use App\Http\Controllers\Vendor\CatalogController;
use App\Http\Controllers\Vendor\OrdersController;
use App\Http\Controllers\Vendor\ProfileController;
use App\Http\Controllers\Vendor\StockController;
use App\Http\Controllers\Vendor\ReportsController;
use App\Http\Controllers\Vendor\ReviewsController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;

use App\Http\Controllers\customer\PartController as CustomerPartController;
use App\Http\Controllers\customer\PartsOrderController as CustomerPartsOrderController;


// Main landing page
Route::get('/', function () {
    return view('welcome');
})->middleware(RedirectBasedOnUserType::class);

// Guest-only routes
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login/{type?}', [LoginController::class, 'showLoginForm'])
        ->name('login')
        ->where('type', 'customer|service-station|vendor|admin');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

    // Registration
    Route::get('/customer/register', [RegisterController::class, 'showCustomerForm'])->name('register.customer.form');
    Route::post('/customer/register', [RegisterController::class, 'registerCustomer'])->name('register.customer');

    Route::get('/service-station/register', [RegisterController::class, 'showServiceStationForm'])->name('register.service-station.form');
    Route::post('/service-station/register', [RegisterController::class, 'registerServiceStation'])->name('register.service-station');

    Route::get('/vendor/register', [RegisterController::class, 'showVendorForm'])->name('register.vendor.form');
    Route::post('/vendor/register', [RegisterController::class, 'registerVendor'])->name('register.vendor');

    // Password reset (no mail setup required to show forms)
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

// Authenticated-only routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/dashboard', function () {
        $user = auth()->user();
        return redirect('/' . $user->user_type);
    })->name('dashboard');

    // Generic profile routes (used by layout navigation)
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [\App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin panel routes
Route::prefix('admin')->name('admin.')->middleware(['auth', EnsureUserTypeAccess::class . ':admin'])->group(function () {
    Route::get('users/pending', [UserController::class, 'pending'])->name('users.pending');
    Route::patch('users/{user}/approve', [UserController::class, 'approve'])->name('users.approve');
    Route::get('users/stations', [UserController::class, 'stations'])->name('users.stations');
    Route::get('users/vendors', [UserController::class, 'vendors'])->name('users.vendors');
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');

    Route::resource('users', UserController::class)->except(['show']);
    // Removed duplicate resource for settings to avoid name collisions with explicit routes
    Route::get('/', fn () => view('admin.dashboard'))->name('dashboard');
});

// Vendor-specific routes

// Route for vendors to go back to dashboard from any view
// Only GET and HEAD methods are supported for this route

Route::prefix('vendor')
    ->middleware(['auth', EnsureUserTypeAccess::class . ':vendor'])
    ->name('vendor.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Catalog
        Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');
        Route::get('/catalog/create', [CatalogController::class, 'create'])->name('catalog.create');
        Route::post('/catalog', [CatalogController::class, 'store'])->name('catalog.store');
        Route::get('/catalog/{product}/edit', [CatalogController::class, 'edit'])->name('catalog.edit');
        Route::put('/catalog/{product}', [CatalogController::class, 'update'])->name('catalog.update');

        // Orders
        Route::get('/orders', [OrdersController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [OrdersController::class, 'show'])->name('orders.show');

        // Profile
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

        // Stock
        Route::get('/stock', [StockController::class, 'index'])->name('stock.index');
        Route::put('/stock/{product}', [StockController::class, 'update'])->name('stock.update');

        // Reports
        Route::get('/reports', [ReportsController::class, 'index'])->name('reports.index');

        // Reviews
        Route::get('/reviews', [ReviewsController::class, 'index'])->name('reviews.index');

        // Back to vendor dashboard
        Route::get('/back', [DashboardController::class, 'index'])->name('back');
});

// User-specific routes

Route::prefix('customer')->middleware(['auth', EnsureUserTypeAccess::class . ':customer'])->name('customer.')->group(function () {

    // Customer dashboard
    Route::get('/', fn () => view('customer.dashboard'))->name('dashboard');
    
    Route::get('/orders', [PartsOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [PartsOrderController::class, 'show'])->name('orders.show');

    // Back to Customer dashboard
    Route::get('/back', fn () => redirect()->route('customer.dashboard'))->name('back');
});


Route::prefix('service-station')->middleware(['auth', EnsureUserTypeAccess::class . ':service_station'])->group(function () {
    Route::get('/', fn () => view('service_station.dashboard'))->name('service_station.dashboard');
});


// Fallback
Route::fallback(fn () => redirect('/'));
