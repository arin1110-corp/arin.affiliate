<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ModelKategori;
use App\Models\ModelProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $user = Auth::guard('arin')->user();

        $data = ModelProduct::with('kategori')
            ->where('user_id', $user->user_id)
            ->orderByDesc('product_id')
            ->get();

        return view('client.product.index', compact('data'));
    }

    public function create()
    {
        $user = Auth::guard('arin')->user();

        $kategori = ModelKategori::where('user_id', $user->user_id)
            ->where('kategori_is_active', true)
            ->orderBy('kategori_sort_order')
            ->get();

        return view('client.product.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_nama' => 'required|string|max:255',
            'product_kategori' => 'nullable|integer',
            'product_harga' => 'nullable|numeric',
            'product_affiliate_link' => 'required|string',
            'product_thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'product_deskripsi' => 'nullable|string',
            'product_status' => 'nullable|in:draft,active',
        ]);

        $user = Auth::guard('arin')->user();

        if ($request->product_kategori) {
            ModelKategori::where('user_id', $user->user_id)
                ->where('kategori_id', $request->product_kategori)
                ->firstOrFail();
        }

        $baseSlug = Str::slug($request->product_nama);

        if (!$baseSlug) {
            $baseSlug = 'produk-' . time();
        }

        $slug = $baseSlug;
        $counter = 1;

        while (
            ModelProduct::where('user_id', $user->user_id)
                ->where('product_slug', $slug)
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        $thumbnail = null;

        if ($request->hasFile('product_thumbnail')) {
            $file = $request->file('product_thumbnail');
            $name = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/product'), $name);
            $thumbnail = 'uploads/product/' . $name;
        }

        ModelProduct::create([
            'user_id' => $user->user_id,
            'product_kategori' => $request->product_kategori,
            'product_nama' => $request->product_nama,
            'product_slug' => $slug,
            'product_thumbnail' => $thumbnail,
            'product_harga' => $request->product_harga,
            'product_deskripsi' => $request->product_deskripsi,
            'product_affiliate_link' => $request->product_affiliate_link,
            'product_total_click' => 0,
            'product_featured' => $request->has('product_featured'),
            'product_status' => $request->product_status ?? 'active',
        ]);

        return redirect()
            ->route('client.product.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = Auth::guard('arin')->user();

        $item = ModelProduct::where('user_id', $user->user_id)
            ->where('product_id', $id)
            ->firstOrFail();

        $kategori = ModelKategori::where('user_id', $user->user_id)
            ->where('kategori_is_active', true)
            ->orderBy('kategori_sort_order')
            ->get();

        return view('client.product.edit', compact('item', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_nama' => 'required|string|max:255',
            'product_kategori' => 'nullable|integer',
            'product_harga' => 'nullable|numeric',
            'product_affiliate_link' => 'required|string',
            'product_thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'product_deskripsi' => 'nullable|string',
            'product_status' => 'nullable|in:draft,active',
        ]);

        $user = Auth::guard('arin')->user();

        $item = ModelProduct::where('user_id', $user->user_id)
            ->where('product_id', $id)
            ->firstOrFail();

        if ($request->product_kategori) {
            ModelKategori::where('user_id', $user->user_id)
                ->where('kategori_id', $request->product_kategori)
                ->firstOrFail();
        }

        $slug = $item->product_slug;

        if ($request->product_nama !== $item->product_nama) {
            $baseSlug = Str::slug($request->product_nama);

            if (!$baseSlug) {
                $baseSlug = 'produk-' . time();
            }

            $slug = $baseSlug;
            $counter = 1;

            while (
                ModelProduct::where('user_id', $user->user_id)
                    ->where('product_slug', $slug)
                    ->where('product_id', '!=', $item->product_id)
                    ->exists()
            ) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }
        }

        $thumbnail = $item->product_thumbnail;

        if ($request->hasFile('product_thumbnail')) {
            $file = $request->file('product_thumbnail');
            $name = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/product'), $name);
            $thumbnail = 'uploads/product/' . $name;
        }

        $item->update([
            'product_kategori' => $request->product_kategori,
            'product_nama' => $request->product_nama,
            'product_slug' => $slug,
            'product_thumbnail' => $thumbnail,
            'product_harga' => $request->product_harga,
            'product_deskripsi' => $request->product_deskripsi,
            'product_affiliate_link' => $request->product_affiliate_link,
            'product_featured' => $request->has('product_featured'),
            'product_status' => $request->product_status ?? 'active',
        ]);

        return redirect()
            ->route('client.product.index')
            ->with('success', 'Produk berhasil diupdate.');
    }

    public function toggle($id)
    {
        $user = Auth::guard('arin')->user();

        $item = ModelProduct::where('user_id', $user->user_id)
            ->where('product_id', $id)
            ->firstOrFail();

        $item->update([
            'product_status' => $item->product_status === 'active' ? 'draft' : 'active',
        ]);

        return back()->with('success', 'Status produk berhasil diubah.');
    }

    public function destroy($id)
    {
        $user = Auth::guard('arin')->user();

        $item = ModelProduct::where('user_id', $user->user_id)
            ->where('product_id', $id)
            ->firstOrFail();

        $item->delete();

        return back()->with('success', 'Produk berhasil dihapus.');
    }
}