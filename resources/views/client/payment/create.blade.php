@extends('client.layouts.app')

@section('title', 'Pembayaran')
@section('page_title', 'Pembayaran')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-bold">Pembayaran</h1>
    <p class="text-sm text-gray-500 mt-1">
        Klik tombol bayar untuk membuka halaman pembayaran Midtrans.
    </p>
</div>

<div class="bg-white/80 backdrop-blur-xl border theme-border rounded-3xl shadow p-6 max-w-xl">

    <div class="theme-soft border theme-border rounded-2xl p-5">
        <p class="text-sm text-gray-500">Nominal Pembayaran</p>

        <h2 class="text-3xl font-bold theme-text mt-1">
            Rp {{ number_format($amount, 0, ',', '.') }}
        </h2>

        <p class="text-xs text-gray-500 mt-2">
            Paket: {{ ucfirst($user->user_package) }}
        </p>
    </div>

    <form method="POST"
          action="{{ route('client.payment.store') }}"
          class="mt-6">
        @csrf

        <button class="theme-button w-full px-6 py-3 rounded-2xl">
            Bayar Sekarang
        </button>
    </form>

    <a href="{{ route('client.payment.index') }}"
       class="block mt-3 bg-slate-100 text-slate-700 px-6 py-3 rounded-2xl text-center">
        Kembali
    </a>

</div>

@endsection