<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ModelSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = ModelSetting::first();

        if (!$setting) {
            $setting = ModelSetting::create([
                'app_name' => 'ARIN',
            ]);
        }

        return view('admin.setting.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = ModelSetting::first();

        $data = $request->only([
            'app_name',
            'support_email',
            'support_whatsapp',
            'footer_text',
        ]);

        if ($request->hasFile('app_logo')) {

            $file = $request->file('app_logo');

            $name = time().'_logo.'.$file->getClientOriginalExtension();

            $file->move(public_path('uploads/system'), $name);

            $data['app_logo'] = 'uploads/system/'.$name;
        }

        if ($request->hasFile('app_favicon')) {

            $file = $request->file('app_favicon');

            $name = time().'_favicon.'.$file->getClientOriginalExtension();

            $file->move(public_path('uploads/system'), $name);

            $data['app_favicon'] = 'uploads/system/'.$name;
        }

        $setting->update($data);

        return back()->with('success','Setting berhasil disimpan.');
    }
}