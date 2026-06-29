@extends('client.layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">

    <div class="bg-white rounded-3xl shadow p-8">

        <h1 class="text-3xl font-bold">
            Pembayaran Paket
        </h1>

        <p class="text-gray-500 mt-2">
            Lakukan pembayaran terlebih dahulu untuk mengaktifkan website.
        </p>

        <div class="mt-8 border rounded-3xl p-6">

            <h2 class="text-2xl font-bold">
                Paket {{ ucfirst($user->user_package) }}
            </h2>

            <p class="text-5xl font-bold text-pink-600 mt-4">

                Rp
                {{ number_format(
                    $user->user_package == 'pro'
                    ? 99900
                    : 17900,
                    0,
                    ',',
                    '.'
                ) }}

            </p>

        </div>

        @if ($setting->payment_bank_name)
            <div class="mt-6 border rounded-3xl p-6">

                <h3 class="font-bold text-lg">
                    Transfer Bank
                </h3>

                <div class="mt-4">

                    <p>
                        <b>{{ $setting->payment_bank_name }}</b>
                    </p>

                    <p>
                        {{ $setting->payment_bank_number }}
                    </p>

                    <p>
                        a.n.
                        {{ $setting->payment_bank_holder }}
                    </p>

                </div>

            </div>
        @endif

        @if ($setting->payment_bank_name_2)
            <div class="mt-4 border rounded-3xl p-6">

                <p>
                    <b>{{ $setting->payment_bank_name_2 }}</b>
                </p>

                <p>
                    {{ $setting->payment_bank_number_2 }}
                </p>

                <p>
                    a.n.
                    {{ $setting->payment_bank_holder_2 }}
                </p>

            </div>
        @endif

        @if ($setting->payment_bank_name_3)
            <div class="mt-4 border rounded-3xl p-6">

                <p>
                    <b>{{ $setting->payment_bank_name_3 }}</b>
                </p>

                <p>
                    {{ $setting->payment_bank_number_3 }}
                </p>

                <p>
                    a.n.
                    {{ $setting->payment_bank_holder_3 }}
                </p>

            </div>
        @endif

        @if ($setting->payment_qris_image)
            <div class="mt-6 border rounded-3xl p-6 text-center">

                <h3 class="font-bold text-lg">
                    QRIS
                </h3>

                <img
                    src="{{ asset($setting->payment_qris_image) }}"
                    class="w-64 mx-auto mt-4 rounded-2xl">

            </div>
        @endif

        @if ($setting->payment_note)
            <div class="mt-6 bg-blue-50 rounded-2xl p-4 text-blue-700">
                {!! nl2br(e($setting->payment_note)) !!}
            </div>
        @endif

        <form
            method="POST"
            action="{{ route('client.payment.manual.store') }}"
            enctype="multipart/form-data"
            class="mt-8">

            @csrf

            <div>

                <label class="text-sm text-gray-600">
                    Upload Bukti Pembayaran
                </label>

                <input
                    type="file"
                    name="payment_proof"
                    class="w-full mt-2 p-3 border rounded-2xl"
                    required>

            </div>

            <button
                class="w-full mt-6 bg-pink-600 text-white py-4 rounded-2xl font-semibold">

                Kirim Bukti Pembayaran

            </button>

        </form>

    </div>

</div>
@endsection