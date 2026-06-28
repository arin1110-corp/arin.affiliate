@extends('client.layouts.app')

@section('title', 'Setting Website')
@section('page_title', 'Setting Website')
@php
    $websiteUrl = 'https://' . $user->user_subdomain . '.' . config('app.domain');
@endphp

@section('content')

    @if (session('success'))
        <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-600 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-600 rounded-xl">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="lg:col-span-2">

            <form method="POST" action="{{ route('client.setting.update') }}" enctype="multipart/form-data"
                class="bg-white/80 backdrop-blur-xl border theme-border rounded-3xl shadow p-6 space-y-6">

                @csrf
                @method('PUT')

                <div>
                    <h2 class="text-xl font-bold">Identitas Website</h2>
                    <p class="text-sm text-gray-500">
                        Data ini akan tampil di halaman publik website affiliate kamu.
                    </p>
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-600">
                        Nama Website <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="user_brand_name"
                        value="{{ old('user_brand_name', $user->user_brand_name) }}"
                        class="w-full mt-1 p-3 rounded-xl border border-gray-200" required>
                </div>

                <div class="flex mt-1">
                    <input type="text" name="user_subdomain" value="{{ old('user_subdomain', $user->user_subdomain) }}"
                        class="flex-1 p-3 rounded-l-xl border border-gray-200" required>

                    <span class="px-4 py-3 bg-gray-100 border border-l-0 rounded-r-xl text-sm text-gray-500">
                        .{{ config('app.domain') }}
                    </span>
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-600">Tagline</label>
                    <input type="text" name="user_tagline" value="{{ old('user_tagline', $user->user_tagline) }}"
                        placeholder="Contoh: Rekomendasi Produk Pilihan"
                        class="w-full mt-1 p-3 rounded-xl border border-gray-200">
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-600">Deskripsi Website</label>
                    <textarea name="user_description" rows="4" placeholder="Tulis deskripsi singkat tentang website affiliate kamu."
                        class="w-full mt-1 p-3 rounded-xl border border-gray-200">{{ old('user_description', $user->user_description) }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div>
                        <label class="text-sm font-medium text-gray-600">Logo</label>
                        <input type="file" name="user_logo"
                            class="w-full mt-1 p-3 rounded-xl border border-gray-200 bg-white">

                        @if ($user->user_logo)
                            <img src="{{ asset($user->user_logo) }}" class="w-20 h-20 rounded-2xl object-cover mt-3">
                        @endif
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-600">Favicon</label>
                        <input type="file" name="user_favicon"
                            class="w-full mt-1 p-3 rounded-xl border border-gray-200 bg-white">

                        @if ($user->user_favicon)
                            <img src="{{ asset($user->user_favicon) }}" class="w-12 h-12 rounded-xl object-cover mt-3">
                        @endif
                    </div>

                </div>

                <div class="border-t pt-6">
                    <h2 class="text-xl font-bold">Kontak & Sosial Media</h2>
                    <p class="text-sm text-gray-500">
                        Opsional, isi jika ingin ditampilkan di footer dan header website.
                    </p>
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-600">WhatsApp</label>
                    <input type="text" name="user_whatsapp" value="{{ old('user_whatsapp', $user->user_whatsapp) }}"
                        placeholder="6281234567890" class="w-full mt-1 p-3 rounded-xl border border-gray-200">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div>
                        <label class="text-sm font-medium text-gray-600">Instagram</label>
                        <input type="text" name="user_instagram"
                            value="{{ old('user_instagram', $user->user_instagram) }}"
                            placeholder="https://instagram.com/username"
                            class="w-full mt-1 p-3 rounded-xl border border-gray-200">
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-600">TikTok</label>
                        <input type="text" name="user_tiktok" value="{{ old('user_tiktok', $user->user_tiktok) }}"
                            placeholder="https://tiktok.com/@username"
                            class="w-full mt-1 p-3 rounded-xl border border-gray-200">
                    </div>

                </div>

                <div class="border-t pt-6">
                    <h2 class="text-xl font-bold">Warna Website</h2>
                    <p class="text-sm text-gray-500">
                        Warna ini akan langsung mengubah tampilan website publik dan panel kamu.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                    <div>
                        <label class="text-sm font-medium text-gray-600">Warna Utama</label>
                        <input type="color" name="user_theme_primary"
                            value="{{ old('user_theme_primary', $user->user_theme_primary ?? '#ec4899') }}"
                            class="w-full h-12 rounded-xl border border-gray-200 bg-white">
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-600">Background</label>
                        <input type="color" name="user_theme_secondary"
                            value="{{ old('user_theme_secondary', $user->user_theme_secondary ?? '#fdf2f8') }}"
                            class="w-full h-12 rounded-xl border border-gray-200 bg-white">
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-600">Accent</label>
                        <input type="color" name="user_theme_accent"
                            value="{{ old('user_theme_accent', $user->user_theme_accent ?? '#f43f5e') }}"
                            class="w-full h-12 rounded-xl border border-gray-200 bg-white">
                    </div>

                </div>

                <details class="border border-gray-200 rounded-2xl p-4">
                    <summary class="cursor-pointer font-semibold text-gray-700">
                        Advanced SEO & Footer
                    </summary>

                    <div class="space-y-4 mt-4">

                        <div>
                            <label class="text-sm font-medium text-gray-600">Meta Title</label>
                            <input type="text" name="user_meta_title"
                                value="{{ old('user_meta_title', $user->user_meta_title) }}"
                                class="w-full mt-1 p-3 rounded-xl border border-gray-200">
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-600">Meta Description</label>
                            <textarea name="user_meta_description" rows="3" class="w-full mt-1 p-3 rounded-xl border border-gray-200">{{ old('user_meta_description', $user->user_meta_description) }}</textarea>
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-600">Footer Text</label>
                            <input type="text" name="user_footer_text"
                                value="{{ old('user_footer_text', $user->user_footer_text) }}"
                                placeholder="Contoh: Rekomendasi produk affiliate pilihan."
                                class="w-full mt-1 p-3 rounded-xl border border-gray-200">
                        </div>

                    </div>
                </details>

                <div class="flex flex-col sm:flex-row gap-3">
                    <button class="theme-button px-6 py-3 rounded-2xl">
                        Simpan Setting
                    </button>

                    <a href="{{ route('client.dashboard') }}"
                        class="bg-slate-100 text-slate-700 px-6 py-3 rounded-2xl text-center">
                        Kembali
                    </a>
                </div>

            </form>

        </div>

        <div>
            <div class="bg-white/80 backdrop-blur-xl border theme-border rounded-3xl shadow p-6 sticky top-6">

                <h3 class="text-lg font-bold mb-2">
                    Preview Link
                </h3>

                <p class="text-sm text-gray-500">
                    Link ini bisa kamu copy dan taruh di bio sosial media.
                </p>

                <div class="mt-4 theme-soft border theme-border p-4 rounded-2xl theme-text font-semibold break-all">
                    {{ 'https://' . $user->user_subdomain . '.' . config('app.domain') }}
                </div>

                <div class="flex flex-col gap-3 mt-4">
                    <a href="{{ $websiteUrl }}" target="_blank"
                        class="theme-button px-5 py-3 rounded-2xl text-center">
                        Lihat Website
                    </a>


                    <button type="button" onclick="copyLink('{{ $websiteUrl }}')"
                        class="bg-slate-100 text-slate-700 px-5 py-3 rounded-2xl text-center">
                        Copy Link
                    </button>
                </div>

                <div class="mt-6 border-t pt-5">
                    <h4 class="font-semibold text-sm text-gray-700">
                        Tips
                    </h4>

                    <p class="text-xs text-gray-400 mt-2">
                        Gunakan link pendek dan mudah diingat, misalnya:
                        parfum-bali, gadget-murah, atau skincare-viral.
                    </p>
                </div>

            </div>
        </div>

    </div>

    <script>
        function copyLink(url) {
            navigator.clipboard.writeText(url);
            alert('Link berhasil dicopy');
        }
    </script>

@endsection
