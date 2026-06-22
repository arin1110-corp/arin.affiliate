@extends('admin.layouts.app')

@section('title', 'Tambah Package')
@section('page_title', 'Tambah Package')

@section('content')

@if($errors->any())
    <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-600 rounded-xl">
        {{ $errors->first() }}
    </div>
@endif

<form method="POST"
      action="{{ route('admin.package.store') }}"
      class="bg-white rounded-3xl shadow p-6 space-y-6">

    @csrf

    <div>
        <label class="text-sm text-gray-600">Nama Package</label>
        <input type="text"
               name="package_nama"
               value="{{ old('package_nama') }}"
               class="w-full mt-1 p-3 rounded-xl border"
               required>
    </div>

    <div>
        <label class="text-sm text-gray-600">Deskripsi</label>
        <textarea name="package_deskripsi"
                  rows="3"
                  class="w-full mt-1 p-3 rounded-xl border">{{ old('package_deskripsi') }}</textarea>
    </div>

    <div>
        <label class="text-sm text-gray-600">Fitur Package</label>
        <textarea name="package_fitur"
                  rows="6"
                  placeholder="Tulis satu fitur per baris"
                  class="w-full mt-1 p-3 rounded-xl border">{{ old('package_fitur') }}</textarea>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label class="text-sm text-gray-600">Harga Normal</label>
            <input type="number"
                   name="package_harga_normal"
                   value="{{ old('package_harga_normal', 49900) }}"
                   class="w-full mt-1 p-3 rounded-xl border"
                   required>
        </div>

        <div>
            <label class="text-sm text-gray-600">Harga Promo</label>
            <input type="number"
                   name="package_harga_promo"
                   value="{{ old('package_harga_promo') }}"
                   class="w-full mt-1 p-3 rounded-xl border">
        </div>
    </div>

    <div>
        <label class="text-sm text-gray-600">Masa Aktif Hari</label>
        <input type="number"
               name="package_masa_aktif"
               value="{{ old('package_masa_aktif', 30) }}"
               class="w-full mt-1 p-3 rounded-xl border"
               required>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <div>
            <label class="text-sm text-gray-600">Maks Produk</label>
            <input type="number"
                   name="package_max_product"
                   value="{{ old('package_max_product', 100) }}"
                   class="w-full mt-1 p-3 rounded-xl border"
                   required>
        </div>

        <div>
            <label class="text-sm text-gray-600">Maks Slider</label>
            <input type="number"
                   name="package_max_slider"
                   value="{{ old('package_max_slider', 5) }}"
                   class="w-full mt-1 p-3 rounded-xl border"
                   required>
        </div>

        <div>
            <label class="text-sm text-gray-600">Maks Kategori</label>
            <input type="number"
                   name="package_max_category"
                   value="{{ old('package_max_category', 20) }}"
                   class="w-full mt-1 p-3 rounded-xl border"
                   required>
        </div>
    </div>

    <div>
        <label class="text-sm text-gray-600">Sort Order</label>
        <input type="number"
               name="package_sort_order"
               value="{{ old('package_sort_order', 0) }}"
               class="w-full mt-1 p-3 rounded-xl border">
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <label class="flex items-center gap-2 bg-blue-50 border border-blue-100 rounded-2xl p-4">
            <input type="checkbox" name="package_custom_domain" value="1">
            <span>Custom Domain</span>
        </label>

        <label class="flex items-center gap-2 bg-purple-50 border border-purple-100 rounded-2xl p-4">
            <input type="checkbox" name="package_remove_branding" value="1">
            <span>Hapus Branding ARIN</span>
        </label>

        <label class="flex items-center gap-2 bg-green-50 border border-green-100 rounded-2xl p-4">
            <input type="checkbox" name="package_google_analytics" value="1">
            <span>Google Analytics</span>
        </label>

        <label class="flex items-center gap-2 bg-orange-50 border border-orange-100 rounded-2xl p-4">
            <input type="checkbox" name="package_meta_pixel" value="1">
            <span>Meta Pixel</span>
        </label>

        <label class="flex items-center gap-2 bg-green-50 border border-green-100 rounded-2xl p-4">
            <input type="checkbox" name="package_is_active" value="1" checked>
            <span>Package Aktif</span>
        </label>

    </div>

    <div class="flex gap-3">
        <button class="bg-pink-500 text-white px-6 py-3 rounded-xl">
            Simpan Package
        </button>

        <a href="{{ route('admin.package.index') }}"
           class="bg-slate-100 text-slate-700 px-6 py-3 rounded-xl">
            Batal
        </a>
    </div>

</form>

@endsection