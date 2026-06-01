<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OnboardingController extends Controller
{
    public function verifyNotice()
    {
        $user = Auth::guard('arin')->user();

        return view('client.onboarding.verify', compact('user'));
    }

    public function verifyManual()
    {
        $user = Auth::guard('arin')->user();

        $user->update([
            'email_verified_at' => now(),
        ]);

        return redirect()->route('client.setup.index')
            ->with('success', 'Email berhasil diverifikasi.');
    }

    public function setupIndex()
    {
        $user = Auth::guard('arin')->user();

        return view('client.onboarding.setup', compact('user'));
    }

    public function setupStore(Request $request)
    {
        $request->validate([
            'user_brand_name' => 'required|string|max:150',
            'user_tagline' => 'nullable|string|max:150',
            'user_description' => 'nullable|string',
            'user_whatsapp' => 'nullable|string|max:30',
            'user_instagram' => 'nullable|string|max:255',
            'user_tiktok' => 'nullable|string|max:255',
            'user_theme_primary' => 'required|string|max:20',
            'user_theme_secondary' => 'required|string|max:20',
            'user_logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $user = Auth::guard('arin')->user();

        $data = $request->only([
            'user_brand_name',
            'user_tagline',
            'user_description',
            'user_whatsapp',
            'user_instagram',
            'user_tiktok',
            'user_theme_primary',
            'user_theme_secondary',
        ]);

        if ($request->hasFile('user_logo')) {
            $file = $request->file('user_logo');
            $name = time() . '_' . $user->user_id . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/client-logo'), $name);
            $data['user_logo'] = 'uploads/client-logo/' . $name;
        }

        $data['user_is_setup_done'] = true;

        $user->update($data);

        return redirect()->route('client.dashboard')
            ->with('success', 'Website berhasil disiapkan.');
    }
}