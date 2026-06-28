<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ModelUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OnboardingController extends Controller
{
    public function verifyNotice()
    {
        $user = Auth::guard('arin')->user();

        if (!$user) {
            return redirect()->route('login');
        }

        return view('client.onboarding.verify', compact('user'));
    }

    public function verifyManual()
    {
        $user = Auth::guard('arin')->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $user->update([
            'user_email_verified_at' => now(),
            'user_email_verify_token' => null,
        ]);

        return redirect()->route('client.setup.index')->with('success', 'Email berhasil diverifikasi.');
    }

    public function setupIndex()
    {
        $user = Auth::guard('arin')->user();

        if (!$user) {
            return redirect()->route('login');
        }

        return view('client.onboarding.setup', compact('user'));
    }

    public function setupStore(Request $request)
    {
        $user = Auth::guard('arin')->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $request->validate([
            'user_brand_name' => 'required|string|max:150',

            'user_subdomain' => 'required|string|max:100|alpha_dash|unique:arin_users,user_subdomain,' . $user->user_id . ',user_id',

            'user_tagline' => 'nullable|string|max:150',

            'user_description' => 'nullable|string',

            'user_whatsapp' => 'nullable|string|max:30',

            'user_instagram' => 'nullable|string|max:255',

            'user_tiktok' => 'nullable|string|max:255',

            'user_theme_primary' => 'required|string|max:20',

            'user_theme_secondary' => 'required|string|max:20',

            'user_logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $subdomain = Str::slug(strtolower($request->user_subdomain));

        $data = [
            'user_brand_name' => $request->user_brand_name,

            'user_tagline' => $request->user_tagline,

            'user_description' => $request->user_description,

            'user_whatsapp' => $request->user_whatsapp,

            'user_instagram' => $request->user_instagram,

            'user_tiktok' => $request->user_tiktok,

            'user_theme_primary' => $request->user_theme_primary,

            'user_theme_secondary' => $request->user_theme_secondary,

            'user_subdomain' => $subdomain,

            'user_slug' => $subdomain,

            'user_is_setup_done' => true,
        ];

        if ($request->hasFile('user_logo')) {
            $file = $request->file('user_logo');

            $filename = time() . '_' . $user->user_id . '.' . $file->getClientOriginalExtension();

            $destination = public_path('uploads/client-logo');

            if (!file_exists($destination)) {
                mkdir($destination, 0777, true);
            }

            $file->move($destination, $filename);

            $data['user_logo'] = 'uploads/client-logo/' . $filename;
        }

        $user->update($data);

        return redirect()->route('client.dashboard')->with('success', 'Website berhasil disiapkan.');
    }
}