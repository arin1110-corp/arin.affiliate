<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ModelSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    public function index()
    {
        $user = Auth::guard('arin')->user();

        $data = ModelSlider::where('user_id', $user->user_id)
            ->orderBy('slider_sort_order')
            ->orderByDesc('slider_id')
            ->get();

        return view('client.slider.index', compact('data'));
    }

    public function create()
    {
        return view('client.slider.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'slider_judul' => 'nullable|string|max:255',
            'slider_subjudul' => 'nullable|string',
            'slider_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'slider_image_mobile' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'slider_link' => 'nullable|string|max:255',
            'slider_sort_order' => 'nullable|integer',
        ]);

        $user = Auth::guard('arin')->user();

        $image = null;
        $imageMobile = null;

        if ($request->hasFile('slider_image')) {
            $file = $request->file('slider_image');
            $name = time() . '_' . Str::random(8) . '_desktop.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/slider'), $name);
            $image = 'uploads/slider/' . $name;
        }

        if ($request->hasFile('slider_image_mobile')) {
            $file = $request->file('slider_image_mobile');
            $name = time() . '_' . Str::random(8) . '_mobile.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/slider'), $name);
            $imageMobile = 'uploads/slider/' . $name;
        }

        ModelSlider::create([
            'user_id' => $user->user_id,
            'slider_judul' => $request->slider_judul,
            'slider_subjudul' => $request->slider_subjudul,
            'slider_image' => $image,
            'slider_image_mobile' => $imageMobile,
            'slider_link' => $request->slider_link,
            'slider_sort_order' => $request->slider_sort_order ?? 0,
            'slider_is_active' => $request->has('slider_is_active'),
        ]);

        return redirect()
            ->route('client.slider.index')
            ->with('success', 'Slider berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = Auth::guard('arin')->user();

        $item = ModelSlider::where('user_id', $user->user_id)
            ->where('slider_id', $id)
            ->firstOrFail();

        return view('client.slider.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'slider_judul' => 'nullable|string|max:255',
            'slider_subjudul' => 'nullable|string',
            'slider_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'slider_image_mobile' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'slider_link' => 'nullable|string|max:255',
            'slider_sort_order' => 'nullable|integer',
        ]);

        $user = Auth::guard('arin')->user();

        $item = ModelSlider::where('user_id', $user->user_id)
            ->where('slider_id', $id)
            ->firstOrFail();

        $image = $item->slider_image;
        $imageMobile = $item->slider_image_mobile;

        if ($request->hasFile('slider_image')) {
            $file = $request->file('slider_image');
            $name = time() . '_' . Str::random(8) . '_desktop.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/slider'), $name);
            $image = 'uploads/slider/' . $name;
        }

        if ($request->hasFile('slider_image_mobile')) {
            $file = $request->file('slider_image_mobile');
            $name = time() . '_' . Str::random(8) . '_mobile.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/slider'), $name);
            $imageMobile = 'uploads/slider/' . $name;
        }

        $item->update([
            'slider_judul' => $request->slider_judul,
            'slider_subjudul' => $request->slider_subjudul,
            'slider_image' => $image,
            'slider_image_mobile' => $imageMobile,
            'slider_link' => $request->slider_link,
            'slider_sort_order' => $request->slider_sort_order ?? 0,
            'slider_is_active' => $request->has('slider_is_active'),
        ]);

        return redirect()
            ->route('client.slider.index')
            ->with('success', 'Slider berhasil diupdate.');
    }

    public function toggle($id)
    {
        $user = Auth::guard('arin')->user();

        $item = ModelSlider::where('user_id', $user->user_id)
            ->where('slider_id', $id)
            ->firstOrFail();

        $item->update([
            'slider_is_active' => !$item->slider_is_active,
        ]);

        return back()->with('success', 'Status slider berhasil diubah.');
    }

    public function destroy($id)
    {
        $user = Auth::guard('arin')->user();

        $item = ModelSlider::where('user_id', $user->user_id)
            ->where('slider_id', $id)
            ->firstOrFail();

        $item->delete();

        return back()->with('success', 'Slider berhasil dihapus.');
    }
}