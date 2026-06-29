@php
    $appSetting = \App\Models\ModelSetting::first();

    $package = $selectedPackage ?? request('package');

    $primary = $landing->primary_color ?? '#ec4899';
    $secondary = $landing->secondary_color ?? '#fdf2f8';
    $accent = $landing->accent_color ?? '#f43f5e';
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Daftar -
        {{ $landing->site_name ?? ($appSetting->app_name ?? 'Affilio') }}
    </title>

    @if ($appSetting && $appSetting->app_favicon)
        <link rel="icon" href="{{ asset($appSetting->app_favicon) }}">
    @endif

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        :root {
            --primary:
                {{ $primary }};

            --secondary:
                {{ $secondary }};

            --accent:
                {{ $accent }};
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center py-10 px-5"
    style="
        background:
        linear-gradient(
            135deg,
            var(--secondary),
            #ffffff,
            #fff1f2
        );
    ">

    <div class="w-full max-w-xl">

        <div class="bg-white/90 backdrop-blur-xl rounded-[32px] shadow-2xl p-8">

            <div class="text-center mb-8">

                @if ($appSetting && $appSetting->app_logo)
                    <img src="{{ asset($appSetting->app_logo) }}" class="w-20 h-20 mx-auto rounded-3xl object-cover">
                @else
                    <div class="w-20 h-20 mx-auto rounded-3xl text-white flex items-center justify-center text-3xl font-bold"
                        style="
                            background:
                            var(--primary);
                        ">
                        {{ strtoupper(substr($landing->site_name ?? ($appSetting->app_name ?? 'A'), 0, 1)) }}
                    </div>
                @endif

                <h1 class="text-3xl font-bold mt-5">

                    Daftar
                    {{ $landing->site_name ?? ($appSetting->app_name ?? 'Affilio') }}

                </h1>

                <p class="text-gray-500 mt-2">
                    Buat website affiliate
                    profesional dalam
                    hitungan menit.
                </p>

            </div>

            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 p-4 rounded-2xl">

                    {{ $errors->first() }}

                </div>
            @endif

            <form method="POST" action="{{ route('register.store') }}" class="space-y-5">

                @csrf

                <div>

                    <label class="text-sm text-gray-600">
                        Nama Lengkap
                    </label>

                    <input type="text" name="user_nama" value="{{ old('user_nama') }}"
                        class="w-full mt-2 px-5 py-3 rounded-2xl border border-gray-200 focus:ring-2 outline-none"
                        style="
                            --tw-ring-color:
                            var(--primary);
                        "
                        required>

                </div>

                <div>

                    <label class="text-sm text-gray-600">
                        Email
                    </label>

                    <input type="email" name="user_email" value="{{ old('user_email') }}"
                        class="w-full mt-2 px-5 py-3 rounded-2xl border border-gray-200 focus:ring-2 outline-none"
                        style="
                            --tw-ring-color:
                            var(--primary);
                        "
                        required>

                </div>

                <div>

                    <label class="text-sm text-gray-600">
                        Password
                    </label>

                    <input type="password" name="user_password"
                        class="w-full mt-2 px-5 py-3 rounded-2xl border border-gray-200 focus:ring-2 outline-none"
                        style="
                            --tw-ring-color:
                            var(--primary);
                        "
                        required>

                </div>

                <div>

                    <label class="text-sm text-gray-600">
                        Nama Website / Brand
                    </label>

                    <input type="text" name="user_brand_name" value="{{ old('user_brand_name') }}"
                        placeholder="Contoh: Affilio Store"
                        class="w-full mt-2 px-5 py-3 rounded-2xl border border-gray-200 focus:ring-2 outline-none"
                        style="
                            --tw-ring-color:
                            var(--primary);
                        "
                        required>

                </div>
                <div>

                    <label class="text-sm text-gray-600">
                        Pilih Paket
                    </label>

                    <div class="grid gap-4 mt-3">

                        @foreach ($packages as $item)
                            <label
                                class="
                    border rounded-3xl p-5
                    cursor-pointer
                    hover:shadow-lg
                    transition
                ">

                                <input type="radio" name="package" value="{{ $item->package_slug }}" class="mr-2"
                                    {{ old('package', $package) == $item->package_slug ? 'checked' : '' }} required>

                                <h3 class="font-bold text-lg mt-3">

                                    {{ $item->package_nama }}

                                </h3>

                                <p class="text-sm text-gray-500 mt-2">

                                    {{ $item->package_deskripsi }}

                                </p>

                                <div class="mt-4">

                                    @if ($item->package_harga_promo)
                                        <p class="line-through text-gray-400 text-sm">

                                            Rp
                                            {{ number_format($item->package_harga_normal, 0, ',', '.') }}

                                        </p>

                                        <p class="text-3xl font-bold"
                                            style="
                                color:
                                var(--primary);
                            ">

                                            Rp
                                            {{ number_format($item->package_harga_promo, 0, ',', '.') }}

                                        </p>
                                    @else
                                        <p class="text-3xl font-bold"
                                            style="
                                color:
                                var(--primary);
                            ">

                                            Rp
                                            {{ number_format($item->package_harga_normal, 0, ',', '.') }}

                                        </p>
                                    @endif

                                    <p class="text-xs text-gray-400">

                                        /bulan

                                    </p>

                                </div>

                                <div class="mt-4 text-xs text-slate-500 space-y-1">

                                    <p>
                                        Produk:
                                        {{ $item->package_max_product }}
                                    </p>

                                    <p>
                                        Slider:
                                        {{ $item->package_max_slider }}
                                    </p>

                                    <p>
                                        Kategori:
                                        {{ $item->package_max_category }}
                                    </p>

                                    <p>
                                        Masa Aktif:
                                        {{ $item->package_masa_aktif }}
                                        hari
                                    </p>

                                </div>

                            </label>
                        @endforeach

                    </div>

                </div>

                <div class="rounded-3xl p-5"
                    style="
        background:
        color-mix(
            in srgb,
            var(--primary) 10%,
            white
        );
    ">

                    <p class="font-semibold">
                        Website kamu nanti:
                    </p>

                    <div class="mt-3 bg-white rounded-2xl px-4 py-3 font-semibold break-all">

                        <span id="website-preview">
                            namastore.{{ config('app.domain') }}
                        </span>

                    </div>

                    <p class="mt-3 text-sm text-gray-500">
                        Kamu akan mendapatkan trial
                        untuk mencoba website affiliate.
                    </p>

                </div>

                <button
                    class="
        w-full text-white
        py-4 rounded-2xl
        font-semibold text-lg
        transition
        hover:opacity-90
    "
                    style="
        background:
        var(--primary);
    ">

                    Buat Akun

                </button>

            </form>

            <p class="
        text-center text-sm
        text-gray-500 mt-8
    ">

                Sudah punya akun?

                <a href="{{ route('login') }}" class="font-semibold"
                    style="
            color:
            var(--primary);
        ">

                    Login

                </a>

            </p>

        </div>

        <footer class="border-t bg-white/70">
            <div class="max-w-7xl mx-auto px-4 py-8 text-center text-sm text-slate-400">
                {{ $appSetting->footer_text ?? '© ' . date('Y') . ' ' . ($landing->site_name ?? ($appSetting->app_name ?? 'Affilio Store')) . '. Crafted by ARIN Digital Creative & IT Solutions.' }}
            </div>
        </footer>

    </div>
