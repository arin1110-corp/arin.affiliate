@extends('front.client.layout')

@section('meta_title', $product->product_meta_title ?? $product->product_nama)
@section('meta_description', $product->product_meta_description ?? $product->product_deskripsi_ringkas)

@section('content')

<section class="max-w-7xl mx-auto px-4 py-10">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        <div class="bg-white/70 border theme-border rounded-[32px] p-4 shadow-xl">

            @if($product->product_thumbnail)

                <img
                    src="{{ asset($product->product_thumbnail) }}"
                    class="w-full h-[420px] object-cover rounded-[24px]">

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
                        {{ strtoupper(substr($product->product_nama,0,1)) }}
                    </span>

                </div>

            @endif

        </div>

        <div class="bg-white/70 border theme-border rounded-[32px] p-6 shadow-xl">

            <div class="flex gap-2 mb-4">

                @if($product->kategori)
                    <span class="text-xs theme-soft theme-text px-3 py-1 rounded-xl">
                        {{ $product->kategori->kategori_nama }}
                    </span>
                @endif

                @if($product->product_featured)
                    <span class="text-xs bg-yellow-100 text-yellow-700 px-3 py-1 rounded-xl">
                        Unggulan
                    </span>
                @endif

            </div>

            <h1 class="text-3xl md:text-4xl font-bold">
                {{ $product->product_nama }}
            </h1>

            @if($product->product_deskripsi_ringkas)
                <p class="text-slate-600 mt-5">
                    {{ $product->product_deskripsi_ringkas }}
                </p>
            @endif

            @if($product->product_harga)

                <div class="mt-6">

                    @if($product->product_harga_diskon)

                        <p class="text-sm line-through text-slate-400">
                            Rp {{ number_format($product->product_harga,0,',','.') }}
                        </p>

                        <p class="text-3xl font-bold theme-text">
                            Rp {{ number_format($product->product_harga_diskon,0,',','.') }}
                        </p>

                    @else

                        <p class="text-3xl font-bold theme-text">
                            Rp {{ number_format($product->product_harga,0,',','.') }}
                        </p>

                    @endif

                </div>

            @endif

            @if($product->product_link)

                <a
                    href="{{ route('front.product.click', [$client->user_slug, $product->product_slug]) }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="
                        block
                        text-center
                        mt-8
                        theme-button
                        py-4
                        rounded-2xl
                        font-semibold
                    ">

                    Beli Sekarang

                </a>

            @endif

            <p class="text-xs text-slate-400 mt-3 text-center">
                Harga dan stok dapat berubah sesuai marketplace.
            </p>

        </div>

    </div>

    @if($product->product_deskripsi)

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

    @if($relatedProducts->count())

        <div class="mt-12">

            <h2 class="text-2xl font-bold mb-6">
                Produk Terkait
            </h2>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-5">

                @foreach($relatedProducts as $related)

                    @include(
                        'front.client.product-card',
                        [
                            'product' => $related,
                            'client' => $client
                        ]
                    )

                @endforeach

            </div>

        </div>

    @endif

</section>

@endsection