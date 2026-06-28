<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ModelUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmailMail;
use App\Models\ModelPackage;
use Illuminate\Validation\Rule;
use App\Models\ModelLandingSetting;
use App\Models\ModelSetting;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::guard('arin')->check()) {
            $user = Auth::guard('arin')->user();

            if ($user->user_role === 'client' && !$user->user_email_verified_at) {
                Auth::guard('arin')->logout();

                session()->invalidate();
                session()->regenerateToken();
            } else {
                return $this->redirectByRole($user);
            }
        }

        $landing = ModelLandingSetting::first();
        $appSetting = ModelSetting::first();

        return view('auth.login', compact('landing', 'appSetting'));
    }

    public function register(Request $request)
    {
        if (Auth::guard('arin')->check()) {
            return $this->redirectByRole(Auth::guard('arin')->user());
        }

        $packages = ModelPackage::where('package_is_active', true)->orderBy('package_id')->get();

        $selectedPackage = $request->get('package');

        if ($selectedPackage && !$packages->pluck('package_slug')->contains($selectedPackage)) {
            $selectedPackage = null;
        }

        $landing = ModelLandingSetting::first();
        $appSetting = ModelSetting::first();

        return view('auth.register', compact('packages', 'selectedPackage', 'landing', 'appSetting'));
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = ModelUser::where('user_email', $request->email)->where('user_is_active', true)->first();

        if (!$user) {
            return redirect()
                ->route('login')
                ->withInput()
                ->with('error', [
                    'title' => 'Email Tidak Terdaftar',
                    'message' => 'Email yang Anda masukkan belum terdaftar pada sistem.',
                ]);
        }

        if (!Hash::check($request->password, $user->user_password)) {
            return redirect()
                ->route('login')
                ->withInput()
                ->with('error', [
                    'title' => 'Password Salah',
                    'message' => 'Password yang Anda masukkan tidak sesuai.',
                ]);
        }

        if ($user->user_role !== 'superadmin' && !$user->user_email_verified_at) {
            session([
                'verify_email' => $user->user_email,
            ]);

            return redirect()
                ->route('login')
                ->withInput()
                ->with('error', [
                    'title' => 'Email Belum Diverifikasi',
                    'message' => 'Silakan cek email Anda dan lakukan verifikasi terlebih dahulu.',
                ]);
        }

        Auth::guard('arin')->login($user);

        $request->session()->regenerate();

        return $this->redirectByRole($user);
    }

    public function storeRegister(Request $request)
    {
        $request->validate([
            'user_nama' => 'required|string|max:150',
            'user_email' => 'required|email|unique:arin_users,user_email',
            'user_password' => 'required|min:6',
            'user_brand_name' => 'required|string|max:150',

            'package' => ['required', Rule::exists('arin_packages', 'package_slug')],
        ]);
        $token = Str::random(64);

        $baseSlug = Str::slug($request->user_brand_name);

        if (!$baseSlug) {
            $baseSlug = Str::slug($request->user_nama);
        }

        if (!$baseSlug) {
            $baseSlug = 'user-' . time();
        }

        $slug = $baseSlug;
        $counter = 1;

        while (ModelUser::where('user_slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        /*
        |--------------------------------------------------------------------------
        | PROMO 1000 USER PERTAMA
        |--------------------------------------------------------------------------
        | Berlaku hanya untuk paket starter.
        | User starter ke-1 sampai ke-1000 mendapat promo Rp14.900
        | selama 3 bulan pertama.
        */

        $totalPromoUser = ModelUser::where('user_role', 'client')->where('user_is_promo', true)->count();

        $isPromo = $request->package === 'starter' && $totalPromoUser < 1000;

        $user = ModelUser::create([
            'user_nama' => $request->user_nama,
            'user_email' => $request->user_email,
            'user_password' => Hash::make($request->user_password),

            'user_slug' => $slug,

            'user_brand_name' => $request->user_brand_name,
            'user_subdomain' => $slug,

            'user_role' => 'client',
            'user_package' => $request->package,

            'user_is_promo' => $isPromo,
            'user_promo_batch' => $isPromo ? 1 : null,
            'user_promo_price' => $isPromo ? 14900 : null,

            'user_package_started_at' => now(),
            'user_promo_until' => $isPromo ? now()->addMonths(3) : null,

            'user_email_verify_token' => $token,
            'user_email_verified_at' => null,

            /*
            | Trial 3 hari sebelum wajib bayar.
            | Promo tetap dicatat, tapi trial hanya 3 hari.
            */
            'user_is_trial' => true,
            'user_trial_end_at' => now()->addDays(3),

            /*
            | Website aktif sementara selama trial.
            | Setelah payment nanti expired_at diperpanjang.
            */
            'user_expired_at' => now()->addDays(3),

            'user_theme_primary' => '#ec4899',
            'user_theme_secondary' => '#fdf2f8',

            'user_is_setup_done' => false,
            'user_is_active' => true,
        ]);

        Mail::to($user->user_email)->send(new VerifyEmailMail($user));

        session([
            'verify_email' => $user->user_email,
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan cek email dan lakukan verifikasi terlebih dahulu.');
    }

    public function logout(Request $request)
    {
        Auth::guard('arin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    private function redirectByRole($user)
    {
        if ($user->user_role === 'superadmin') {
            return redirect()->route('admin.dashboard');
        }

        if (!$user->user_email_verified_at) {
            return redirect()->route('client.verify.notice');
        }

        if (!$user->user_is_setup_done) {
            return redirect()->route('client.setup.index');
        }

        return redirect()->route('client.dashboard');
    }
    public function verifyEmail($token)
    {
        $user = ModelUser::where('user_email_verify_token', $token)->first();

        if (!$user) {
            abort(404);
        }

        $user->update([
            'user_email_verified_at' => now(),
            'user_email_verify_token' => null,
        ]);

        Auth::guard('arin')->login($user);

        session()->regenerate();

        return redirect()->route('client.setup.index')->with('success', 'Email berhasil diverifikasi.');
    }
}