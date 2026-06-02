@extends('client.layouts.app')

@section('title', 'Tambah Slider')
@section('page_title', 'Tambah Slider')

@section('content')

<form method="POST"
      action="{{ route('client.slider.store') }}"
      enctype="multipart/form-data"
      class="bg-white/80 backdrop-blur-xl border theme-border rounded-3xl shadow p-6 space-y-6">

    @csrf

    <div>
        <label class="text-sm font-medium text-gray-600">Judul Slider</label>
        <input type="text"
               name="slider_judul"
               value="{{ old('slider_judul') }}"
               placeholder="Contoh: Produk Pilihan Minggu Ini"
               class="w-full mt-1 p-3 rounded-xl border border-gray-200">
    </div>

    <div>
        <label class="text-sm font-medium text-gray-600">Sub Judul</label>
        <textarea name="slider_subjudul"
                  rows="3"
                  placeholder="Contoh: Temukan rekomendasi produk terbaik dengan harga menarik."
                  class="w-full mt-1 p-3 rounded-xl border border-gray-200">{{ old('slider_subjudul') }}</textarea>
    </div>

    <div>
        <label class="text-sm font-medium text-gray-600">Gambar Desktop</label>
        <input type="file"
               name="slider_image"
               class="w-full mt-1 p-3 rounded-xl border border-gray-200 bg-white">
        <p class="text-xs text-gray-400 mt-1">
            Opsional. Rekomendasi ukuran 1200x500px.
        </p>
    </div>

    <div>
        <label class="text-sm font-medium text-gray-600">Gambar Mobile</label>
        <input type="file"
               name="slider_image_mobile"
               class="w-full mt-1 p-3 rounded-xl border border-gray-200 bg-white">
        <p class="text-xs text-gray-400 mt-1">
            Opsional. Rekomendasi ukuran 800x900px.
        </p>
    </div>

    <div>
        <label class="text-sm font-medium text-gray-600">Link Tujuan</label>
        <input type="text"
               name="slider_link"
               value="{{ old('slider_link', '#produk') }}"
               placeholder="#produk atau https://..."
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
                   value="{{ old('slider_sort_order', 0) }}"
                   class="w-full mt-1 p-3 rounded-xl border border-gray-200">
        </div>
    </details>

    <label class="flex items-center gap-2 bg-green-50 border border-green-100 rounded-2xl p-4">
        <input type="checkbox"
               name="slider_is_active"
               value="1"
               checked>
        <span class="text-sm text-gray-700">Tampilkan di Website</span>
    </label>

    <button class="theme-button px-6 py-3 rounded-2xl">
        Simpan Slider
    </button>

</form>

@endsection