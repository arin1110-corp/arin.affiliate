@extends('front.client.layout')

@section('meta_title', $product->product_meta_title ?? $product->product_nama)
@section('meta_description', $product->product_meta_description ?? $product->product_deskripsi_ringkas)

@section('content')

    <section class="max-w-7xl mx-auto px-4 py-10">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <div class="bg-white/70 border theme-border rounded-[32px] p-4 shadow-xl">

                @if ($product->product_thumbnail)
                    <img src="{{ asset($product->product_thumbnail) }}" class="w-full h-[420px] object-cover rounded-[24px]">
                @else
                    <div
                        class="
                        w-full
                        h-[420px]
                        theme-soft
                        rounded-[24px]
                        flex
                        items-center
                        justify-center
                    ">

                        <span class="text-7xl theme-text">
                            {{ strtoupper(substr($product->product_nama, 0, 1)) }}
                        </span>

                    </div>
                @endif

            </div>

            <div class="bg-white/70 border theme-border rounded-[32px] p-6 shadow-xl">

                <div class="flex gap-2 mb-4">

                    @if ($product->kategori)
                        <span class="text-xs theme-soft theme-text px-3 py-1 rounded-xl">
                            {{ $product->kategori->kategori_nama }}
                        </span>
                    @endif

                    @if ($product->product_featured)
                        <span class="text-xs bg-yellow-100 text-yellow-700 px-3 py-1 rounded-xl">
                            Unggulan
                        </span>
                    @endif

                </div>

                <h1 class="text-3xl md:text-4xl font-bold">
                    {{ $product->product_nama }}
                </h1>

                @if ($product->product_deskripsi_ringkas)
                    <p class="text-slate-600 mt-5">
                        {{ $product->product_deskripsi_ringkas }}
                    </p>
                @endif

                @if ($product->product_harga)

                    <div class="mt-6">

                        @if ($product->product_harga_diskon)
                            <p class="text-sm line-through text-slate-400">
                                Rp {{ number_format($product->product_harga, 0, ',', '.') }}
                            </p>

                            <p class="text-3xl font-bold theme-text">
                                Rp {{ number_format($product->product_harga_diskon, 0, ',', '.') }}
                            </p>
                        @else
                            <p class="text-3xl font-bold theme-text">
                                Rp {{ number_format($product->product_harga, 0, ',', '.') }}
                            </p>
                        @endif

                    </div>

                @endif


                @php

                    $marketplaces = [
                        [
                            'name' => 'Shopee',
                            'link' => $product->product_link_shopee,
                            'logo' => asset('assets/img/marketplace/shopee.svg'),
                        ],

                        [
                            'name' => 'Tokopedia',
                            'link' => $product->product_link_tokopedia,
                            'logo' => asset('assets/img/marketplace/tokopedia.png'),
                        ],

                        [
                            'name' => 'Lazada',
                            'link' => $product->product_link_lazada,
                            'logo' => asset('assets/img/marketplace/lazada.png'),
                        ],

                        [
                            'name' => 'TikTok Shop',
                            'link' => $product->product_link_tiktok,
                            'logo' => asset('assets/img/marketplace/tiktok.png'),
                        ],

                        [
                            'name' => 'Blibli',
                            'link' => $product->product_link_blibli,
                            'logo' => asset('assets/img/marketplace/blibli.svg'),
                        ],

                        [
                            'name' => 'Bukalapak',
                            'link' => $product->product_link_bukalapak,
                            'logo' => asset('assets/img/marketplace/bukalapak.png'),
                        ],
                    ];

                @endphp

                @if (collect($marketplaces)->whereNotNull('link')->count())

                    <div class="mt-6">

                        <h3 class="text-sm font-semibold text-slate-700 mb-3">

                            Available on

                        </h3>

                        <div class="rounded-2xl border border-slate-200 overflow-hidden">

                            @foreach ($marketplaces as $marketplace)
                                @continue(empty($marketplace['link']))

                                <a href="{{ $marketplace['link'] }}" target="_blank" rel="noopener noreferrer"
                                    class="flex items-center justify-between px-5 py-4 hover:bg-slate-50 transition border-b last:border-b-0">

                                    <div class="flex items-center gap-3">

                                        <img src="{{ $marketplace['logo'] }}" class="w-6 h-6 object-contain">

                                        <span class="font-medium text-slate-700">

                                            {{ $marketplace['name'] }}

                                        </span>

                                    </div>

                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />

                                    </svg>

                                </a>
                            @endforeach

                        </div>

                    </div>

                @endif

                <p class="text-xs text-slate-400 mt-3 text-center">
                    Harga dan stok dapat berubah sesuai marketplace.
                </p>

            </div>

        </div>

        @if ($product->product_deskripsi)
            <div
                class="
                bg-white/70
                border
                theme-border
                rounded-[32px]
                p-6
                shadow-xl
                mt-8
            ">

                <h2 class="text-2xl font-bold mb-4 theme-text">
                    Deskripsi Produk
                </h2>

                <div class="max-w-none text-slate-600 leading-relaxed">
                    {!! nl2br(e($product->product_deskripsi)) !!}
                </div>

            </div>
        @endif

        @if ($relatedProducts->count())

            <div class="mt-12">

                <h2 class="text-2xl font-bold mb-6">
                    Produk Terkait
                </h2>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-5">

                    @foreach ($relatedProducts as $related)
                        @include('front.client.product-card', [
                            'product' => $related,
                            'client' => $client,
                        ])
                    @endforeach

                </div>

            </div>

        @endif

    </section>

@endsection
