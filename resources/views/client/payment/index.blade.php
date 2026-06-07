@extends('client.layouts.app')

@section('title', 'Pembayaran')
@section('page_title', 'Pembayaran')

@section('content')

<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold">Pembayaran</h1>
        <p class="text-sm text-gray-500 mt-1">
            Riwayat pembayaran ARIN.
        </p>
    </div>

    <a href="{{ route('client.payment.create') }}"
       class="theme-button px-4 py-3 rounded-2xl text-center font-medium">
        Bayar Sekarang
    </a>
</div>

@if(session('success'))
    <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-600 rounded-xl">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white/80 backdrop-blur-xl border theme-border rounded-3xl shadow p-6 mb-6">

    <h3 class="text-lg font-bold mb-4">Status Website</h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <div class="theme-soft border theme-border rounded-2xl p-4">
            <p class="text-sm text-gray-500">Paket</p>
            <h2 class="text-xl font-bold theme-text">
                {{ ucfirst($user->user_package) }}
            </h2>
        </div>

        <div class="theme-soft border theme-border rounded-2xl p-4">
            <p class="text-sm text-gray-500">Expired</p>
            <h2 class="text-xl font-bold theme-text">
                {{ $user->user_expired_at ? $user->user_expired_at->format('d M Y') : '-' }}
            </h2>
        </div>

        <div class="theme-soft border theme-border rounded-2xl p-4">
            <p class="text-sm text-gray-500">Status</p>
            <h2 class="text-xl font-bold theme-text">
                {{ $user->user_is_active ? 'Aktif' : 'Nonaktif' }}
            </h2>
        </div>

    </div>

</div>

<div class="bg-white/80 backdrop-blur-xl border theme-border rounded-3xl shadow p-4 overflow-x-auto">

    <table class="w-full text-sm">
        <thead>
            <tr class="text-left border-b">
                <th class="p-3">Invoice</th>
                <th class="p-3">Paket</th>
                <th class="p-3">Nominal</th>
                <th class="p-3">Metode</th>
                <th class="p-3">Status</th>
                <th class="p-3">Tanggal</th>
                <th class="p-3">Link</th>
            </tr>
        </thead>

        <tbody>
            @forelse($data as $item)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3 font-medium">
                        {{ $item->payment_invoice }}
                    </td>

                    <td class="p-3">
                        {{ ucfirst($item->payment_package) }}
                    </td>

                    <td class="p-3 font-semibold theme-text">
                        Rp {{ number_format($item->payment_amount, 0, ',', '.') }}
                    </td>

                    <td class="p-3">
                        {{ $item->midtrans_payment_type ?? $item->payment_method ?? '-' }}
                    </td>

                    <td class="p-3">
                        @if($item->payment_status === 'approved')
                            <span class="px-2 py-1 text-xs bg-green-100 text-green-600 rounded-xl">
                                Lunas
                            </span>
                        @elseif($item->payment_status === 'rejected')
                            <span class="px-2 py-1 text-xs bg-red-100 text-red-600 rounded-xl">
                                Gagal
                            </span>
                        @else
                            <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-700 rounded-xl">
                                Menunggu
                            </span>
                        @endif
                    </td>

                    <td class="p-3">
                        {{ $item->created_at->format('d M Y H:i') }}
                    </td>

                    <td class="p-3">
                        @if($item->payment_status !== 'approved' && $item->midtrans_redirect_url)
                            <a href="{{ $item->midtrans_redirect_url }}"
                               target="_blank"
                               class="px-3 py-1 theme-button rounded-xl text-xs">
                                Bayar
                            </a>
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="p-10 text-center text-gray-400">
                        Belum ada riwayat pembayaran.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection