@php
    $appSetting = \App\Models\ModelSetting::first();
    $landing = \App\Models\ModelLandingSetting::first();

    $primary = $landing->primary_color ?? '#6366f1';
    $secondary = $landing->secondary_color ?? '#f8fafc';
    $accent = $landing->accent_color ?? '#4f46e5';

    $websiteUrl = 'https://' . ($user->user_subdomain ?: 'nama-toko') . '.' . config('app.domain');
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Setup Website -
        {{ $landing->site_name ?? ($appSetting->app_name ?? 'AFFILIO') }}
    </title>

    @if ($appSetting && $appSetting->app_favicon)
        <link rel="icon" href="{{ asset($appSetting->app_favicon) }}">
    @endif

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        :root {
            --primary: {{ $primary }};
            --secondary: {{ $secondary }};
            --accent: {{ $accent }};
        }
    </style>
</head>

<body class="min-h-screen py-10 px-6"
    style="
        background:
        linear-gradient(
            135deg,
            var(--secondary),
            #ffffff,
            #f8fafc
        );
    ">

    <div class="max-w-3xl mx-auto">

        <div
            class="
                bg-white/90
                backdrop-blur-xl
                rounded-[32px]
                shadow-2xl
                overflow-hidden
            ">

            <div class="p-8 border-b">

                <div class="flex items-center gap-4">

                    @if ($appSetting && $appSetting->app_logo)
                        <img src="{{ asset($appSetting->app_logo) }}"
                            class="
                                w-16
                                h-16
                                rounded-2xl
                                object-cover
                            ">
                    @else
                        <div class="
                                w-16
                                h-16
                                rounded-2xl
                                text-white
                                flex
                                items-center
                                justify-center
                                text-2xl
                                font-bold
                            "
                            style="
                                background:
                                var(--primary);
                            ">

                            {{ strtoupper(substr($landing->site_name ?? ($appSetting->app_name ?? 'A'), 0, 1)) }}

                        </div>
                    @endif

                    <div>

                        <h1
                            class="
                                text-3xl
                                font-bold
                            ">
                            Setup Website
                        </h1>

                        <p class="text-gray-500 mt-1">
                            Lengkapi identitas website affiliate kamu sebelum masuk dashboard.
                        </p>

                    </div>

                </div>

            </div>

            <div class="p-8">

                @if (session('success'))
                    <div
                        class="
                            mb-6
                            p-4
                            rounded-2xl
                            bg-green-50
                            border
                            border-green-200
                            text-green-700
                        ">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div
                        class="
                            mb-6
                            p-4
                            rounded-2xl
                            bg-red-50
                            border
                            border-red-200
                            text-red-700
                        ">

                        <ul class="space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>
                                    • {{ $error }}
                                </li>
                            @endforeach
                        </ul>

                    </div>
                @endif

                <form method="POST" action="{{ route('client.setup.store') }}" enctype="multipart/form-data"
                    class="space-y-6">

                    @csrf

                    <div>
                        <label
                            class="
                                text-sm
                                font-medium
                                text-gray-600
                            ">
                            Nama Website
                        </label>

                        <input type="text" name="user_brand_name"
                            value="{{ old('user_brand_name', $user->user_brand_name) }}"
                            class="
                                w-full
                                mt-2
                                p-3
                                border
                                rounded-2xl
                            "
                            required>
                    </div>

                    <div>

                        <label
                            class="
                                text-sm
                                font-medium
                                text-gray-600
                            ">
                            Link Website
                        </label>

                        <div class="flex mt-2">

                            <input type="text" name="user_subdomain"
                                value="{{ old('user_subdomain', $user->user_subdomain) }}"
                                class="
                                    flex-1
                                    p-3
                                    border
                                    border-r-0
                                    rounded-l-2xl
                                "
                                placeholder="nama-toko" required>

                            <span
                                class="
                                    px-4
                                    py-3
                                    bg-gray-100
                                    border
                                    rounded-r-2xl
                                    text-sm
                                    text-gray-500
                                    whitespace-nowrap
                                ">
                                .{{ config('app.domain') }}
                            </span>

                        </div>

                        <p
                            class="
                                text-xs
                                text-gray-400
                                mt-2
                            ">
                            Contoh:
                            demo-store.{{ config('app.domain') }}
                        </p>

                    </div>
                    <div>
                        <label
                            class="
                                text-sm
                                font-medium
                                text-gray-600
                            ">
                            Tagline
                        </label>

                        <input type="text" name="user_tagline"
                            value="{{ old('user_tagline', $user->user_tagline) }}"
                            placeholder="Temukan rekomendasi produk terbaik"
                            class="
                                w-full
                                mt-2
                                p-3
                                border
                                rounded-2xl
                            ">
                    </div>

                    <div>
                        <label
                            class="
                                text-sm
                                font-medium
                                text-gray-600
                            ">
                            Deskripsi Website
                        </label>

                        <textarea name="user_description" rows="4"
                            class="
                                w-full
                                mt-2
                                p-3
                                border
                                rounded-2xl
                            "
                            placeholder="Ceritakan website affiliate kamu...">{{ old('user_description', $user->user_description) }}</textarea>
                    </div>

                    <div>
                        <label
                            class="
                                text-sm
                                font-medium
                                text-gray-600
                            ">
                            Logo Website
                        </label>

                        <input type="file" name="user_logo"
                            class="
                                w-full
                                mt-2
                                p-3
                                border
                                rounded-2xl
                                bg-white
                            ">

                        @if ($user->user_logo)
                            <img src="{{ asset($user->user_logo) }}"
                                class="
                                    mt-4
                                    h-20
                                    rounded-2xl
                                    border
                                    object-contain
                                    bg-white
                                    p-2
                                ">
                        @endif
                    </div>

                    <div>
                        <label
                            class="
                                text-sm
                                font-medium
                                text-gray-600
                            ">
                            WhatsApp
                        </label>

                        <input type="text" name="user_whatsapp"
                            value="{{ old('user_whatsapp', $user->user_whatsapp) }}" placeholder="6281234567890"
                            class="
                                w-full
                                mt-2
                                p-3
                                border
                                rounded-2xl
                            ">
                    </div>

                    <div
                        class="
                            grid
                            md:grid-cols-2
                            gap-5
                        ">

                        <div>
                            <label
                                class="
                                    text-sm
                                    font-medium
                                    text-gray-600
                                ">
                                Instagram
                            </label>

                            <input type="text" name="user_instagram"
                                value="{{ old('user_instagram', $user->user_instagram) }}"
                                class="
                                    w-full
                                    mt-2
                                    p-3
                                    border
                                    rounded-2xl
                                ">
                        </div>

                        <div>
                            <label
                                class="
                                    text-sm
                                    font-medium
                                    text-gray-600
                                ">
                                TikTok
                            </label>

                            <input type="text" name="user_tiktok"
                                value="{{ old('user_tiktok', $user->user_tiktok) }}"
                                class="
                                    w-full
                                    mt-2
                                    p-3
                                    border
                                    rounded-2xl
                                ">
                        </div>

                    </div>

                    <div
                        class="
                            grid
                            md:grid-cols-2
                            gap-5
                        ">

                        <div>
                            <label
                                class="
                                    text-sm
                                    font-medium
                                    text-gray-600
                                ">
                                Warna Utama
                            </label>

                            <input type="color" name="user_theme_primary"
                                value="{{ old('user_theme_primary', $user->user_theme_primary ?? $primary) }}"
                                class="
                                    w-full
                                    h-14
                                    border
                                    rounded-2xl
                                    mt-2
                                ">
                        </div>

                        <div>
                            <label
                                class="
                                    text-sm
                                    font-medium
                                    text-gray-600
                                ">
                                Warna Background
                            </label>

                            <input type="color" name="user_theme_secondary"
                                value="{{ old('user_theme_secondary', $user->user_theme_secondary ?? $secondary) }}"
                                class="
                                    w-full
                                    h-14
                                    border
                                    rounded-2xl
                                    mt-2
                                ">
                        </div>

                    </div>

                    <div class="
                            p-5
                            rounded-2xl
                            border
                            text-sm
                        "
                        style="
                            background:
                            color-mix(
                                in srgb,
                                var(--primary) 10%,
                                white
                            );
                            border-color:
                            color-mix(
                                in srgb,
                                var(--primary) 20%,
                                white
                            );
                        ">

                        <p class="font-semibold">
                            Link website kamu:
                        </p>

                        <p class="mt-2 break-all"
                            style="
                                color:
                                var(--primary);
                            ">
                            {{ $websiteUrl }}
                        </p>

                    </div>

                    <button type="submit"
                        class="
                            w-full
                            py-4
                            rounded-2xl
                            text-white
                            font-semibold
                            text-lg
                            transition
                            hover:opacity-90
                        "
                        style="
                            background:
                            var(--primary);
                        ">
                        Simpan & Masuk Dashboard
                    </button>

                </form>

            </div>

        </div>

        <p
            class="
                text-center
                text-xs
                text-slate-500
                mt-6
            ">

            {{ $appSetting->footer_text ??
                '© ' .
                    date('Y') .
                    ' ' .
                    ($landing->site_name ?? ($appSetting->app_name ?? 'Affilio Store')) .
                    '. Crafted by ARIN Digital Creative & IT Solutions.' }}

        </p>

    </div>

</body>

</html>
