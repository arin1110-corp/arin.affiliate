@extends('client.layouts.app')

@section('title', 'Edit Slider')
@section('page_title', 'Edit Slider')

@section('content')

<form method="POST"
      action="{{ route('client.slider.update', $item->slider_id) }}"
      enctype="multipart/form-data"
      class="bg-white/80 backdrop-blur-xl border theme-border rounded-3xl shadow p-6 space-y-6">

    @csrf
    @method('PUT')

    <div>
        <label class="text-sm font-medium text-gray-600">Judul Slider</label>
        <input type="text"
               name="slider_judul"
               value="{{ old('slider_judul', $item->slider_judul) }}"
               class="w-full mt-1 p-3 rounded-xl border border-gray-200">
    </div>

    <div>
        <label class="text-sm font-medium text-gray-600">Sub Judul</label>
        <textarea name="slider_subjudul"
                  rows="3"
                  class="w-full mt-1 p-3 rounded-xl border border-gray-200">{{ old('slider_subjudul', $item->slider_subjudul) }}</textarea>
    </div>

    <div>
        <label class="text-sm font-medium text-gray-600">Gambar Desktop</label>
        <input type="file"
               name="slider_image"
               class="w-full mt-1 p-3 rounded-xl border border-gray-200 bg-white">

        @if($item->slider_image)
            <img src="{{ asset($item->slider_image) }}"
                 class="w-56 h-28 rounded-xl object-cover mt-3">
        @endif
    </div>

    <div>
        <label class="text-sm font-medium text-gray-600">Gambar Mobile</label>
        <input type="file"
               name="slider_image_mobile"
               class="w-full mt-1 p-3 rounded-xl border border-gray-200 bg-white">

        @if($item->slider_image_mobile)
            <img src="{{ asset($item->slider_image_mobile) }}"
                 class="w-32 h-40 rounded-xl object-cover mt-3">
        @endif
    </div>

    <div>
        <label class="text-sm font-medium text-gray-600">Link Tujuan</label>
        <input type="text"
               name="slider_link"
               value="{{ old('slider_link', $item->slider_link) }}"
               class="w-full mt-1 p-3 rounded-xl border border-gray-200">
    </div>

    <details class="border border-gray-200 rounded-2xl p-4">
        <summary class="cursor-pointer font-semibold text-gray-700">
            Advanced
        </summary>

        <div class="mt-4">
            <label class="text-sm text-gray-600">Sort Order</label>
            <input type="number"
                   name="slider_sort_order"
                   value="{{ old('slider_sort_order', $item->slider_sort_order) }}"
                   class="w-full mt-1 p-3 rounded-xl border border-gray-200">
        </div>
    </details>

    <label class="flex items-center gap-2 bg-green-50 border border-green-100 rounded-2xl p-4">
        <input type="checkbox"
               name="slider_is_active"
               value="1"
               {{ $item->slider_is_active ? 'checked' : '' }}>
        <span class="text-sm text-gray-700">Tampilkan di Website</span>
    </label>

    <button class="theme-button px-6 py-3 rounded-2xl">
        Update Slider
    </button>

</form>

@endsection