<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ModelKategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    public function index()
    {
        $user = Auth::guard('arin')->user();

        $data = ModelKategori::where('user_id', $user->user_id)
            ->orderBy('kategori_sort_order')
            ->orderByDesc('kategori_id')
            ->get();

        return view('client.kategori.index', compact('data'));
    }

    public function create()
    {
        return view('client.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_nama' => 'required|string|max:150',
            'kategori_deskripsi' => 'nullable|string',
            'kategori_thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'kategori_meta_title' => 'nullable|string|max:255',
            'kategori_meta_description' => 'nullable|string',
            'kategori_sort_order' => 'nullable|integer',
        ]);

        $user = Auth::guard('arin')->user();

        $baseSlug = Str::slug($request->kategori_nama);
        $slug = $baseSlug;
        $counter = 1;

        while (
            ModelKategori::where('user_id', $user->user_id)
                ->where('kategori_slug', $slug)
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        $thumbnail = null;

        if ($request->hasFile('kategori_thumbnail')) {
            $file = $request->file('kategori_thumbnail');
            $name = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/kategori'), $name);
            $thumbnail = 'uploads/kategori/' . $name;
        }

        ModelKategori::create([
            'user_id' => $user->user_id,
            'kategori_nama' => $request->kategori_nama,
            'kategori_slug' => $slug,
            'kategori_deskripsi' => $request->kategori_deskripsi,
            'kategori_thumbnail' => $thumbnail,
            'kategori_meta_title' => $request->kategori_meta_title,
            'kategori_meta_description' => $request->kategori_meta_description,
            'kategori_is_active' => $request->has('kategori_is_active'),
            'kategori_is_visible' => $request->has('kategori_is_visible'),
            'kategori_sort_order' => $request->kategori_sort_order ?? 0,
        ]);

        return redirect()
            ->route('client.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = Auth::guard('arin')->user();

        $item = ModelKategori::where('user_id', $user->user_id)
            ->where('kategori_id', $id)
            ->firstOrFail();

        return view('client.kategori.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_nama' => 'required|string|max:150',
            'kategori_deskripsi' => 'nullable|string',
            'kategori_thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'kategori_meta_title' => 'nullable|string|max:255',
            'kategori_meta_description' => 'nullable|string',
            'kategori_sort_order' => 'nullable|integer',
        ]);

        $user = Auth::guard('arin')->user();

        $item = ModelKategori::where('user_id', $user->user_id)
            ->where('kategori_id', $id)
            ->firstOrFail();

        $slug = $item->kategori_slug;

        if ($request->kategori_nama !== $item->kategori_nama) {
            $baseSlug = Str::slug($request->kategori_nama);
            $slug = $baseSlug;
            $counter = 1;

            while (
                ModelKategori::where('user_id', $user->user_id)
                    ->where('kategori_slug', $slug)
                    ->where('kategori_id', '!=', $item->kategori_id)
                    ->exists()
            ) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }
        }

        $thumbnail = $item->kategori_thumbnail;

        if ($request->hasFile('kategori_thumbnail')) {
            $file = $request->file('kategori_thumbnail');
            $name = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/kategori'), $name);
            $thumbnail = 'uploads/kategori/' . $name;
        }

        $item->update([
            'kategori_nama' => $request->kategori_nama,
            'kategori_slug' => $slug,
            'kategori_deskripsi' => $request->kategori_deskripsi,
            'kategori_thumbnail' => $thumbnail,
            'kategori_meta_title' => $request->kategori_meta_title,
            'kategori_meta_description' => $request->kategori_meta_description,
            'kategori_is_active' => $request->has('kategori_is_active'),
            'kategori_is_visible' => $request->has('kategori_is_visible'),
            'kategori_sort_order' => $request->kategori_sort_order ?? 0,
        ]);

        return redirect()
            ->route('client.kategori.index')
            ->with('success', 'Kategori berhasil diupdate.');
    }

    public function toggle($id)
    {
        $user = Auth::guard('arin')->user();

        $item = ModelKategori::where('user_id', $user->user_id)
            ->where('kategori_id', $id)
            ->firstOrFail();

        $item->update([
            'kategori_is_active' => !$item->kategori_is_active,
        ]);

        return back()->with('success', 'Status kategori berhasil diubah.');
    }

    public function destroy($id)
    {
        $user = Auth::guard('arin')->user();

        $item = ModelKategori::where('user_id', $user->user_id)
            ->where('kategori_id', $id)
            ->firstOrFail();

        $item->delete();

        return back()->with('success', 'Kategori berhasil dihapus.');
    }
}