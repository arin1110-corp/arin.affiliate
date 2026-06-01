@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')

@php
    $totalClient = \App\Models\ModelUser::where('user_role', 'client')->count();
    $clientAktif = \App\Models\ModelUser::where('user_role', 'client')->where('user_is_active', true)->count();
    $starter = \App\Models\ModelUser::where('user_role', 'client')->where('user_package', 'starter')->count();
    $pro = \App\Models\ModelUser::where('user_role', 'client')->where('user_package', 'pro')->count();
    $promoUsed = \App\Models\ModelUser::where('user_role', 'client')
        ->where('user_is_promo', true)
        ->count();

    $promoRemaining = max(0, 1000 - $promoUsed);
@endphp

<div class="grid grid-cols-1 md:grid-cols-4 gap-6">

    <div class="bg-white p-6 rounded-3xl shadow">
        <p class="text-sm text-gray-500">Total Client</p>
        <h2 class="text-3xl font-bold text-pink-600">{{ $totalClient }}</h2>
    </div>

    <div class="bg-white p-6 rounded-3xl shadow">
        <p class="text-sm text-gray-500">Client Aktif</p>
        <h2 class="text-3xl font-bold text-green-600">{{ $clientAktif }}</h2>
    </div>

    <div class="bg-white p-6 rounded-3xl shadow">
        <p class="text-sm text-gray-500">Starter</p>
        <h2 class="text-3xl font-bold text-blue-600">{{ $starter }}</h2>
    </div>

    <div class="bg-white p-6 rounded-3xl shadow">
        <p class="text-sm text-gray-500">Pro</p>
        <h2 class="text-3xl font-bold text-yellow-600">{{ $pro }}</h2>
    </div>

</div>

<div class="mt-8 bg-white rounded-3xl shadow p-6">
    <h3 class="text-xl font-bold mb-2">
        ARIN Super Admin
    </h3>

    <p class="text-gray-500">
        Kamu bisa mulai mengelola client, paket, pembayaran, dan website affiliate dari panel ini.
    </p>
</div>
<div class="mt-8 bg-white rounded-3xl shadow p-6">
    <h3 class="text-xl font-bold mb-2">
        Promo 1.000 Pengguna Pertama
    </h3>

    <p class="text-gray-500">
        Terpakai: <b>{{ $promoUsed }}</b> / 1000
    </p>

    <p class="text-gray-500">
        Sisa slot promo: <b>{{ $promoRemaining }}</b>
    </p>
</div>

@endsection