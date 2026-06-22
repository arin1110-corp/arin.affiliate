<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Admin\LandingSettingController;
use App\Http\Controllers\Client\OnboardingController;
use App\Http\Controllers\Client\KategoriController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Front\ProductClickController;
use App\Http\Controllers\Client\SliderController;
use App\Http\Controllers\Client\WebsiteSettingController;
use App\Http\Controllers\Client\PaymentController as ClientPaymentController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\MidtransNotificationController;
use App\Http\Controllers\Admin\ClientController;

Route::get('/', [HomeController::class, 'index'])->name('front.home');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');

Route::get('/register', [AuthController::class, 'register'])->name('register');

Route::post('/register', [AuthController::class, 'storeRegister'])->name('register.store');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| SUPER ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['arinauth', 'superadmin'])
    ->prefix('admin')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard.index');
        })->name('admin.dashboard');

    Route::get('/landing-setting', [LandingSettingController::class, 'index'])->name('admin.landing.setting');

    Route::put('/landing-setting', [LandingSettingController::class, 'update'])->name('admin.landing.setting.update');
    Route::get('/payment', [AdminPaymentController::class, 'index'])
        ->name('admin.payment.index');

    Route::get('/payment', [AdminPaymentController::class, 'index'])
        ->name('admin.payment.index');

    Route::get('/payment/{id}', [AdminPaymentController::class, 'show'])
        ->name('admin.payment.show');

    Route::get('/client', [ClientController::class, 'index'])
        ->name('admin.client.index');

    Route::get('/client/{id}', [ClientController::class, 'show'])
        ->name('admin.client.show');

    Route::get('/client/{id}/edit', [ClientController::class, 'edit'])
        ->name('admin.client.edit');

    Route::put('/client/{id}', [ClientController::class, 'update'])
        ->name('admin.client.update');

    Route::patch('/client/{id}/toggle', [ClientController::class, 'toggle'])
        ->name('admin.client.toggle');

    Route::patch('/client/{id}/extend', [ClientController::class, 'extend'])
        ->name('admin.client.extend');

    Route::delete('/client/{id}', [ClientController::class, 'destroy'])
        ->name('admin.client.destroy');
    });

/*
|--------------------------------------------------------------------------
| CLIENT PANEL
|--------------------------------------------------------------------------
*/

Route::middleware(['arinauth', 'client'])
    ->prefix('client')
    ->group(function () {
    Route::get('/verify-email', [OnboardingController::class, 'verifyNotice'])->name('client.verify.notice');

    Route::post('/verify-email/manual', [OnboardingController::class, 'verifyManual'])->name('client.verify.manual');

    Route::get('/setup', [OnboardingController::class, 'setupIndex'])->name('client.setup.index');

    Route::post('/setup', [OnboardingController::class, 'setupStore'])->name('client.setup.store');

    Route::middleware('client.onboarding')->group(function () {
            Route::get('/dashboard', function () {
                return view('client.dashboard.index');
            })->name('client.dashboard');

        /*
            |--------------------------------------------------------------------------
            | KATEGORI
            |--------------------------------------------------------------------------
            */

        Route::get('/kategori', [KategoriController::class, 'index'])->name('client.kategori.index');

        Route::get('/kategori/create', [KategoriController::class, 'create'])->name('client.kategori.create');

        Route::post('/kategori', [KategoriController::class, 'store'])->name('client.kategori.store');

        Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('client.kategori.edit');

        Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('client.kategori.update');

        Route::patch('/kategori/{id}/toggle', [KategoriController::class, 'toggle'])->name('client.kategori.toggle');

        Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('client.kategori.destroy');

        /*
            |--------------------------------------------------------------------------
            | PRODUCT
            |--------------------------------------------------------------------------
            */

        Route::get('/product', [ProductController::class, 'index'])->name('client.product.index');

        Route::get('/product/create', [ProductController::class, 'create'])->name('client.product.create');

        Route::post('/product', [ProductController::class, 'store'])->name('client.product.store');

        Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('client.product.edit');

        Route::put('/product/{id}', [ProductController::class, 'update'])->name('client.product.update');

        Route::patch('/product/{id}/toggle', [ProductController::class, 'toggle'])->name('client.product.toggle');

        Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('client.product.destroy');

        /*
            |--------------------------------------------------------------------------
            | SLIDER
            |--------------------------------------------------------------------------
            */

        Route::get('/slider', [SliderController::class, 'index'])->name('client.slider.index');

        Route::get('/slider/create', [SliderController::class, 'create'])->name('client.slider.create');

        Route::post('/slider', [SliderController::class, 'store'])->name('client.slider.store');

        Route::get('/slider/{id}/edit', [SliderController::class, 'edit'])->name('client.slider.edit');

        Route::put('/slider/{id}', [SliderController::class, 'update'])->name('client.slider.update');

        Route::patch('/slider/{id}/toggle', [SliderController::class, 'toggle'])->name('client.slider.toggle');

        Route::delete('/slider/{id}', [SliderController::class, 'destroy'])->name('client.slider.destroy');

        /*
            |--------------------------------------------------------------------------
            | WEBSITE SETTING
            |--------------------------------------------------------------------------
        */

        Route::get('/setting', [WebsiteSettingController::class, 'index'])->name('client.setting.index');

        Route::put('/setting', [WebsiteSettingController::class, 'update'])->name('client.setting.update');

        /*
            |--------------------------------------------------------------------------
            | PAYMENT
            |--------------------------------------------------------------------------
        */
        Route::get('/payment', [ClientPaymentController::class, 'index'])
            ->name('client.payment.index');

        Route::get('/payment/create', [ClientPaymentController::class, 'create'])
            ->name('client.payment.create');

        Route::post('/payment', [ClientPaymentController::class, 'store'])
            ->name('client.payment.store');
        });
    });

/*
|--------------------------------------------------------------------------
| PUBLIC PRODUCT CLICK
|--------------------------------------------------------------------------
| Taruh sebelum /{slug}
|--------------------------------------------------------------------------
*/

Route::get('/{clientSlug}/go/{productSlug}', [ProductClickController::class, 'click'])->name('front.product.click');

/*
|--------------------------------------------------------------------------
| PUBLIC CLIENT SITE
|--------------------------------------------------------------------------
| Taruh paling bawah supaya tidak menangkap route lain.
|--------------------------------------------------------------------------
*/

Route::get('/{slug}', function ($slug) {
    $client = \App\Models\ModelUser::where('user_slug', $slug)->where('user_role', 'client')->where('user_is_active', true)->firstOrFail();

    $sliders = \App\Models\ModelSlider::where('user_id', $client->user_id)->where('slider_is_active', true)->orderBy('slider_sort_order')->get();

    $kategori = \App\Models\ModelKategori::where('user_id', $client->user_id)->where('kategori_is_active', true)->where('kategori_is_visible', true)->orderBy('kategori_sort_order')->get();

    $featuredProducts = \App\Models\ModelProduct::with('kategori')->where('user_id', $client->user_id)->where('product_status', 'active')->where('product_featured', true)->latest('product_id')->take(8)->get();

    $latestProducts = \App\Models\ModelProduct::with('kategori')->where('user_id', $client->user_id)->where('product_status', 'active')->latest('product_id')->take(12)->get();

    return view('front.client.home', compact('client', 'sliders', 'kategori', 'featuredProducts', 'latestProducts'));
})->name('client.public.site');