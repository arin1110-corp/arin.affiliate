@php
    $websiteUrl = 'https://' . 'nama-store' . '.' . config('app.domain');
@endphp
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register ARIN Affiliate</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-pink-900 flex items-center justify-center py-10">

    <div class="w-full max-w-lg px-6">

        <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl p-8">

            <div class="text-center mb-8">
                <div class="w-16 h-16 mx-auto rounded-2xl bg-pink-600 text-white flex items-center justify-center text-2xl font-bold">
                    A
                </div>

                <h1 class="text-2xl font-bold mt-4">
                    Daftar ARIN Affiliate
                </h1>

                <p class="text-sm text-gray-500">
                    Buat toko affiliate pribadi dalam hitungan menit.
                </p>
            </div>

            @if ($errors->any())
                <div class="mb-4 bg-red-50 border border-red-200 text-red-600 p-3 rounded-xl text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            @php
                $package = $selectedPackage ?? request('package', 'starter');
            @endphp

            <form method="POST" action="{{ route('register.store') }}" class="space-y-4">
                @csrf

                <input type="hidden" name="package" value="{{ $package }}">

                <div>
                    <label class="text-sm text-gray-600">Nama Lengkap</label>
                    <input type="text"
                           name="user_nama"
                           value="{{ old('user_nama') }}"
                           class="w-full mt-1 px-4 py-3 rounded-2xl border border-gray-200 focus:ring-2 focus:ring-pink-300 outline-none"
                           required>
                </div>

                <div>
                    <label class="text-sm text-gray-600">Email</label>
                    <input type="email"
                           name="user_email"
                           value="{{ old('user_email') }}"
                           class="w-full mt-1 px-4 py-3 rounded-2xl border border-gray-200 focus:ring-2 focus:ring-pink-300 outline-none"
                           required>
                </div>

                <div>
                    <label class="text-sm text-gray-600">Password</label>
                    <input type="password"
                           name="user_password"
                           class="w-full mt-1 px-4 py-3 rounded-2xl border border-gray-200 focus:ring-2 focus:ring-pink-300 outline-none"
                           required>
                </div>

                <div>
                    <label class="text-sm text-gray-600">Nama Website / Brand</label>
                    <input type="text"
                           name="user_brand_name"
                           value="{{ old('user_brand_name') }}"
                           class="w-full mt-1 px-4 py-3 rounded-2xl border border-gray-200 focus:ring-2 focus:ring-pink-300 outline-none"
                           placeholder="Contoh: Indra Picks"
                           required>
                </div>

                <div class="bg-pink-50 border border-pink-100 text-pink-700 rounded-2xl p-4 text-sm">
                    <p>
                        Paket dipilih:
                        <b>{{ ucfirst($package) }}</b>
                    </p>

                    @if($package === 'starter')
                        <p class="mt-1">
                            Promo 1.000 pengguna pertama:
                            <b>Rp14.900/bulan</b> untuk 3 bulan pertama.
                        </p>
                    @else
                        <p class="mt-1">
                            Paket Pro:
                            <b>Rp99.900/bulan</b>.
                        </p>
                    @endif

                    <p class="mt-2 text-pink-600">
                        Kamu akan mendapat trial 3 hari untuk mencoba website.
                    </p>

                    <p class="mt-2">
                        Link website kamu nanti:
                        <br>
                        <b>{{ $websiteUrl }}</b>

                    </p>
                </div>

                <button class="w-full bg-pink-600 text-white py-3 rounded-2xl font-semibold hover:bg-pink-700 transition">
                    Buat Akun
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-6">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-pink-600 font-semibold">
                    Login
                </a>
            </p>

        </div>

        <p class="text-center text-xs text-white/60 mt-6">
            © {{ date('Y') }} ARIN Affiliate
        </p>

    </div>

</body>
</html>