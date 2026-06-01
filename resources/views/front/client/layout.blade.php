<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $client->user_brand_name ?? 'ARIN Store' }}</title>

    <meta name="description" content="{{ $client->user_description ?? '' }}">

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        :root {
            --primary: {{ $client->user_theme_primary ?? '#ec4899' }};
            --secondary: {{ $client->user_theme_secondary ?? '#fdf2f8' }};
            --accent: #f43f5e;
        }

        .theme-bg {
            background: linear-gradient(135deg, var(--secondary), #ffffff, #fff1f2);
        }

        .theme-button {
            background-color: var(--primary);
            color: #ffffff;
        }

        .theme-text {
            color: var(--primary);
        }

        .theme-soft {
            background-color: color-mix(in srgb, var(--primary) 12%, white);
        }

        .theme-border {
            border-color: color-mix(in srgb, var(--primary) 15%, white);
        }
    </style>
</head>

<body class="theme-bg min-h-screen text-slate-800">

    <header class="sticky top-0 z-50 bg-white/80 backdrop-blur-xl border-b theme-border">
        <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">

            <a href="{{ url('/'.$client->user_slug) }}" class="flex items-center gap-3">
                @if($client->user_logo)
                    <img src="{{ asset($client->user_logo) }}"
                         class="w-11 h-11 rounded-2xl object-cover">
                @else
                    <div class="w-11 h-11 rounded-2xl theme-button flex items-center justify-center font-bold">
                        {{ strtoupper(substr($client->user_brand_name ?? 'A', 0, 1)) }}
                    </div>
                @endif

                <div>
                    <h1 class="font-bold text-lg theme-text">
                        {{ $client->user_brand_name ?? 'ARIN Store' }}
                    </h1>

                    <p class="text-xs text-slate-400">
                        {{ $client->user_tagline ?? 'Affiliate Store' }}
                    </p>
                </div>
            </a>

            <nav class="hidden md:flex items-center gap-6 text-sm">
                <a href="{{ url('/'.$client->user_slug) }}" class="text-slate-600 hover:theme-text">
                    Home
                </a>
                <a href="#produk" class="text-slate-600 hover:theme-text">
                    Produk
                </a>
                <a href="#kategori" class="text-slate-600 hover:theme-text">
                    Kategori
                </a>
            </nav>

        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="mt-20 border-t theme-border bg-white/70 backdrop-blur-xl">
        <div class="max-w-7xl mx-auto px-4 py-10 grid grid-cols-1 md:grid-cols-3 gap-8">

            <div>
                <h3 class="font-bold text-xl theme-text">
                    {{ $client->user_brand_name ?? 'ARIN Store' }}
                </h3>

                <p class="text-sm text-slate-500 mt-2">
                    {{ $client->user_description ?? 'Rekomendasi produk affiliate pilihan.' }}
                </p>
            </div>

            <div>
                <h4 class="font-semibold mb-3">Menu</h4>

                <div class="space-y-2 text-sm">
                    <a href="{{ url('/'.$client->user_slug) }}" class="block text-slate-500">
                        Home
                    </a>
                    <a href="#produk" class="block text-slate-500">
                        Produk
                    </a>
                    <a href="#kategori" class="block text-slate-500">
                        Kategori
                    </a>
                </div>
            </div>

            <div>
                <h4 class="font-semibold mb-3">Connect</h4>

                <div class="space-y-2 text-sm text-slate-500">
                    @if($client->user_whatsapp)
                        <p>WhatsApp: {{ $client->user_whatsapp }}</p>
                    @endif

                    @if($client->user_instagram)
                        <p>Instagram: {{ $client->user_instagram }}</p>
                    @endif

                    @if($client->user_tiktok)
                        <p>TikTok: {{ $client->user_tiktok }}</p>
                    @endif
                </div>
            </div>

        </div>

        <div class="text-center text-xs text-slate-400 pb-6 border-t theme-border pt-6">
            © {{ date('Y') }} {{ $client->user_brand_name ?? 'ARIN Store' }}.
            <br>
            Powered by <span class="theme-text font-semibold">ARIN Affiliate</span>
        </div>
    </footer>

</body>
</html>