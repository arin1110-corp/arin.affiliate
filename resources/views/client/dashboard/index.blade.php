@extends('client.layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard Client')

@section('content')

@php
    $user = auth('arin')->user();

    $publicUrl = url('/' . $user->user_slug);

    $isTrialActive = $user->user_is_trial
        && $user->user_trial_end_at
        && now()->lessThanOrEqualTo($user->user_trial_end_at);

    $isPromoActive = $user->user_is_promo
        && $user->user_promo_until
        && now()->lessThanOrEqualTo($user->user_promo_until);

    $totalKategori = \App\Models\ModelKategori::where('user_id', $user->user_id)->count();
    $totalProduk = \App\Models\ModelProduct::where('user_id', $user->user_id)->count();
    $totalSlider = \App\Models\ModelSlider::where('user_id', $user->user_id)->count();
    $totalClick = \App\Models\ModelProduct::where('user_id', $user->user_id)->sum('product_total_click');
@endphp

@if(session('success'))
    <div class="mb-6 bg-green-50 border border-green-200 text-green-600 p-4 rounded-2xl">
        {{ session('success') }}
    </div>
@endif

@if($isTrialActive)
    <div class="mb-6 bg-yellow-50 border border-yellow-200 text-yellow-700 p-5 rounded-3xl">
        <h3 class="font-bold text-lg">
            Website kamu masih dalam masa trial
        </h3>

        <p class="text-sm mt-1">
            Trial aktif sampai:
            <b>{{ $user->user_trial_end_at->format('d M Y H:i') }}</b>
        </p>

        <p class="text-sm mt-2">
            Aktifkan paket sebelum masa trial berakhir agar website tetap aktif.
        </p>

        <button class="mt-4 bg-yellow-500 text-white px-5 py-3 rounded-2xl">
            Aktifkan Sekarang
        </button>
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-4 gap-6">

    <div class="bg-white/80 backdrop-blur-xl p-6 rounded-3xl shadow border theme-border">
        <p class="text-sm text-gray-500">Paket</p>
        <h2 class="text-3xl font-bold theme-text">
            {{ ucfirst($user->user_package) }}
        </h2>
    </div>

    <div class="bg-white/80 backdrop-blur-xl p-6 rounded-3xl shadow border theme-border">
        <p class="text-sm text-gray-500">Status</p>
        <h2 class="text-3xl font-bold text-green-600">
            {{ $user->user_is_active ? 'Aktif' : 'Nonaktif' }}
        </h2>
    </div>

    <div class="bg-white/80 backdrop-blur-xl p-6 rounded-3xl shadow border theme-border">
        <p class="text-sm text-gray-500">Expired</p>
        <h2 class="text-lg font-bold text-slate-700">
            {{ $user->user_expired_at ? $user->user_expired_at->format('d M Y') : '-' }}
        </h2>
    </div>

    <div class="bg-white/80 backdrop-blur-xl p-6 rounded-3xl shadow border theme-border">
        <p class="text-sm text-gray-500">Harga Aktif</p>
        <h2 class="text-xl font-bold theme-text">
            Rp {{ number_format($user->current_price, 0, ',', '.') }}
        </h2>
    </div>

</div>

<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-6">

    <div class="bg-white/80 backdrop-blur-xl p-6 rounded-3xl shadow border theme-border">
        <p class="text-sm text-gray-500">Kategori</p>
        <h2 class="text-3xl font-bold theme-text">
            {{ $totalKategori }}
        </h2>
    </div>

    <div class="bg-white/80 backdrop-blur-xl p-6 rounded-3xl shadow border theme-border">
        <p class="text-sm text-gray-500">Produk</p>
        <h2 class="text-3xl font-bold theme-text">
            {{ $totalProduk }}
        </h2>
    </div>

    <div class="bg-white/80 backdrop-blur-xl p-6 rounded-3xl shadow border theme-border">
        <p class="text-sm text-gray-500">Slider</p>
        <h2 class="text-3xl font-bold theme-text">
            {{ $totalSlider }}
        </h2>
    </div>

    <div class="bg-white/80 backdrop-blur-xl p-6 rounded-3xl shadow border theme-border">
        <p class="text-sm text-gray-500">Total Click</p>
        <h2 class="text-3xl font-bold theme-text">
            {{ number_format($totalClick) }}
        </h2>
    </div>

</div>

@if($user->user_is_promo)
    <div class="mt-8 border rounded-3xl p-6 theme-soft theme-border">
        <h3 class="text-xl font-bold theme-text">
            Kamu termasuk pengguna promo batch {{ $user->user_promo_batch }}
        </h3>

        <p class="text-gray-600 mt-2">
            Harga promo:
            <b>Rp {{ number_format($user->user_promo_price, 0, ',', '.') }}/bulan</b>
            berlaku sampai
            <b>{{ $user->user_promo_until?->format('d M Y') }}</b>.
        </p>

        <p class="text-sm text-gray-500 mt-2">
            Setelah masa promo berakhir, harga mengikuti harga normal paket Starter.
        </p>
    </div>
@endif

<div class="mt-8 bg-white/80 backdrop-blur-xl rounded-3xl shadow border theme-border p-6">
    <h3 class="text-xl font-bold mb-2">
        Link Website Kamu
    </h3>

    <p class="text-gray-500">
        Copy link ini dan taruh di bio Instagram, TikTok, YouTube, atau media sosial kamu.
    </p>

    <div class="mt-4 theme-soft border theme-border p-4 rounded-2xl theme-text font-semibold break-all">
        {{ $publicUrl }}
    </div>

    <div class="flex flex-col sm:flex-row gap-3 mt-4">
        <a href="{{ $publicUrl }}"
           target="_blank"
           class="inline-block theme-button px-5 py-3 rounded-2xl text-center">
            Lihat Website
        </a>

        <button onclick="copyLink('{{ $publicUrl }}')"
                class="inline-block bg-slate-100 text-slate-700 px-5 py-3 rounded-2xl text-center">
            Copy Link
        </button>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">

    <a href="{{ route('client.kategori.create') }}"
       class="bg-white/80 backdrop-blur-xl rounded-3xl shadow border theme-border p-6 hover:shadow-lg transition">
        <h3 class="font-bold text-lg theme-text">Tambah Kategori</h3>
        <p class="text-sm text-gray-500 mt-2">
            Buat kategori produk affiliate kamu.
        </p>
    </a>

    <a href="{{ route('client.product.create') }}"
       class="bg-white/80 backdrop-blur-xl rounded-3xl shadow border theme-border p-6 hover:shadow-lg transition">
        <h3 class="font-bold text-lg theme-text">Tambah Produk</h3>
        <p class="text-sm text-gray-500 mt-2">
            Tambahkan produk dan link affiliate.
        </p>
    </a>

    <a href="{{ route('client.slider.create') }}"
       class="bg-white/80 backdrop-blur-xl rounded-3xl shadow border theme-border p-6 hover:shadow-lg transition">
        <h3 class="font-bold text-lg theme-text">Tambah Slider</h3>
        <p class="text-sm text-gray-500 mt-2">
            Buat banner utama di website kamu.
        </p>
    </a>

</div>

<script>
    function copyLink(url) {
        navigator.clipboard.writeText(url);
        alert('Link berhasil dicopy');
    }
</script>

@endsection