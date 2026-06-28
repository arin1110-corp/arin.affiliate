<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class WebsiteSettingController extends Controller
{
    public function index()
    {
        $user = Auth::guard('arin')->user();

        if (!$user) {
            return redirect()->route('login');
        }

        return view('client.setting.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::guard('arin')->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $request->validate([
            'user_brand_name' =>
            'required|string|max:150',

            'user_subdomain' =>
            'required|string|max:100|alpha_dash|unique:arin_users,user_subdomain,' .
                $user->user_id .
                ',user_id',

            'user_tagline' =>
            'nullable|string|max:150',

            'user_description' =>
            'nullable|string',

            'user_logo' =>
            'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'user_favicon' =>
            'nullable|image|mimes:jpg,jpeg,png,webp,ico|max:1024',

            'user_whatsapp' =>
            'nullable|string|max:30',

            'user_instagram' =>
            'nullable|string|max:255',

            'user_tiktok' =>
            'nullable|string|max:255',

            'user_meta_title' =>
            'nullable|string|max:255',

            'user_meta_description' =>
            'nullable|string',

            'user_theme_primary' =>
            'required|string|max:20',

            'user_theme_secondary' =>
            'required|string|max:20',

            'user_theme_accent' =>
            'required|string|max:20',

            'user_footer_text' =>
            'nullable|string|max:255',
        ]);

        $subdomain = Str::slug(
            strtolower($request->user_subdomain)
        );

        $data = [
            'user_brand_name' =>
            $request->user_brand_name,

            'user_tagline' =>
            $request->user_tagline,

            'user_description' =>
            $request->user_description,

            'user_whatsapp' =>
            $request->user_whatsapp,

            'user_instagram' =>
            $request->user_instagram,

            'user_tiktok' =>
            $request->user_tiktok,

            'user_meta_title' =>
            $request->user_meta_title,

            'user_meta_description' =>
            $request->user_meta_description,

            'user_theme_primary' =>
            $request->user_theme_primary,

            'user_theme_secondary' =>
            $request->user_theme_secondary,

            'user_theme_accent' =>
            $request->user_theme_accent,

            'user_footer_text' =>
            $request->user_footer_text,

            'user_subdomain' =>
            $subdomain,

            /*
            | Untuk kompatibilitas data lama
            */
            'user_slug' =>
            $subdomain,

            'user_is_setup_done' =>
            true,
        ];

        /*
        |--------------------------------------------------------------------------
        | Upload Logo
        |--------------------------------------------------------------------------
        */
        if ($request->hasFile('user_logo')) {

            $folder =
                public_path('uploads/client-logo');

            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }

            $file =
                $request->file('user_logo');

            $filename =
                time() .
                '_' .
                $user->user_id .
                '_logo.' .
                $file->getClientOriginalExtension();

            $file->move(
                $folder,
                $filename
            );

            $data['user_logo'] =
                'uploads/client-logo/' .
                $filename;
        }

        /*
        |--------------------------------------------------------------------------
        | Upload Favicon
        |--------------------------------------------------------------------------
        */
        if ($request->hasFile('user_favicon')) {

            $folder =
                public_path('uploads/client-favicon');

            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }

            $file =
                $request->file('user_favicon');

            $filename =
                time() .
                '_' .
                $user->user_id .
                '_favicon.' .
                $file->getClientOriginalExtension();

            $file->move(
                $folder,
                $filename
            );

            $data['user_favicon'] =
                'uploads/client-favicon/' .
                $filename;
        }

        $user->update($data);

        return redirect()
            ->route('client.setting.index')
            ->with(
                'success',
                'Setting website berhasil disimpan.'
            );
    }
}