@extends('admin.layouts.app')

@section('title', 'Edit Package')
@section('page_title', 'Edit Package')

@section('content')

@if($errors->any())
    <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-600 rounded-xl">
        {{ $errors->first() }}
    </div>
@endif

<form method="POST"
      action="{{ route('admin.package.update', $item->package_id) }}"
      class="bg-white rounded-3xl shadow p-6 space-y-6">

    @csrf
    @method('PUT')

    <div>
        <label class="text-sm text-gray-600">Nama Package</label>
        <input type="text"
               name="package_nama"
               value="{{ old('package_nama', $item->package_nama) }}"
               class="w-full mt-1 p-3 rounded-xl border"
               required>
    </div>

    <div>
        <label class="text-sm text-gray-600">Slug</label>
        <input type="text"
               value="{{ $item->package_slug }}"
               class="w-full mt-1 p-3 rounded-xl border bg-gray-100"
               readonly>
    </div>

    <div>
        <label class="text-sm text-gray-600">Deskripsi</label>
        <textarea name="package_deskripsi"
                  rows="3"
                  class="w-full mt-1 p-3 rounded-xl border">{{ old('package_deskripsi', $item->package_deskripsi) }}</textarea>
    </div>

    <div>
        <label class="text-sm text-gray-600">Fitur Package</label>
        <textarea name="package_fitur"
                  rows="6"
                  placeholder="Tulis satu fitur per baris"
                  class="w-full mt-1 p-3 rounded-xl border">{{ old('package_fitur', $item->package_fitur) }}</textarea>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label class="text-sm text-gray-600">Harga Normal</label>
            <input type="number"
                   name="package_harga_normal"
                   value="{{ old('package_harga_normal', $item->package_harga_normal) }}"
                   class="w-full mt-1 p-3 rounded-xl border"
                   required>
        </div>

        <div>
            <label class="text-sm text-gray-600">Harga Promo</label>
            <input type="number"
                   name="package_harga_promo"
                   value="{{ old('package_harga_promo', $item->package_harga_promo) }}"
                   class="w-full mt-1 p-3 rounded-xl border">
        </div>
    </div>

    <div>
        <label class="text-sm text-gray-600">Masa Aktif Hari</label>
        <input type="number"
               name="package_masa_aktif"
               value="{{ old('package_masa_aktif', $item->package_masa_aktif) }}"
               class="w-full mt-1 p-3 rounded-xl border"
               required>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <div>
            <label class="text-sm text-gray-600">Maks Produk</label>
            <input type="number"
                   name="package_max_product"
                   value="{{ old('package_max_product', $item->package_max_product) }}"
                   class="w-full mt-1 p-3 rounded-xl border"
                   required>
        </div>

        <div>
            <label class="text-sm text-gray-600">Maks Slider</label>
            <input type="number"
                   name="package_max_slider"
                   value="{{ old('package_max_slider', $item->package_max_slider) }}"
                   class="w-full mt-1 p-3 rounded-xl border"
                   required>
        </div>

        <div>
            <label class="text-sm text-gray-600">Maks Kategori</label>
            <input type="number"
                   name="package_max_category"
                   value="{{ old('package_max_category', $item->package_max_category) }}"
                   class="w-full mt-1 p-3 rounded-xl border"
                   required>
        </div>
    </div>

    <div>
        <label class="text-sm text-gray-600">Sort Order</label>
        <input type="number"
               name="package_sort_order"
               value="{{ old('package_sort_order', $item->package_sort_order) }}"
               class="w-full mt-1 p-3 rounded-xl border">
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <label class="flex items-center gap-2 bg-blue-50 border border-blue-100 rounded-2xl p-4">
            <input type="checkbox"
                   name="package_custom_domain"
                   value="1"
                   {{ old('package_custom_domain', $item->package_custom_domain) ? 'checked' : '' }}>
            <span>Custom Domain</span>
        </label>

        <label class="flex items-center gap-2 bg-purple-50 border border-purple-100 rounded-2xl p-4">
            <input type="checkbox"
                   name="package_remove_branding"
                   value="1"
                   {{ old('package_remove_branding', $item->package_remove_branding) ? 'checked' : '' }}>
            <span>Hapus Branding ARIN</span>
        </label>

        <label class="flex items-center gap-2 bg-green-50 border border-green-100 rounded-2xl p-4">
            <input type="checkbox"
                   name="package_google_analytics"
                   value="1"
                   {{ old('package_google_analytics', $item->package_google_analytics) ? 'checked' : '' }}>
            <span>Google Analytics</span>
        </label>

        <label class="flex items-center gap-2 bg-orange-50 border border-orange-100 rounded-2xl p-4">
            <input type="checkbox"
                   name="package_meta_pixel"
                   value="1"
                   {{ old('package_meta_pixel', $item->package_meta_pixel) ? 'checked' : '' }}>
            <span>Meta Pixel</span>
        </label>

        <label class="flex items-center gap-2 bg-green-50 border border-green-100 rounded-2xl p-4">
            <input type="checkbox"
                   name="package_is_active"
                   value="1"
                   {{ old('package_is_active', $item->package_is_active) ? 'checked' : '' }}>
            <span>Package Aktif</span>
        </label>

    </div>

    <div class="flex gap-3">
        <button class="bg-pink-500 text-white px-6 py-3 rounded-xl">
            Update Package
        </button>

        <a href="{{ route('admin.package.index') }}"
           class="bg-slate-100 text-slate-700 px-6 py-3 rounded-xl">
            Batal
        </a>
    </div>

</form>

@endsection