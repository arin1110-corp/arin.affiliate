@extends('admin.layouts.app')

@section('title', 'Detail Pembayaran')
@section('page_title', 'Detail Pembayaran')

@section('content')

<div class="bg-white rounded-3xl shadow p-6">

    <h2 class="text-xl font-bold mb-6">
        {{ $item->payment_invoice }}
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">

        <div>
            <p class="text-gray-500">User</p>
            <p class="font-semibold">{{ $item->user->user_nama ?? '-' }}</p>
            <p class="text-gray-400">{{ $item->user->user_email ?? '-' }}</p>
        </div>

        <div>
            <p class="text-gray-500">Order ID</p>
            <p class="font-semibold">{{ $item->midtrans_order_id }}</p>
        </div>

        <div>
            <p class="text-gray-500">Transaction ID</p>
            <p class="font-semibold">{{ $item->midtrans_transaction_id ?? '-' }}</p>
        </div>

        <div>
            <p class="text-gray-500">Payment Type</p>
            <p class="font-semibold">{{ $item->midtrans_payment_type ?? '-' }}</p>
        </div>

        <div>
            <p class="text-gray-500">Transaction Status</p>
            <p class="font-semibold">{{ $item->midtrans_transaction_status ?? '-' }}</p>
        </div>

        <div>
            <p class="text-gray-500">Fraud Status</p>
            <p class="font-semibold">{{ $item->midtrans_fraud_status ?? '-' }}</p>
        </div>

        <div>
            <p class="text-gray-500">Nominal</p>
            <p class="font-semibold text-xl">
                Rp {{ number_format($item->payment_amount, 0, ',', '.') }}
            </p>
        </div>

        <div>
            <p class="text-gray-500">Status ARIN</p>
            <p class="font-semibold">{{ $item->payment_status }}</p>
        </div>

        <div>
            <p class="text-gray-500">Paid At</p>
            <p class="font-semibold">{{ $item->paid_at?->format('d M Y H:i') ?? '-' }}</p>
        </div>

        <div>
            <p class="text-gray-500">Approved At</p>
            <p class="font-semibold">{{ $item->approved_at?->format('d M Y H:i') ?? '-' }}</p>
        </div>

    </div>

    <a href="{{ route('admin.payment.index') }}"
       class="inline-block mt-8 bg-slate-100 text-slate-700 px-5 py-3 rounded-2xl text-center">
        Kembali
    </a>

</div>

@endsection