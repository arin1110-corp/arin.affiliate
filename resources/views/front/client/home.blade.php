@extends('front.client.layout')

@section('content')

    {{-- HERO / SLIDER --}}
    <section class="max-w-7xl mx-auto px-4 pt-8">

        @if (isset($sliders) && $sliders->count())
            <div class="grid grid-cols-1 gap-6">

                @foreach ($sliders as $slider)
                    <div class="relative overflow-hidden rounded-[32px] bg-white/70 border theme-border shadow-xl">

                        @if ($slider->slider_image || $slider->slider_image_mobile)
                            <picture>
                                @if ($slider->slider_image_mobile)
                                    <source media="(max-width: 768px)" srcset="{{ asset($slider->slider_image_mobile) }}">
                                @endif

                                @if ($slider->slider_image)
                                    <img src="{{ asset($slider->slider_image) }}"
                                        class="w-full h-[300px] md:h-[440px] object-cover">
                                @else
                                    <img src="{{ asset($slider->slider_image_mobile) }}"
                                        class="w-full h-[300px] md:h-[440px] object-cover">
                                @endif
                            </picture>
                        @else
                            <div class="w-full h-[300px] md:h-[440px]"
                                style="background: linear-gradient(135deg, var(--primary), var(--accent));"></div>
                        @endif

                        <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/30 to-transparent"></div>

                        <div class="absolute inset-0 flex items-center">
                            <div class="p-8 md:p-12 max-w-2xl text-white">

                                <p class="text-sm bg-white/20 inline-block px-3 py-1 rounded-full mb-4">
                                    Affiliate Store
                                </p>

                                <h2 class="text-4xl md:text-6xl font-bold leading-tight">
                                    {{ $slider->slider_judul ?? $client->user_brand_name }}
                                </h2>

                                @if ($slider->slider_subjudul)
                                    <p class="mt-4 text-white/80 text-lg">
                                        {{ $slider->slider_subjudul }}
                                    </p>
                                @endif

                                @if ($slider->slider_link)
                                    <a href="{{ $slider->slider_link }}"
                                        class="inline-block mt-6 bg-white px-6 py-3 rounded-2xl font-semibold"
                                        style="color: var(--primary);">
                                        Lihat Sekarang
                                    </a>
                                @else
                                    <a href="#produk" class="inline-block mt-6 bg-white px-6 py-3 rounded-2xl font-semibold"
                                        style="color: var(--primary);">
                                        Jelajahi Produk
                                    </a>
                                @endif

                            </div>
                        </div>

                    </div>
                @endforeach

            </div>
        @else
            <div class="relative overflow-hidden rounded-[32px] bg-white/70 border theme-border shadow-xl">

                <div class="min-h-[320px] md:min-h-[440px] flex items-center">
                    <div class="p-8 md:p-12 max-w-2xl">

                        <p class="text-sm theme-soft theme-text inline-block px-3 py-1 rounded-full mb-4">
                            Affiliate Store
                        </p>

                        <h2 class="text-4xl md:text-6xl font-bold leading-tight text-slate-800">
                            {{ $client->user_brand_name ?? 'ARIN Store' }}
                        </h2>

                        <p class="mt-4 text-slate-500 text-lg">
                            {{ $client->user_description ?? ($client->user_tagline ?? 'Website affiliate kamu siap digunakan.') }}
                        </p>

                        <a href="#produk" class="inline-block mt-6 theme-button px-6 py-3 rounded-2xl font-semibold">
                            Jelajahi Produk
                        </a>

                    </div>
                </div>

                <div class="absolute right-6 bottom-6 hidden md:block">
                    <div class="w-56 h-56 rounded-[40px] theme-soft flex items-center justify-center">
                        @if ($client->user_logo)
                            <img src="{{ asset($client->user_logo) }}" class="w-32 h-32 rounded-[32px] object-cover">
                        @else
                            <div
                                class="w-32 h-32 rounded-[32px] theme-button flex items-center justify-center text-5xl font-bold">
                                {{ strtoupper(substr($client->user_brand_name ?? 'A', 0, 1)) }}
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        @endif

    </section>

    {{-- KATEGORI --}}
    <section id="kategori" class="max-w-7xl mx-auto px-4 mt-14">

        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold">
                Kategori Pilihan
            </h2>
        </div>

        @if (isset($kategori) && $kategori->count())
            <div class="swiper kategoriSwiper">

                <div class="swiper-wrapper">

                    @foreach ($kategori as $kat)
                        <div class="swiper-slide !w-[180px]">

                            <a href="{{ route('front.kategori.show', [
                                'clientSlug' => $client->user_slug,
                                'slug' => $kat->kategori_slug,
                            ]) }}"
                                class="block bg-white/70 backdrop-blur-xl border theme-border rounded-3xl p-4 hover:shadow-xl transition">

                                @if ($kat->kategori_thumbnail)
                                    <img src="{{ asset($kat->kategori_thumbnail) }}"
                                        class="w-full h-32 object-cover rounded-2xl mb-4">
                                @else
                                    <div
                                        class="w-full h-32 theme-soft rounded-2xl mb-4 flex items-center justify-center theme-text font-bold">
                                        {{ strtoupper(substr($kat->kategori_nama, 0, 1)) }}
                                    </div>
                                @endif

                                <h3 class="font-semibold">
                                    {{ $kat->kategori_nama }}
                                </h3>

                            </a>

                        </div>
                    @endforeach

                </div>

            </div>
        @else
            <div class="bg-white/70 backdrop-blur-xl border theme-border rounded-3xl p-10 text-center">
                <h3 class="font-bold text-xl">
                    Belum ada kategori
                </h3>

                <p class="text-slate-400 mt-2">
                    Kategori akan tampil setelah ditambahkan melalui dashboard.
                </p>
            </div>
        @endif

    </section>

    {{-- FEATURED PRODUCT --}}
    @if (isset($featuredProducts) && $featuredProducts->count())
        <section class="max-w-7xl mx-auto px-4 mt-14">

            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold">
                    Produk Unggulan
                </h2>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
                @foreach ($featuredProducts as $product)
                    @include('front.client.product-card', ['product' => $product, 'client' => $client])
                @endforeach
            </div>

        </section>
    @endif

    {{-- LATEST PRODUCT --}}
    <section id="produk" class="max-w-7xl mx-auto px-4 mt-14">

        <div class="flex flex-col md:flex-row gap-4 justify-between">

            <h2 class="text-2xl font-bold">
                Produk Terbaru
            </h2>

            <input type="text" id="searchProduct" placeholder="Cari produk..."
                class="
            px-4
            py-3
            rounded-2xl
            border
            bg-white
            w-full
            md:w-80
        ">

        </div>

        @if (isset($latestProducts) && $latestProducts->count())
            <div id="productContainer" class="grid grid-cols-2 md:grid-cols-4 gap-5">
                @foreach ($latestProducts as $product)
                    @include('front.client.product-card', ['product' => $product, 'client' => $client])
                @endforeach
            </div>
        @else
            <div class="bg-white/70 backdrop-blur-xl border theme-border rounded-3xl p-10 text-center">
                <h3 class="font-bold text-xl">
                    Belum ada produk
                </h3>

                <p class="text-slate-400 mt-2">
                    Produk affiliate akan tampil setelah ditambahkan melalui dashboard.
                </p>
            </div>
        @endif

    </section>

@endsection
