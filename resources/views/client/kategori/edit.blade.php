@extends('client.layouts.app')

@section('title', 'Edit Kategori')
@section('page_title', 'Edit Kategori')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-bold">Edit Kategori</h1>

    <p class="text-sm text-gray-500 mt-1">
        Perbarui informasi kategori yang tampil di website kamu.
    </p>
</div>

@if($errors->any())
    <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-600 rounded-xl">
        {{ $errors->first() }}
    </div>
@endif

<form method="POST"
      action="{{ route('client.kategori.update', $item->kategori_id) }}"
      enctype="multipart/form-data"
      class="bg-white/80 backdrop-blur-xl border theme-border rounded-3xl shadow p-6 space-y-6">

    @csrf
    @method('PUT')

    <div>
        <label class="text-sm font-medium text-gray-600">
            Nama Kategori <span class="text-red-500">*</span>
        </label>

        <input type="text"
               name="kategori_nama"
               value="{{ old('kategori_nama', $item->kategori_nama) }}"
               class="w-full mt-1 p-3 rounded-xl border border-gray-200"
               required>
    </div>

    <div>
        <label class="text-sm font-medium text-gray-600">
            Thumbnail
        </label>

        <input type="file"
               name="kategori_thumbnail"
               class="w-full mt-1 p-3 rounded-xl border border-gray-200 bg-white">

        @if($item->kategori_thumbnail)
            <div class="mt-4">
                <img src="{{ asset($item->kategori_thumbnail) }}"
                     class="w-28 h-28 rounded-2xl object-cover border">
            </div>
        @endif

        <p class="text-xs text-gray-400 mt-2">
            Kosongkan jika tidak ingin mengganti gambar.
        </p>
    </div>

    <div>
        <label class="text-sm font-medium text-gray-600">
            Deskripsi
        </label>

        <textarea name="kategori_deskripsi"
                  rows="4"
                  class="w-full mt-1 p-3 rounded-xl border border-gray-200">{{ old('kategori_deskripsi', $item->kategori_deskripsi) }}</textarea>
    </div>

    <label class="flex items-center gap-3 theme-soft border theme-border rounded-2xl p-4">
        <input type="checkbox"
               name="kategori_is_visible"
               value="1"
               {{ $item->kategori_is_visible ? 'checked' : '' }}>

        <span class="text-sm text-gray-700">
            Tampilkan kategori di website
        </span>
    </label>

    <details class="border border-gray-200 rounded-2xl p-4">

        <summary class="cursor-pointer font-semibold text-gray-700">
            Pengaturan Lanjutan
        </summary>

        <div class="mt-4">

            <label class="text-sm text-gray-600">
                Urutan Tampil
            </label>

            <input type="number"
                   name="kategori_sort_order"
                   value="{{ old('kategori_sort_order', $item->kategori_sort_order) }}"
                   class="w-full mt-1 p-3 rounded-xl border border-gray-200">

            <p class="text-xs text-gray-400 mt-2">
                Angka lebih kecil akan tampil lebih dahulu.
            </p>

        </div>

    </details>

    <input type="hidden"
           name="kategori_is_active"
           value="{{ $item->kategori_is_active ? 1 : 0 }}">

    <div class="flex flex-col sm:flex-row gap-3">

        <button class="theme-button px-6 py-3 rounded-2xl">
            Update Kategori
        </button>

        <a href="{{ route('client.kategori.index') }}"
           class="bg-slate-100 text-slate-700 px-6 py-3 rounded-2xl text-center">
            Kembali
        </a>

    </div>

</form>

@endsection