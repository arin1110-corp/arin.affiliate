@extends('admin.layouts.app')

@section('title', 'Landing Setting')
@section('page_title', 'Landing Setting')

@section('content')

@if(session('success'))
    <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-600 rounded-xl">
        {{ session('success') }}
    </div>
@endif

<form method="POST"
      action="{{ route('admin.landing.setting.update') }}"
      enctype="multipart/form-data"
      class="bg-white rounded-3xl p-6 shadow space-y-6">

    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        <div>
            <label class="text-sm text-gray-600">Site Name</label>
            <input type="text" name="site_name" value="{{ $landing->site_name }}"
                   class="w-full p-3 border rounded-xl">
        </div>

        <div>
            <label class="text-sm text-gray-600">Tagline</label>
            <input type="text" name="site_tagline" value="{{ $landing->site_tagline }}"
                   class="w-full p-3 border rounded-xl">
        </div>

        <div class="md:col-span-2">
            <label class="text-sm text-gray-600">Site Description</label>
            <textarea name="site_description" rows="3"
                      class="w-full p-3 border rounded-xl">{{ $landing->site_description }}</textarea>
        </div>

        <div>
            <label class="text-sm text-gray-600">Hero Title</label>
            <input type="text" name="hero_title" value="{{ $landing->hero_title }}"
                   class="w-full p-3 border rounded-xl">
        </div>

        <div>
            <label class="text-sm text-gray-600">CTA Text</label>
            <input type="text" name="cta_text" value="{{ $landing->cta_text }}"
                   class="w-full p-3 border rounded-xl">
        </div>

        <div class="md:col-span-2">
            <label class="text-sm text-gray-600">Hero Subtitle</label>
            <textarea name="hero_subtitle" rows="4"
                      class="w-full p-3 border rounded-xl">{{ $landing->hero_subtitle }}</textarea>
        </div>

        <div>
            <label class="text-sm text-gray-600">Hero Image</label>
            <input type="file" name="hero_image"
                   class="w-full p-3 border rounded-xl bg-white">

            @if($landing->hero_image)
                <img src="{{ asset($landing->hero_image) }}"
                     class="w-40 h-28 object-cover rounded-xl mt-3">
            @endif
        </div>

        <div>
            <label class="text-sm text-gray-600">WhatsApp Number</label>
            <input type="text" name="whatsapp_number" value="{{ $landing->whatsapp_number }}"
                   class="w-full p-3 border rounded-xl">
        </div>

        <div>
            <label class="text-sm text-gray-600">Primary Color</label>
            <input type="color" name="primary_color" value="{{ $landing->primary_color }}"
                   class="w-full h-12 border rounded-xl">
        </div>

        <div>
            <label class="text-sm text-gray-600">Secondary Color</label>
            <input type="color" name="secondary_color" value="{{ $landing->secondary_color }}"
                   class="w-full h-12 border rounded-xl">
        </div>

        <div>
            <label class="text-sm text-gray-600">Accent Color</label>
            <input type="color" name="accent_color" value="{{ $landing->accent_color }}"
                   class="w-full h-12 border rounded-xl">
        </div>

        <div class="md:col-span-2">
            <label class="text-sm text-gray-600">Features</label>
            <p class="text-xs text-gray-400 mb-2">Pisahkan tiap fitur dengan enter.</p>
            <textarea name="section_features" rows="6"
                      class="w-full p-3 border rounded-xl">{{ $landing->section_features }}</textarea>
        </div>

        <div class="md:col-span-2">
            <label class="text-sm text-gray-600">FAQ</label>
            <p class="text-xs text-gray-400 mb-2">
                Format: Pertanyaan|Jawaban. Satu FAQ per baris.
            </p>
            <textarea name="section_faq" rows="6"
                      class="w-full p-3 border rounded-xl">{{ $landing->section_faq }}</textarea>
        </div>

    </div>

    <button class="bg-pink-600 text-white px-6 py-3 rounded-2xl">
        Simpan Landing Page
    </button>

</form>

@endsection