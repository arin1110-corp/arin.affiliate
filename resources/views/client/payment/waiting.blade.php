@extends('client.layouts.app')

@section('content')

<div class="max-w-2xl mx-auto">

    <div class="bg-white rounded-3xl shadow p-10 text-center">

        <div class="text-7xl">
            ⏳
        </div>

        <h1 class="text-3xl font-bold mt-5">
            Menunggu Verifikasi
        </h1>

        <p class="text-gray-500 mt-4">

            Pembayaran kamu sedang diperiksa admin.

        </p>

        <a
            href="{{ route('client.payment.history') }}"
            class="inline-block mt-8 px-8 py-3 bg-pink-600 text-white rounded-2xl">

            Riwayat Pembayaran

        </a>

    </div>

</div>

@endsection