@extends('client.layouts.app')

@section('title', 'Edit Produk')
@section('page_title', 'Edit Produk')

@section('content')

<form method="POST"
      action="{{ route('client.product.update', $item->product_id) }}"
      enctype="multipart/form-data"
      class="bg-white rounded-3xl shadow p-6 space-y-6">

    @csrf
    @method('PUT')

    <div>
        <label class="text-sm font-medium text-gray-600">
            Nama Produk <span class="text-red-500">*</span>
        </label>
        <input type="text"
               name="product_nama"
               value="{{ old('product_nama', $item->product_nama) }}"
               class="w-full mt-1 p-3 rounded-xl border border-gray-200"
               required>
    </div>

    <div>
        <label class="text-sm font-medium text-gray-600">Kategori</label>
        <select name="product_kategori"
                class="w-full mt-1 p-3 rounded-xl border border-gray-200 bg-white">
            <option value="">Tanpa Kategori</option>

            @foreach($kategori as $kat)
                <option value="{{ $kat->kategori_id }}"
                    {{ old('product_kategori', $item->product_kategori) == $kat->kategori_id ? 'selected' : '' }}>
                    {{ $kat->kategori_nama }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="text-sm font-medium text-gray-600">Harga</label>
        <input type="number"
               name="product_harga"
               value="{{ old('product_harga', $item->product_harga) }}"
               class="w-full mt-1 p-3 rounded-xl border border-gray-200">
    </div>

    <div>
        <label class="text-sm font-medium text-gray-600">
            Link Affiliate <span class="text-red-500">*</span>
        </label>
        <input type="text"
               name="product_affiliate_link"
               value="{{ old('product_affiliate_link', $item->product_affiliate_link) }}"
               class="w-full mt-1 p-3 rounded-xl border border-gray-200"
               required>
    </div>

    <div>
        <label class="text-sm font-medium text-gray-600">Foto Produk</label>
        <input type="file"
               name="product_thumbnail"
               class="w-full mt-1 p-3 rounded-xl border border-gray-200 bg-white">

        @if($item->product_thumbnail)
            <img src="{{ asset($item->product_thumbnail) }}"
                 class="w-24 h-24 rounded-xl object-cover mt-3">
        @endif
    </div>

    <div>
        <label class="text-sm font-medium text-gray-600">Deskripsi</label>
        <textarea name="product_deskripsi"
                  rows="4"
                  class="w-full mt-1 p-3 rounded-xl border border-gray-200">{{ old('product_deskripsi', $item->product_deskripsi) }}</textarea>
    </div>

    <div class="flex gap-6">
        <label class="flex items-center gap-2 bg-pink-50 border border-pink-100 rounded-2xl p-4">
            <input type="checkbox"
                   name="product_featured"
                   value="1"
                   {{ $item->product_featured ? 'checked' : '' }}>
            <span class="text-sm text-gray-700">Produk Unggulan</span>
        </label>

        <label class="flex items-center gap-2 bg-green-50 border border-green-100 rounded-2xl p-4">
            <input type="checkbox"
                   name="product_status"
                   value="active"
                   {{ $item->product_status === 'active' ? 'checked' : '' }}>
            <span class="text-sm text-gray-700">Tampilkan di Website</span>
        </label>
    </div>

    <button class="bg-pink-600 text-white px-6 py-3 rounded-2xl">
        Update Produk
    </button>

</form>

@endsection