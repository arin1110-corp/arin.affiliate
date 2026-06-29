@extends('admin.layouts.app')

@section('content')

<div class="space-y-6">

    <div class="flex justify-between items-center">

        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Pembayaran
            </h1>

            <p class="text-slate-500 mt-2">
                Verifikasi pembayaran pelanggan.
            </p>
        </div>

    </div>

    <div class="bg-white rounded-3xl shadow overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-50">

                    <tr class="text-left text-sm text-slate-500">

                        <th class="px-6 py-4">
                            User
                        </th>

                        <th class="px-6 py-4">
                            Invoice
                        </th>

                        <th class="px-6 py-4">
                            Paket
                        </th>

                        <th class="px-6 py-4">
                            Nominal
                        </th>

                        <th class="px-6 py-4">
                            Metode
                        </th>

                        <th class="px-6 py-4">
                            Status
                        </th>

                        <th class="px-6 py-4">
                            Bukti
                        </th>

                        <th class="px-6 py-4 text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse ($payments as $payment)

                        <tr class="border-t hover:bg-slate-50">

                            <td class="px-6 py-5">

                                <div class="font-semibold text-slate-800">
                                    {{ $payment->user->user_nama }}
                                </div>

                                <div class="text-sm text-slate-500">
                                    {{ $payment->user->user_email }}
                                </div>

                            </td>

                            <td class="px-6 py-5">

                                <div class="font-medium">
                                    {{ $payment->payment_invoice }}
                                </div>

                            </td>

                            <td class="px-6 py-5">

                                <span
                                    class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-sm">

                                    {{ ucfirst($payment->payment_package) }}

                                </span>

                            </td>

                            <td class="px-6 py-5 font-semibold">

                                Rp
                                {{ number_format(
                                    $payment->payment_amount,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </td>

                            <td class="px-6 py-5">

                                <span class="uppercase text-sm">
                                    {{ $payment->payment_method ?? '-' }}
                                </span>

                            </td>

                            <td class="px-6 py-5">

                                @if ($payment->payment_status == 'paid')

                                    <span
                                        class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm">

                                        Paid

                                    </span>

                                @elseif ($payment->payment_status == 'pending')

                                    <span
                                        class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm">

                                        Pending

                                    </span>

                                @else

                                    <span
                                        class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm">

                                        Failed

                                    </span>

                                @endif

                            </td>

                            <td class="px-6 py-5">

                                @if ($payment->payment_proof)

                                    <a
                                        href="{{ asset($payment->payment_proof) }}"
                                        target="_blank"
                                        class="inline-flex items-center px-4 py-2 bg-slate-100 rounded-xl hover:bg-slate-200">

                                        Lihat Bukti

                                    </a>

                                @else

                                    <span class="text-slate-400">
                                        -
                                    </span>

                                @endif

                            </td>

                            <td class="px-6 py-5">

                                @if ($payment->payment_status == 'pending')

                                    <div class="flex gap-2 justify-center">

                                        <form
                                            method="POST"
                                            action="{{ route('admin.payment.approve', $payment->payment_id) }}">

                                            @csrf
                                            @method('PATCH')

                                            <button
                                                onclick="return confirm('Approve pembayaran ini?')"
                                                class="px-4 py-2 bg-green-600 text-white rounded-xl hover:bg-green-700">

                                                Approve

                                            </button>

                                        </form>

                                        <form
                                            method="POST"
                                            action="{{ route('admin.payment.reject', $payment->payment_id) }}">

                                            @csrf
                                            @method('PATCH')

                                            <button
                                                onclick="return confirm('Tolak pembayaran ini?')"
                                                class="px-4 py-2 bg-red-600 text-white rounded-xl hover:bg-red-700">

                                                Reject

                                            </button>

                                        </form>

                                    </div>

                                @else

                                    <span class="text-slate-400 text-sm">
                                        Selesai
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="8"
                                class="text-center py-20 text-slate-400">

                                Belum ada pembayaran.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    <div>
        {{ $payments->links() }}
    </div>

</div>

@endsection