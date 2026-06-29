@extends('client.layouts.app')

@section('content')

<div class="bg-white rounded-3xl shadow p-8">

    <h1 class="text-3xl font-bold">
        Riwayat Pembayaran
    </h1>

    <div class="mt-8 overflow-auto">

        <table class="w-full">

            <thead>

                <tr class="border-b">

                    <th class="text-left py-3">
                        Invoice
                    </th>

                    <th class="text-left py-3">
                        Nominal
                    </th>

                    <th class="text-left py-3">
                        Status
                    </th>

                    <th class="text-left py-3">
                        Bukti
                    </th>

                </tr>

            </thead>

            <tbody>

                @foreach ($payments as $item)

                    <tr class="border-b">

                        <td class="py-4">
                            {{ $item->payment_invoice }}
                        </td>

                        <td>
                            Rp {{ number_format($item->payment_amount,0,',','.') }}
                        </td>

                        <td>
                            {{ strtoupper($item->payment_status) }}
                        </td>

                        <td>

                            @if ($item->payment_proof)

                                <a
                                    href="{{ asset($item->payment_proof) }}"
                                    target="_blank"
                                    class="text-blue-600">

                                    Lihat

                                </a>

                            @endif

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

        <div class="mt-6">

            {{ $payments->links() }}

        </div>

    </div>

</div>

@endsection