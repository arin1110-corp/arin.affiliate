<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $client->user_brand_name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen"
      style="background: linear-gradient(135deg, {{ $client->user_theme_secondary ?? '#fdf2f8' }}, #ffffff);">

<section class="max-w-3xl mx-auto px-4 py-12 text-center">

    @if($client->user_logo)
        <img src="{{ asset($client->user_logo) }}"
             class="w-24 h-24 mx-auto rounded-3xl object-cover mb-5">
    @else
        <div class="w-24 h-24 mx-auto rounded-3xl text-white flex items-center justify-center text-3xl font-bold mb-5"
             style="background: {{ $client->user_theme_primary ?? '#ec4899' }};">
            {{ strtoupper(substr($client->user_brand_name ?? 'A', 0, 1)) }}
        </div>
    @endif

    <h1 class="text-4xl font-bold">
        {{ $client->user_brand_name }}
    </h1>

    @if($client->user_tagline)
        <p class="text-gray-500 mt-2">
            {{ $client->user_tagline }}
        </p>
    @endif

    @if($client->user_description)
        <p class="text-gray-600 mt-5">
            {{ $client->user_description }}
        </p>
    @endif

    <div class="mt-8 bg-white/80 rounded-3xl shadow p-6">
        <h2 class="font-bold text-xl mb-2">
            Website siap digunakan
        </h2>

        <p class="text-gray-500">
            Modul produk, kategori, dan affiliate link akan kita sambungkan setelah ini.
        </p>
    </div>

</section>

</body>
</html>