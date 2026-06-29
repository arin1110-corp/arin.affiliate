@extends('front.client.layout')

@section('meta_title', $kategori->kategori_meta_title ?? $kategori->kategori_nama)
@section('meta_description', $kategori->kategori_meta_description ?? $kategori->kategori_deskripsi)

@section('content')

<section class="max-w-7xl mx-auto px-4 py-10">

    <div class="bg-white/70 border theme-border rounded-[32px] p-8 shadow-xl mb-8">

        <h1 class="text-3xl md:text-5xl font-bold theme-text">
            {{ $kategori->kategori_nama }}
        </h1>

        @if($kategori->kategori_deskripsi)
            <p class="text-slate-500 mt-4 max-w-2xl">
                {{ $kategori->kategori_deskripsi }}
            </p>
        @endif

    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-5">

        @forelse($products as $product)

            @include(
                'front.client.product-card',
                [
                    'product' => $product,
                    'client' => $client
                ]
            )

        @empty

            <div
                class="
                    col-span-full
                    bg-white/70
                    border
                    theme-border
                    rounded-3xl
                    p-10
                    text-center
                    text-slate-400
                ">

                Belum ada produk aktif pada kategori ini.

            </div>

        @endforelse

    </div>

    <div class="mt-8">
        {{ $products->links() }}
    </div>

</section>

@endsection