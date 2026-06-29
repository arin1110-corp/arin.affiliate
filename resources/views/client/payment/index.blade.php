@extends('client.layouts.app')

@section('title', 'Pembayaran')
@section('page_title', 'Pembayaran')

@section('content')

<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

    <div>
        <h1 class="text-2xl font-bold">
            Pembayaran
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Riwayat pembayaran dan status langganan website.
        </p>
    </div>

    <a
        href="{{ route('client.payment.checkout') }}"
        class="theme-button px-5 py-3 rounded-2xl text-center font-medium">

        Bayar Sekarang

    </a>

</div>

@if(session('success'))
    <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white/80 backdrop-blur-xl border theme-border rounded-3xl shadow p-6 mb-6">

    <h3 class="text-lg font-bold mb-5">
        Status Langganan
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <div class="theme-soft border theme-border rounded-2xl p-5">

            <p class="text-sm text-gray-500">
                Paket
            </p>

            <h2 class="text-xl font-bold theme-text mt-1">
                {{ ucfirst($user->user_package) }}
            </h2>

        </div>

        <div class="theme-soft border theme-border rounded-2xl p-5">

            <p class="text-sm text-gray-500">
                Masa Aktif
            </p>

            <h2 class="text-xl font-bold theme-text mt-1">

                @if($user->user_expired_at)
                    {{ $user->user_expired_at->format('d M Y') }}
                @else
                    -
                @endif

            </h2>

        </div>

        <div class="theme-soft border theme-border rounded-2xl p-5">

            <p class="text-sm text-gray-500">
                Status
            </p>

            <h2 class="text-xl font-bold mt-1">

                @if($user->user_is_active)

                    <span class="text-green-600">
                        Aktif
                    </span>

                @else

                    <span class="text-red-500">
                        Belum Aktif
                    </span>

                @endif

            </h2>

        </div>

    </div>

</div>

<div class="bg-white/80 backdrop-blur-xl border theme-border rounded-3xl shadow overflow-hidden">

    <div class="p-6 border-b theme-border">

        <h3 class="font-bold text-lg">
            Riwayat Pembayaran
        </h3>

    </div>

    <div class="overflow-x-auto">

        <table class="w-full text-sm">

            <thead class="bg-gray-50">

                <tr>

                    <th class="text-left p-4">
                        Invoice
                    </th>

                    <th class="text-left p-4">
                        Paket
                    </th>

                    <th class="text-left p-4">
                        Nominal
                    </th>

                    <th class="text-left p-4">
                        Metode
                    </th>

                    <th class="text-left p-4">
                        Status
                    </th>

                    <th class="text-left p-4">
                        Tanggal
                    </th>

                    <th class="text-left p-4">
                        Bukti
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($data as $item)

                    <tr class="border-t">

                        <td class="p-4 font-medium">
                            {{ $item->payment_invoice }}
                        </td>

                        <td class="p-4">
                            {{ ucfirst($item->payment_package) }}
                        </td>

                        <td class="p-4 font-semibold theme-text">

                            Rp
                            {{ number_format($item->payment_amount,0,',','.') }}

                        </td>

                        <td class="p-4">

                            {{ $item->payment_method ?? '-' }}

                        </td>

                        <td class="p-4">

                            @if($item->payment_status == 'paid')

                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-xl text-xs">
                                    Lunas
                                </span>

                            @elseif($item->payment_status == 'pending')

                                <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-xl text-xs">
                                    Menunggu
                                </span>

                            @elseif($item->payment_status == 'rejected')

                                <span class="px-3 py-1 bg-red-100 text-red-700 rounded-xl text-xs">
                                    Ditolak
                                </span>

                            @else

                                <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-xl text-xs">
                                    Gagal
                                </span>

                            @endif

                        </td>

                        <td class="p-4">

                            {{ $item->created_at?->format('d M Y H:i') }}

                        </td>

                        <td class="p-4">

                            @if($item->payment_proof)

                                <a
                                    href="{{ asset($item->payment_proof) }}"
                                    target="_blank"
                                    class="theme-button px-3 py-2 rounded-xl text-xs">

                                    Lihat

                                </a>

                            @else

                                -

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="7"
                            class="text-center text-gray-400 py-16">

                            Belum ada riwayat pembayaran.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection