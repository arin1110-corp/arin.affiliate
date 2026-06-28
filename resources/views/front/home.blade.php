@php
    $appSetting = \App\Models\ModelSetting::first();
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $landing->site_name ?? $appSetting->app_name ?? 'ARIN' }} - {{ $landing->site_tagline ?? 'Affiliate SaaS' }}</title>

    @if($appSetting && $appSetting->app_favicon)
        <link rel="icon" href="{{ asset($appSetting->app_favicon) }}">
    @endif

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        :root {
            --primary: {{ $landing->primary_color ?? '#ec4899' }};
            --secondary: {{ $landing->secondary_color ?? '#fdf2f8' }};
            --accent: {{ $landing->accent_color ?? '#f43f5e' }};
        }
    </style>
</head>

<body class="min-h-screen text-slate-800"
      style="background: linear-gradient(135deg, var(--secondary), #ffffff, #fff1f2);">

<header class="sticky top-0 z-50 bg-white/80 backdrop-blur-xl border-b">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">

        <a href="{{ route('front.home') }}" class="flex items-center gap-3">
            @if($appSetting && $appSetting->app_logo)
                <img src="{{ asset($appSetting->app_logo) }}"
                     class="w-11 h-11 rounded-xl object-cover">
            @else
                <div class="w-11 h-11 rounded-xl text-white flex items-center justify-center font-bold"
                     style="background: var(--primary);">
                    {{ strtoupper(substr($landing->site_name ?? $appSetting->app_name ?? 'A', 0, 1)) }}
                </div>
            @endif

            <div>
                <h1 class="text-2xl font-bold" style="color: var(--primary);">
                    {{ $landing->site_name ?? $appSetting->app_name ?? 'ARIN' }}
                </h1>
                <p class="text-xs text-slate-500">
                    {{ $landing->site_tagline ?? 'Affiliate SaaS' }}
                </p>
            </div>
        </a>

        <div class="flex gap-3">
            <a href="{{ route('login') }}"
               class="px-4 py-2 rounded-2xl text-sm border bg-white">
                Login
            </a>

            <a href="{{ route('register')}}"
               class="px-4 py-2 rounded-2xl text-sm text-white"
               style="background: var(--primary);">
                Daftar
            </a>
        </div>

    </div>
</header>

<section class="max-w-7xl mx-auto px-4 py-16 grid grid-cols-1 md:grid-cols-2 gap-10 items-center">

    <div>
        <span class="inline-block px-4 py-2 rounded-full text-sm font-medium mb-5"
              style="background: color-mix(in srgb, var(--primary) 12%, white); color: var(--primary);">
            Promo 1.000 Pengguna Pertama
        </span>

        <h2 class="text-4xl md:text-6xl font-bold leading-tight">
            {{ $landing->hero_title }}
        </h2>

        <p class="mt-5 text-slate-600 text-lg leading-relaxed">
            {{ $landing->hero_subtitle }}
        </p>

        <div class="flex flex-col sm:flex-row gap-4 mt-8">
            <a href="{{ route('register', ['package' => 'starter']) }}"
               class="px-6 py-4 rounded-2xl text-white text-center font-semibold"
               style="background: var(--primary);">
                {{ $landing->cta_text ?? 'Daftar Sekarang' }}
            </a>

            <a href="#pricing"
               class="px-6 py-4 rounded-2xl bg-white border text-center font-semibold">
                Lihat Paket
            </a>
        </div>

        <p class="mt-4 text-sm text-slate-400">
            Daftar, verifikasi email, lengkapi profil website, lalu dapatkan link affiliate kamu.
        </p>
    </div>

    <div class="relative">
        <div class="absolute -inset-4 rounded-[40px] blur-3xl opacity-30"
             style="background: var(--primary);"></div>

        <div class="relative bg-white/80 backdrop-blur-xl border rounded-[32px] p-5 shadow-2xl">
            @if($landing->hero_image)
                <img src="{{ asset($landing->hero_image) }}"
                     class="w-full h-[420px] object-cover rounded-[24px]">
            @else
                <div class="h-[420px] rounded-[24px] flex items-center justify-center"
                     style="background: linear-gradient(135deg, var(--primary), var(--accent));">
                    <div class="text-center text-white">
                        <h3 class="text-4xl font-bold">
                            {{ $appSetting->app_name ?? 'ARIN' }}
                        </h3>
                        <p class="mt-2">
                            Your Affiliate Store
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </div>

