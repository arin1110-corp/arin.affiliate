<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Admin\LandingSettingController;
use App\Http\Controllers\Client\OnboardingController;
use App\Http\Controllers\Client\KategoriController;

Route::get('/', [HomeController::class, 'index'])
    ->name('front.home');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'login'])
    ->name('login');

Route::post('/login', [AuthController::class, 'authenticate'])
    ->name('authenticate');

Route::get('/register', [AuthController::class, 'register'])
    ->name('register');

Route::post('/register', [AuthController::class, 'storeRegister'])
    ->name('register.store');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

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

        Route::get('/landing-setting', [LandingSettingController::class, 'index'])
            ->name('admin.landing.setting');

        Route::put('/landing-setting', [LandingSettingController::class, 'update'])
            ->name('admin.landing.setting.update');
    });

/*
|--------------------------------------------------------------------------
| CLIENT PANEL
|--------------------------------------------------------------------------
*/

Route::middleware(['arinauth', 'client'])
    ->prefix('client')
    ->group(function () {

        Route::get('/verify-email', [OnboardingController::class, 'verifyNotice'])
            ->name('client.verify.notice');

        Route::post('/verify-email/manual', [OnboardingController::class, 'verifyManual'])
            ->name('client.verify.manual');

        Route::get('/setup', [OnboardingController::class, 'setupIndex'])
            ->name('client.setup.index');

        Route::post('/setup', [OnboardingController::class, 'setupStore'])
            ->name('client.setup.store');

        Route::middleware('client.onboarding')->group(function () {

            Route::get('/dashboard', function () {
                return view('client.dashboard.index');
            })->name('client.dashboard');

            Route::get('/kategori', [KategoriController::class, 'index'])
                ->name('client.kategori.index');

            Route::get('/kategori/create', [KategoriController::class, 'create'])
                ->name('client.kategori.create');

            Route::post('/kategori', [KategoriController::class, 'store'])
                ->name('client.kategori.store');

            Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])
                ->name('client.kategori.edit');

            Route::put('/kategori/{id}', [KategoriController::class, 'update'])
                ->name('client.kategori.update');

            Route::patch('/kategori/{id}/toggle', [KategoriController::class, 'toggle'])
                ->name('client.kategori.toggle');

            Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])
                ->name('client.kategori.destroy');
        });
    });

/*
|--------------------------------------------------------------------------
| PUBLIC CLIENT SITE
|--------------------------------------------------------------------------
| Taruh paling bawah supaya tidak menangkap route lain.
|--------------------------------------------------------------------------
*/

Route::get('/{slug}', function ($slug) {
    $client = \App\Models\ModelUser::where('user_slug', $slug)
        ->where('user_role', 'client')
        ->where('user_is_active', true)
        ->firstOrFail();

    $kategori = \App\Models\ModelKategori::where('user_id', $client->user_id)
        ->where('kategori_is_active', true)
        ->where('kategori_is_visible', true)
        ->orderBy('kategori_sort_order')
        ->get();

    return view('front.client.home', compact('client', 'kategori'));
})->name('client.public.site');