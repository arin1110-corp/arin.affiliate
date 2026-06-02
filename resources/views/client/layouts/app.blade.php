<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - {{ auth('arin')->user()->user_brand_name ?? 'ARIN' }}</title>

    @if(auth('arin')->user()->user_favicon)
        <link rel="icon" href="{{ asset(auth('arin')->user()->user_favicon) }}">
    @endif

    <script src="https://cdn.tailwindcss.com"></script>

    @php
        $user = auth('arin')->user();
        $primary = $user->user_theme_primary ?? '#ec4899';
        $secondary = $user->user_theme_secondary ?? '#fdf2f8';
        $accent = $user->user_theme_accent ?? '#f43f5e';
    @endphp

    <style>
        :root {
            --primary: {{ $primary }};
            --secondary: {{ $secondary }};
            --accent: {{ $accent }};
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
            background-color: color-mix(in srgb, var(--primary) 10%, white);
        }

        .theme-border {
            border-color: color-mix(in srgb, var(--primary) 15%, white);
        }

        .theme-menu-active {
            background-color: var(--primary);
            color: #ffffff;
        }

        .theme-menu-hover:hover {
            background-color: color-mix(in srgb, var(--primary) 10%, white);
        }
    </style>
</head>

<body class="theme-bg min-h-screen">

    <div class="flex min-h-screen">

        @include('client.partials.sidebar')

        <div class="flex-1 md:ml-72">

            @include('client.partials.navbar')

            <main class="p-6">
                @yield('content')
            </main>

        </div>

    </div>

</body>
</html>