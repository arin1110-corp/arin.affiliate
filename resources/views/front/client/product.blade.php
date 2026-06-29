@extends('front.client.layout')

@section('content')

<section class="max-w-7xl mx-auto px-4 py-10">

    <div class="grid md:grid-cols-2 gap-10">

        <div>

            @if($product->product_thumbnail)

                <img
                    src="{{ asset($product->product_thumbnail) }}"
                    class="w-full rounded-3xl">

            @endif

        </div>

        <div>

            @if($product->kategori)

                <span
                    class="
                        px-3
                        py-1
                        rounded-xl
                        text-sm
                        theme-soft
                        theme-text
                    ">

                    {{ $product->kategori->kategori_nama }}

                </span>

            @endif

            <h1 class="text-4xl font-bold mt-4">
                {{ $product->product_nama }}
            </h1>

            @if($product->product_harga)

                <div class="text-3xl font-bold theme-text mt-5">

                    Rp {{ number_format($product->product_harga,0,',','.') }}

                </div>

            @endif

            @if($product->product_deskripsi)

                <div class="mt-6 text-slate-600">

                    {!! nl2br(e($product->product_deskripsi)) !!}

                </div>

            @endif

            @if($product->product_link)

                <a
                    href="{{ route('front.product.click', [$client->user_slug, $product->product_slug]) }}"
                    target="_blank"
                    class="
                        inline-block
                        mt-8
                        theme-button
                        px-8
                        py-4
                        rounded-2xl
                    ">

                    Beli Sekarang

                </a>

            @endif

        </div>

    </div>

    @if($relatedProducts->count())

        <div class="mt-20">

            <h2 class="text-2xl font-bold mb-6">

                Produk Terkait

            </h2>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-5">

                @foreach($relatedProducts as $item)

                    @include(
                        'front.client.product-card',
                        [
                            'product' => $item,
                            'client' => $client
                        ]
                    )

                @endforeach

            </div>

        </div>

    @endif

</section>

@endsection