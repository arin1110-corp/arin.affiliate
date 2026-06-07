@extends('admin.layouts.app')

@section('title', 'Pembayaran')
@section('page_title', 'Pembayaran')

@section('content')

<div class="flex justify-between mb-6">
    <h1 class="text-2xl font-bold">Pembayaran</h1>
</div>

@if(session('success'))
    <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-600 rounded-xl">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-3xl shadow p-4 overflow-x-auto">

    <table class="w-full text-sm">
        <thead>
            <tr class="text-left border-b">
                <th class="p-3">Invoice</th>
                <th class="p-3">Order ID</th>
                <th class="p-3">User</th>
                <th class="p-3">Nominal</th>
                <th class="p-3">Metode</th>
                <th class="p-3">Status</th>
                <th class="p-3">Tanggal</th>
                <th class="p-3">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($data as $item)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3 font-medium">
                        {{ $item->payment_invoice }}
                    </td>

                    <td class="p-3 text-xs text-gray-500">
                        {{ $item->midtrans_order_id }}
                    </td>

                    <td class="p-3">
                        <div class="font-semibold">
                            {{ $item->user->user_nama ?? '-' }}
                        </div>
                        <div class="text-xs text-gray-400">
                            {{ $item->user->user_email ?? '-' }}
                        </div>
                    </td>

                    <td class="p-3 font-semibold">
                        Rp {{ number_format($item->payment_amount, 0, ',', '.') }}
                    </td>

                    <td class="p-3">
                        {{ $item->midtrans_payment_type ?? '-' }}
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
                        <a href="{{ route('admin.payment.show', $item->payment_id) }}"
                           class="px-3 py-1 bg-blue-100 text-blue-600 rounded-xl text-xs">
                            Detail
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="p-10 text-center text-gray-400">
                        Belum ada pembayaran.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection