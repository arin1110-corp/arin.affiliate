@extends('front.client.layout')

@section('content')

<section class="max-w-7xl mx-auto px-4 py-10">

    <div class="mb-10">

        <h1 class="text-4xl font-bold">
            {{ $kategori->kategori_nama }}
        </h1>

        @if($kategori->kategori_deskripsi)
            <p class="text-slate-500 mt-3">
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

            <div class="col-span-full text-center py-16 text-slate-400">

                Belum ada produk pada kategori ini.

            </div>

        @endforelse

    </div>

    <div class="mt-8">
        {{ $products->links() }}
    </div>

</section>

@endsection