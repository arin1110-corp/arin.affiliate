@extends('client.layouts.app')

@section('title', 'Edit Kategori')
@section('page_title', 'Edit Kategori')

@section('content')

<form method="POST"
      action="{{ route('client.kategori.update', $item->kategori_id) }}"
      enctype="multipart/form-data"
      class="bg-white rounded-3xl shadow p-6 space-y-6">

    @csrf
    @method('PUT')

    <div>
        <label class="text-sm font-medium text-gray-600">Nama Kategori <span class="text-red-500">*</span></label>
        <input type="text"
               name="kategori_nama"
               value="{{ old('kategori_nama', $item->kategori_nama) }}"
               class="w-full mt-1 p-3 rounded-xl border border-gray-200"
               required>
    </div>

    <div>
        <label class="text-sm font-medium text-gray-600">Thumbnail</label>
        <input type="file"
               name="kategori_thumbnail"
               class="w-full mt-1 p-3 rounded-xl border border-gray-200 bg-white">

        @if($item->kategori_thumbnail)
            <img src="{{ asset($item->kategori_thumbnail) }}"
                 class="w-24 h-24 rounded-xl object-cover mt-3">
        @endif
    </div>

    <div>
        <label class="text-sm font-medium text-gray-600">Deskripsi</label>
        <textarea name="kategori_deskripsi"
                  rows="3"
                  class="w-full mt-1 p-3 rounded-xl border border-gray-200">{{ old('kategori_deskripsi', $item->kategori_deskripsi) }}</textarea>
    </div>

    <label class="flex items-center gap-2 bg-pink-50 border border-pink-100 rounded-2xl p-4">
        <input type="checkbox"
               name="kategori_is_visible"
               value="1"
               {{ $item->kategori_is_visible ? 'checked' : '' }}>
        <span class="text-sm text-gray-700">Tampilkan kategori di website</span>
    </label>

    <details class="border border-gray-200 rounded-2xl p-4">
        <summary class="cursor-pointer font-semibold text-gray-700">
            Advanced SEO & Urutan
        </summary>

        <div class="space-y-4 mt-4">

            <div>
                <label class="text-sm text-gray-600">Meta Title</label>
                <input type="text"
                       name="kategori_meta_title"
                       value="{{ old('kategori_meta_title', $item->kategori_meta_title) }}"
                       class="w-full mt-1 p-3 rounded-xl border border-gray-200">
            </div>

            <div>
                <label class="text-sm text-gray-600">Meta Description</label>
                <textarea name="kategori_meta_description"
                          rows="3"
                          class="w-full mt-1 p-3 rounded-xl border border-gray-200">{{ old('kategori_meta_description', $item->kategori_meta_description) }}</textarea>
            </div>

            <div>
                <label class="text-sm text-gray-600">Sort Order</label>
                <input type="number"
                       name="kategori_sort_order"
                       value="{{ old('kategori_sort_order', $item->kategori_sort_order) }}"
                       class="w-full mt-1 p-3 rounded-xl border border-gray-200">
            </div>

        </div>
    </details>

    <input type="hidden" name="kategori_is_active" value="{{ $item->kategori_is_active ? 1 : 0 }}">

    <button class="bg-pink-600 text-white px-6 py-3 rounded-2xl">
        Update Kategori
    </button>

</form>

@endsection