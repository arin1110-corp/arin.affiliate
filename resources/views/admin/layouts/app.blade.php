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

    <div class="flex min-h-screen">

        @include('admin.partials.sidebar')

        <div class="flex-1 md:ml-72">

            @include('admin.partials.navbar')

            <main class="p-6">
                @yield('content')
            </main>

        </div>

    </div>

</body>

</html>
