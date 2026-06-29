@extends('client.layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">

    @if(session('success'))
        <div class="mb-6 p-4 rounded-2xl bg-green-50 border border-green-200 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 p-4 rounded-2xl bg-red-50 border border-red-200 text-red-700">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-3xl shadow overflow-hidden">

        <div class="p-8 border-b">

            <h1 class="text-3xl font-bold">
                Aktivasi Langganan
            </h1>

            <p class="text-gray-500 mt-2">
                Selesaikan pembayaran untuk mulai menggunakan Affilio.
            </p>

        </div>

        <div class="p-8 grid md:grid-cols-2 gap-8">

            <div>

                <div class="border rounded-3xl p-6">

                    <div class="flex items-center justify-between">

                        <div>
                            <h2 class="text-2xl font-bold">
                                Paket {{ ucfirst($user->user_package) }}
                            </h2>

                            <p class="text-gray-500 mt-2">
                                Langganan bulanan.
                            </p>
                        </div>

                        <span class="px-4 py-2 bg-pink-100 text-pink-600 rounded-2xl text-sm font-semibold">
                            ACTIVE PLAN
                        </span>

                    </div>

                    <div class="mt-8">

                        <div class="text-5xl font-bold text-pink-600">
                            Rp{{ number_format(
                                $user->user_package == 'pro'
                                    ? 99900
                                    : 17900,
                                0,
                                ',',
                                '.'
                            ) }}
                        </div>

                        <p class="text-gray-500 mt-2">
                            per bulan
                        </p>

                    </div>

                    <div class="mt-8 space-y-3 text-sm">

                        <div class="flex items-center gap-3">
                            ✅ Website Affiliate
                        </div>

                        <div class="flex items-center gap-3">
                            ✅ Subdomain Gratis
                        </div>

                        <div class="flex items-center gap-3">
                            ✅ Hosting Gratis
                        </div>

                        <div class="flex items-center gap-3">
                            ✅ SSL Gratis
                        </div>

                        <div class="flex items-center gap-3">
                            ✅ Support QRIS & E-Wallet
                        </div>

                    </div>

                </div>

            </div>

            <div>

                <div class="border rounded-3xl p-6">

                    <h3 class="font-bold text-lg">
                        Metode Pembayaran
                    </h3>

                    <p class="text-gray-500 mt-2 text-sm">
                        Pembayaran diproses melalui Midtrans.
                    </p>

                    <div class="mt-6 space-y-3">

                        <div class="p-3 rounded-2xl bg-gray-50">
                            QRIS
                        </div>

                        <div class="p-3 rounded-2xl bg-gray-50">
                            Virtual Account
                        </div>

                        <div class="p-3 rounded-2xl bg-gray-50">
                            E-Wallet
                        </div>

                        <div class="p-3 rounded-2xl bg-gray-50">
                            Kartu Kredit
                        </div>

                    </div>

                    <button
                        id="pay-button"
                        class="w-full mt-8 bg-pink-600 text-white py-4 rounded-2xl font-semibold hover:bg-pink-700 transition">

                        Bayar Sekarang

                    </button>

                </div>

            </div>

        </div>

    </div>

</div>

<script
src="https://app.sandbox.midtrans.com/snap/snap.js"
data-client-key="{{ config('services.midtrans.client_key') }}">
</script>

<script>

const payButton =
    document.getElementById('pay-button');

payButton.addEventListener(
    'click',
    function () {

        payButton.disabled = true;
        payButton.innerHTML =
            'Memproses...';

        fetch(
            "{{ route('client.payment.process') }}",
            {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN':
                        '{{ csrf_token() }}',
                    'Accept':
                        'application/json'
                }
            }
        )
        .then(res => res.json())
        .then(data => {

            payButton.disabled = false;
            payButton.innerHTML =
                'Bayar Sekarang';

            if (!data.snap_token) {
                alert(
                    'Gagal membuat pembayaran.'
                );
                return;
            }

            snap.pay(
                data.snap_token,
                {
                    onSuccess: function () {
                        window.location =
                            "{{ route('client.payment.waiting') }}";
                    },

                    onPending: function () {
                        window.location =
                            "{{ route('client.payment.waiting') }}";
                    },

                    onClose: function () {
                        payButton.disabled = false;
                    },

                    onError: function () {
                        alert(
                            'Pembayaran gagal.'
                        );
                    }
                }
            );
        })
        .catch(() => {

            payButton.disabled = false;
            payButton.innerHTML =
                'Bayar Sekarang';

            alert(
                'Terjadi kesalahan.'
            );
        });

    }
);

</script>
@endsection