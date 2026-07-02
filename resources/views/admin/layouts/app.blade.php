@php
    $appSetting = \App\Models\ModelSetting::first();
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - {{ $appSetting->app_name ?? 'ARIN' }}</title>

    @if ($appSetting && $appSetting->app_favicon)
        <link rel="icon" href="{{ asset($appSetting->app_favicon) }}">
    @endif

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 min-h-screen">

    @include('admin.partials.sidebar')

    <div
        id="sidebar-overlay"
        class="hidden fixed inset-0 bg-black/50 z-40 md:hidden">
    </div>

    <div class="flex min-h-screen">

        <div class="flex-1 md:ml-72">

            <header class="bg-white shadow px-4 py-4 md:hidden">

                <button
                    id="sidebar-toggle"
                    class="p-2 rounded-lg bg-slate-900 text-white">

                    <svg
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />

                    </svg>

                </button>

            </header>

            @include('admin.partials.navbar')

            <main class="p-6">
                @yield('content')
            </main>

        </div>

    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        const toggle = document.getElementById('sidebar-toggle');

        toggle?.addEventListener('click', function() {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        });

        overlay?.addEventListener('click', function() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });
    </script>

</body>

</html>