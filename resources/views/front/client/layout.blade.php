<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        {{ $client->user_meta_title ?? ($client->user_brand_name ?? 'ARIN Store') }}
    </title>

    <meta name="description" content="{{ $client->user_meta_description ?? ($client->user_description ?? '') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    @if($client->user_favicon)
        <link rel="icon" href="{{ asset($client->user_favicon) }}">
    @endif

    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Lucide Icons --}}
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        :root {
            --primary: {{ $client->user_theme_primary ?? '#ec4899' }};
            --secondary: {{ $client->user_theme_secondary ?? '#fdf2f8' }};
            --accent: {{ $client->user_theme_accent ?? '#f43f5e' }};
        }

        .theme-bg {
            background: linear-gradient(135deg, var(--secondary), #ffffff, #fff1f2);
        }

        .theme-button {
            background-color: var(--primary);
            color: #ffffff;
        }

        .theme-button:hover {
            background-color: var(--accent);
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

        .theme-icon {
            color: var(--primary);
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

            <div class="hidden md:flex items-center gap-2">

                @if($client->user_whatsapp)
                    <a href="https://wa.me/{{ $client->user_whatsapp }}"
                       target="_blank"
                       class="w-10 h-10 rounded-2xl bg-green-100 hover:bg-green-500 hover:text-white transition flex items-center justify-center text-green-600">
                        <i data-lucide="message-circle" class="w-5 h-5"></i>
                    </a>
                @endif

                @if($client->user_instagram)
                    <a href="{{ $client->user_instagram }}"
                       target="_blank"
                       class="w-10 h-10 rounded-2xl bg-pink-100 hover:bg-pink-500 hover:text-white transition flex items-center justify-center text-pink-600">
                        <i class="fa-brands fa-instagram text-lg"></i>
                    </a>
                @endif

                @if($client->user_tiktok)
                    <a href="{{ $client->user_tiktok }}"
                       target="_blank"
                       class="w-10 h-10 rounded-2xl bg-slate-100 hover:bg-slate-900 hover:text-white transition flex items-center justify-center text-slate-900">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 24 24"
                             fill="currentColor"
                             class="w-5 h-5">
                            <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.68h-3.18v12.36a2.9 2.9 0 1 1-2.9-2.9c.24 0 .47.03.69.08V8.32a6.1 6.1 0 0 0-.69-.04A6.08 6.08 0 1 0 15.82 14V8.73a8 8 0 0 0 4.77 1.58V6.69z"/>
                        </svg>
                    </a>
                @endif

            </div>

        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="mt-20 border-t theme-border bg-white/70 backdrop-blur-xl">
        <div class="max-w-7xl mx-auto px-4 py-10 grid grid-cols-1 md:grid-cols-3 gap-8">

            {{-- BRAND --}}
            <div>
                <div class="flex items-center gap-3">

                    @if($client->user_logo)
                        <img src="{{ asset($client->user_logo) }}"
                             class="w-12 h-12 rounded-2xl object-cover">
                    @else
                        <div class="w-12 h-12 rounded-2xl theme-button flex items-center justify-center font-bold">
                            {{ strtoupper(substr($client->user_brand_name ?? 'A', 0, 1)) }}
                        </div>
                    @endif

                    <div>
                        <h3 class="font-bold text-xl theme-text">
                            {{ $client->user_brand_name ?? 'ARIN Store' }}
                        </h3>

                        <p class="text-xs text-slate-400">
                            {{ $client->user_tagline ?? 'Affiliate Store' }}
                        </p>
                    </div>

                </div>

                <p class="text-sm text-slate-500 mt-4">
                    {{ $client->user_footer_text ?? $client->user_description ?? 'Rekomendasi produk affiliate pilihan.' }}
                </p>
            </div>

            {{-- MENU --}}
            <div>
                <h4 class="font-semibold mb-3">
                    Menu
                </h4>

                <div class="space-y-2 text-sm">
                    <a href="{{ url('/'.$client->user_slug) }}"
                       class="block text-slate-500 hover:theme-text">
                        Home
                    </a>

                    <a href="#produk"
                       class="block text-slate-500 hover:theme-text">
                        Produk
                    </a>

                    <a href="#kategori"
                       class="block text-slate-500 hover:theme-text">
                        Kategori
                    </a>
                </div>
            </div>

            {{-- CONNECT --}}
            <div>
                <h4 class="font-semibold mb-3">
                    Connect
                </h4>

                <div class="flex gap-3">

                    @if($client->user_whatsapp)
                        <a href="https://wa.me/{{ $client->user_whatsapp }}"
                           target="_blank"
                           title="WhatsApp"
                           class="w-11 h-11 rounded-2xl bg-green-100 hover:bg-green-500 hover:text-white transition flex items-center justify-center text-green-600">
                            <i data-lucide="message-circle" class="w-5 h-5"></i>
                        </a>
                    @endif

                    @if($client->user_instagram)
                        <a href="{{ $client->user_instagram }}"
                           target="_blank"
                           title="Instagram"
                           class="w-11 h-11 rounded-2xl bg-pink-100 hover:bg-pink-500 hover:text-white transition flex items-center justify-center text-pink-600">
                            <i class="fa-brands fa-instagram text-lg"></i>
                        </a>
                    @endif

                    @if($client->user_tiktok)
                        <a href="{{ $client->user_tiktok }}"
                           target="_blank"
                           title="TikTok"
                           class="w-11 h-11 rounded-2xl bg-slate-100 hover:bg-slate-900 hover:text-white transition flex items-center justify-center text-slate-900">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 24 24"
                                 fill="currentColor"
                                 class="w-5 h-5">
                                <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.68h-3.18v12.36a2.9 2.9 0 1 1-2.9-2.9c.24 0 .47.03.69.08V8.32a6.1 6.1 0 0 0-.69-.04A6.08 6.08 0 1 0 15.82 14V8.73a8 8 0 0 0 4.77 1.58V6.69z"/>
                            </svg>
                        </a>
                    @endif

                </div>

                @if(!$client->user_whatsapp && !$client->user_instagram && !$client->user_tiktok)
                    <p class="text-sm text-slate-400">
                        Belum ada sosial media.
                    </p>
                @endif
            </div>

        </div>

        <div class="text-center text-xs text-slate-400 pb-6 border-t theme-border pt-6">
            © {{ date('Y') }} {{ $client->user_brand_name ?? 'ARIN Store' }}.
            <br>
            Powered by <span class="theme-text font-semibold">ARIN Affiliate</span>
        </div>
    </footer>

    <script>
        lucide.createIcons();
    </script>

</body>
</html>