@php
    $appSetting = $appSetting ?? \App\Models\ModelSetting::first();

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
        Login -
        {{ $landing->site_name ?? ($appSetting->app_name ?? 'ARIN') }}
    </title>

    @if ($appSetting?->app_favicon)
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

<body class="min-h-screen flex items-center justify-center px-6"
    style="
        background:
        linear-gradient(
            135deg,
            var(--secondary),
            #ffffff,
            color-mix(in srgb, var(--primary) 10%, white)
        );
    ">

    <div class="w-full max-w-md">

        <div class="bg-white/90 backdrop-blur-xl rounded-[32px] shadow-2xl p-8">

            {{-- Logo --}}
            <div class="text-center mb-8">

                @if ($appSetting?->app_logo)
                    <img src="{{ asset($appSetting->app_logo) }}" class="w-20 h-20 mx-auto rounded-3xl object-cover">
                @else
                    <div class="w-20 h-20 mx-auto rounded-3xl text-white flex items-center justify-center text-3xl font-bold"
                        style="background: var(--primary);">
                        {{ strtoupper(substr($landing->site_name ?? ($appSetting->app_name ?? 'A'), 0, 1)) }}
                    </div>
                @endif

                <h1 class="text-3xl font-bold mt-5">
                    {{ $landing->site_name ?? ($appSetting->app_name ?? 'ARIN') }}
                </h1>

                <p class="text-gray-500 mt-2">
                    Login ke akun kamu
                </p>

            </div>

            {{-- SUCCESS --}}
            @if (session('success'))
                <div class="mb-4 flex gap-3 bg-green-50 border border-green-200 text-green-700 p-4 rounded-2xl text-sm">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />

                    </svg>

                    <span>{{ session('success') }}</span>

                </div>
            @endif

            {{-- ERROR --}}
            @if (session('error'))
                <div class="mb-5 p-4 rounded-2xl border border-red-200 bg-red-50 flex gap-3">

                    <div class="flex-shrink-0 text-red-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M10.29 3.86l-7.5 13A1 1 0 003.66 18h16.68a1 1 0 00.87-1.5l-7.5-13a1 1 0 00-1.74 0z" />
                        </svg>
                    </div>

                    <div>
                        <h3 class="font-semibold text-red-700">
                            {{ session('error.title') }}
                        </h3>

                        <p class="text-sm text-red-600 mt-1">
                            {{ session('error.message') }}
                        </p>
                    </div>

                </div>
            @endif

            {{-- STATUS --}}
            @if (session('status'))
                <div class="mb-4 flex gap-3 bg-blue-50 border border-blue-200 text-blue-700 p-4 rounded-2xl text-sm">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />

                    </svg>

                    <span>{{ session('status') }}</span>

                </div>
            @endif

            {{-- VALIDATION ERROR --}}
            @if ($errors->any())
                <div class="mb-4 bg-red-50 border border-red-200 text-red-700 p-4 rounded-2xl text-sm">

                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>

                </div>
            @endif

            <form method="POST" action="{{ route('authenticate') }}" class="space-y-5">

                @csrf

                <div>

                    <label class="text-sm text-gray-600">
                        Email
                    </label>

                    <input type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com"
                        class="w-full mt-2 px-5 py-3 rounded-2xl border border-gray-200 focus:ring-2 outline-none"
                        style="--tw-ring-color: var(--primary);" required>

                </div>

                <div>

                    <label class="text-sm text-gray-600">
                        Password
                    </label>

                    <input type="password" name="password" placeholder="••••••••"
                        class="w-full mt-2 px-5 py-3 rounded-2xl border border-gray-200 focus:ring-2 outline-none"
                        style="--tw-ring-color: var(--primary);" required>

                </div>

                <button class="w-full text-white py-3 rounded-2xl font-semibold transition hover:opacity-90"
                    style="background: var(--primary);">

                    Login

                </button>

            </form>

            <p class="text-center text-sm text-gray-500 mt-8">

                Belum punya akun?

                <a href="{{ route('register') }}" class="font-semibold" style="color: var(--primary);">

                    Daftar

                </a>

            </p>

        </div>

        <p class="text-center text-xs text-slate-500 mt-6">

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
