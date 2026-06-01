<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ModelLandingSetting;
use Illuminate\Http\Request;

class LandingSettingController extends Controller
{
    public function index()
    {
        $landing = ModelLandingSetting::firstOrCreate(
            ['landing_id' => 1],
            ['site_name' => 'ARIN']
        );

        return view('admin.landing-setting.index', compact('landing'));
    }

    public function update(Request $request)
    {
        $landing = ModelLandingSetting::firstOrCreate(
            ['landing_id' => 1],
            ['site_name' => 'ARIN']
        );

        $data = $request->only([
            'site_name',
            'site_tagline',
            'site_description',
            'hero_title',
            'hero_subtitle',
            'cta_text',
            'cta_link',
            'whatsapp_number',
            'primary_color',
            'secondary_color',
            'accent_color',
            'section_features',
            'section_faq',
        ]);

        if ($request->hasFile('hero_image')) {
            $file = $request->file('hero_image');
            $name = time().'_hero.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/landing'), $name);
            $data['hero_image'] = 'uploads/landing/'.$name;
        }

        $landing->update($data);

        return back()->with('success', 'Landing page berhasil diupdate.');
    }
}