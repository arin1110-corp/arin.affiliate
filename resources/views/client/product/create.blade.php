@extends('client.layouts.app')

@section('title', 'Tambah Produk')
@section('page_title', 'Tambah Produk')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-bold">Tambah Produk</h1>
    <p class="text-sm text-gray-500 mt-1">
        Tambahkan produk affiliate dan link marketplace kamu.
    </p>
</div>

@if($errors->any())
    <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-600 rounded-xl">
        {{ $errors->first() }}
    </div>
@endif

<form method="POST"
      action="{{ route('client.product.store') }}"
      enctype="multipart/form-data"
      class="bg-white/80 backdrop-blur-xl border theme-border rounded-3xl shadow p-6 space-y-6">

    @csrf

    <div>
        <label class="text-sm font-medium text-gray-600">
            Nama Produk <span class="text-red-500">*</span>
        </label>
        <input type="text"
               name="product_nama"
               value="{{ old('product_nama') }}"
               placeholder="Contoh: Parfum Premium Original"
               class="w-full mt-1 p-3 rounded-xl border border-gray-200"
               required>
    </div>

    <div>
        <label class="text-sm font-medium text-gray-600">Kategori</label>
        <select name="product_kategori"
                class="w-full mt-1 p-3 rounded-xl border border-gray-200 bg-white">
            <option value="">Tanpa Kategori</option>

            @foreach($kategori as $item)
                <option value="{{ $item->kategori_id }}"
                    {{ old('product_kategori') == $item->kategori_id ? 'selected' : '' }}>
                    {{ $item->kategori_nama }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="text-sm font-medium text-gray-600">Harga</label>
        <input type="number"
               name="product_harga"
               value="{{ old('product_harga') }}"
               placeholder="99000"
               class="w-full mt-1 p-3 rounded-xl border border-gray-200">
        <p class="text-xs text-gray-400 mt-1">
            Isi angka saja, contoh: 99000.
        </p>
    </div>

    <div>
        <label class="text-sm font-medium text-gray-600">
            Link Affiliate <span class="text-red-500">*</span>
        </label>
        <input type="text"
               name="product_affiliate_link"
               value="{{ old('product_affiliate_link') }}"
               placeholder="https://shopee.co.id/..."
               class="w-full mt-1 p-3 rounded-xl border border-gray-200"
               required>
        <p class="text-xs text-gray-400 mt-1">
            Masukkan link affiliate Shopee, TikTok Shop, Tokopedia, atau marketplace lain.
        </p>
    </div>

    <div>
        <label class="text-sm font-medium text-gray-600">Foto Produk</label>
        <input type="file"
               name="product_thumbnail"
               class="w-full mt-1 p-3 rounded-xl border border-gray-200 bg-white">
        <p class="text-xs text-gray-400 mt-1">
            Opsional. Rekomendasi gambar kotak 800x800px.
        </p>
    </div>

    <div>
        <label class="text-sm font-medium text-gray-600">Deskripsi</label>
        <textarea name="product_deskripsi"
                  rows="4"
                  placeholder="Tulis deskripsi singkat produk."
                  class="w-full mt-1 p-3 rounded-xl border border-gray-200">{{ old('product_deskripsi') }}</textarea>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <label class="flex items-center gap-3 theme-soft border theme-border rounded-2xl p-4">
            <input type="checkbox"
                   name="product_featured"
                   value="1"
                   {{ old('product_featured') ? 'checked' : '' }}>
            <span class="text-sm text-gray-700">Jadikan Produk Unggulan</span>
        </label>

        <label class="flex items-center gap-3 bg-green-50 border border-green-100 rounded-2xl p-4">
            <input type="checkbox"
                   name="product_status"
                   value="active"
                   checked>
            <span class="text-sm text-gray-700">Tampilkan di Website</span>
        </label>

    </div>

    <div class="flex flex-col sm:flex-row gap-3">
        <button class="theme-button px-6 py-3 rounded-2xl">
            Simpan Produk
        </button>

        <a href="{{ route('client.product.index') }}"
           class="bg-slate-100 text-slate-700 px-6 py-3 rounded-2xl text-center">
            Batal
        </a>
    </div>

</form>

@endsection