<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ModelPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PackageController extends Controller
{
    public function index()
    {
        $data = ModelPackage::orderBy('package_sort_order')
            ->orderByDesc('package_id')
            ->get();

        return view('admin.package.index', compact('data'));
    }

    public function create()
    {
        return view('admin.package.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'package_nama' => 'required|string|max:255',
            'package_harga_normal' => 'required|numeric|min:0',
            'package_harga_promo' => 'nullable|numeric|min:0',
            'package_masa_aktif' => 'required|integer|min:1',

            'package_max_product' => 'required|integer|min:1',
            'package_max_slider' => 'required|integer|min:1',
            'package_max_category' => 'required|integer|min:1',

            'package_deskripsi' => 'nullable|string',
            'package_fitur' => 'nullable|string',
            'package_sort_order' => 'nullable|integer',
        ]);

        $slug = Str::slug($request->package_nama);
        $baseSlug = $slug;
        $counter = 1;

        while (ModelPackage::where('package_slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        ModelPackage::create([
            'package_nama' => $request->package_nama,
            'package_slug' => $slug,

            'package_harga_normal' => $request->package_harga_normal,
            'package_harga_promo' => $request->package_harga_promo,
            'package_masa_aktif' => $request->package_masa_aktif,

            'package_max_product' => $request->package_max_product,
            'package_max_slider' => $request->package_max_slider,
            'package_max_category' => $request->package_max_category,

            'package_custom_domain' => $request->has('package_custom_domain'),
            'package_remove_branding' => $request->has('package_remove_branding'),
            'package_google_analytics' => $request->has('package_google_analytics'),
            'package_meta_pixel' => $request->has('package_meta_pixel'),

            'package_deskripsi' => $request->package_deskripsi,
            'package_fitur' => $request->package_fitur,

            'package_is_active' => $request->has('package_is_active'),
            'package_sort_order' => $request->package_sort_order ?? 0,
        ]);

        return redirect()
            ->route('admin.package.index')
            ->with('success', 'Package berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $item = ModelPackage::where('package_id', $id)->firstOrFail();

        return view('admin.package.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = ModelPackage::where('package_id', $id)->firstOrFail();

        $request->validate([
            'package_nama' => 'required|string|max:255',
            'package_harga_normal' => 'required|numeric|min:0',
            'package_harga_promo' => 'nullable|numeric|min:0',
            'package_masa_aktif' => 'required|integer|min:1',

            'package_max_product' => 'required|integer|min:1',
            'package_max_slider' => 'required|integer|min:1',
            'package_max_category' => 'required|integer|min:1',

            'package_deskripsi' => 'nullable|string',
            'package_fitur' => 'nullable|string',
            'package_sort_order' => 'nullable|integer',
        ]);

        $slug = $item->package_slug;

        if ($request->package_nama !== $item->package_nama) {
            $slug = Str::slug($request->package_nama);
            $baseSlug = $slug;
            $counter = 1;

            while (
                ModelPackage::where('package_slug', $slug)
                    ->where('package_id', '!=', $item->package_id)
                    ->exists()
            ) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }
        }

        $item->update([
            'package_nama' => $request->package_nama,
            'package_slug' => $slug,

            'package_harga_normal' => $request->package_harga_normal,
            'package_harga_promo' => $request->package_harga_promo,
            'package_masa_aktif' => $request->package_masa_aktif,

            'package_max_product' => $request->package_max_product,
            'package_max_slider' => $request->package_max_slider,
            'package_max_category' => $request->package_max_category,

            'package_custom_domain' => $request->has('package_custom_domain'),
            'package_remove_branding' => $request->has('package_remove_branding'),
            'package_google_analytics' => $request->has('package_google_analytics'),
            'package_meta_pixel' => $request->has('package_meta_pixel'),

            'package_deskripsi' => $request->package_deskripsi,
            'package_fitur' => $request->package_fitur,

            'package_is_active' => $request->has('package_is_active'),
            'package_sort_order' => $request->package_sort_order ?? 0,
        ]);

        return redirect()
            ->route('admin.package.index')
            ->with('success', 'Package berhasil diupdate.');
    }

    public function toggle($id)
    {
        $item = ModelPackage::where('package_id', $id)->firstOrFail();

        $item->update([
            'package_is_active' => !$item->package_is_active,
        ]);

        return back()->with('success', 'Status package berhasil diubah.');
    }

    public function destroy($id)
    {
        $item = ModelPackage::where('package_id', $id)->firstOrFail();

        $item->delete();

        return back()->with('success', 'Package berhasil dihapus.');
    }
}