</section>

<section class="max-w-7xl mx-auto px-4 py-12">
    <div class="grid grid-cols-2 md:grid-cols-3 gap-5">
        @foreach(explode("\n", $landing->section_features ?? '') as $feature)
            @if(trim($feature))
                <div class="bg-white/80 border rounded-3xl p-6 shadow-sm">
                    <div class="w-10 h-10 rounded-2xl text-white flex items-center justify-center mb-4"
                         style="background: var(--primary);">
                        ✓
                    </div>

                    <h3 class="font-semibold">
                        {{ trim($feature) }}
                    </h3>
                </div>
            @endif
        @endforeach
    </div>
</section>

<section id="pricing" class="max-w-7xl mx-auto px-4 py-16">
    <div class="text-center mb-10">
        <h2 class="text-3xl md:text-4xl font-bold">
            Pilih Paket {{ $appSetting->app_name ?? 'ARIN' }}
        </h2>

        <p class="text-slate-500 mt-3">
            Pilih paket sesuai kebutuhan website affiliate kamu.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto">

        @foreach($packages as $package)
            <div class="bg-white/90 border rounded-[28px] p-8 shadow-xl flex flex-col">

                <h3 class="text-2xl font-bold">
                    {{ $package->package_nama }}
                </h3>

                <p class="text-slate-500 mt-2">
                    {{ $package->package_deskripsi }}
                </p>

                <div class="mt-6">
                    @if($package->package_harga_promo)
                        <p class="text-sm line-through text-slate-400">
                            Rp {{ number_format($package->package_harga_normal, 0, ',', '.') }}
                        </p>

                        <p class="text-4xl font-bold" style="color: var(--primary);">
                            Rp {{ number_format($package->package_harga_promo, 0, ',', '.') }}
                        </p>

                        <p class="text-xs text-slate-400 mt-1">
                            Promo terbatas untuk pengguna awal.
                        </p>
                    @else
                        <p class="text-4xl font-bold" style="color: var(--primary);">
                            Rp {{ number_format($package->package_harga_normal, 0, ',', '.') }}
                        </p>
                    @endif

                    <p class="text-xs text-slate-400 mt-2">
                        Masa aktif {{ $package->package_masa_aktif }} hari
                    </p>
                </div>

                <ul class="mt-6 space-y-3 text-sm text-slate-600">
                    @foreach(explode("\n", $package->package_fitur ?? '') as $fitur)
                        @if(trim($fitur))
                            <li>✓ {{ trim($fitur) }}</li>
                        @endif
                    @endforeach
                </ul>

                <div class="mt-6 text-xs text-slate-500 space-y-1">
                    <p>Produk: {{ $package->package_max_product }}</p>
                    <p>Slider: {{ $package->package_max_slider }}</p>
                    <p>Kategori: {{ $package->package_max_category }}</p>
                </div>

                <a href="{{ route('register', ['package' => $package->package_slug]) }}"
                   class="block text-center mt-8 py-3 rounded-2xl text-white font-semibold"
                   style="background: var(--primary);">
                    Pilih Paket
                </a>
            </div>
        @endforeach

    </div>
</section>

<section class="max-w-4xl mx-auto px-4 py-16">
    <h2 class="text-3xl font-bold text-center mb-8">
        Pertanyaan Umum
    </h2>

    <div class="space-y-4">
        @foreach(explode("\n", $landing->section_faq ?? '') as $faq)
            @php
                $parts = explode('|', $faq);
            @endphp

            @if(count($parts) >= 2)
                <div class="bg-white/80 border rounded-3xl p-6">
                    <h3 class="font-bold">
                        {{ trim($parts[0]) }}
                    </h3>

                    <p class="text-slate-500 mt-2">
                        {{ trim($parts[1]) }}
                    </p>
                </div>
            @endif
        @endforeach
    </div>
</section>

<footer class="border-t bg-white/70">
    <div class="max-w-7xl mx-auto px-4 py-8 text-center text-sm text-slate-400">
        {{ $appSetting->footer_text ?? '© ' . date('Y') . ' ' . ($landing->site_name ?? $appSetting->app_name ?? 'Affilio Store') . '. Crafted by ARIN Digital Creative & IT Solutions.' }}
    </div>
</footer>

</body>
</html>