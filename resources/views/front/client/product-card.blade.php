<div class="bg-white/70 backdrop-blur-xl border theme-border rounded-3xl overflow-hidden hover:shadow-xl transition">

    @if($product->product_thumbnail)
        <img src="{{ asset($product->product_thumbnail) }}"
             class="w-full h-44 object-cover">
    @else
        <div class="w-full h-44 theme-soft flex items-center justify-center theme-text font-bold">
            {{ strtoupper(substr($product->product_nama, 0, 1)) }}
        </div>
    @endif

    <div class="p-4">

        <div class="flex items-center gap-2 mb-2">
            @if($product->kategori)
                <span class="text-xs theme-soft theme-text px-2 py-1 rounded-xl">
                    {{ $product->kategori->kategori_nama }}
                </span>
            @endif

            @if($product->product_featured)
                <span class="text-xs bg-yellow-100 text-yellow-700 px-2 py-1 rounded-xl">
                    Unggulan
                </span>
            @endif
        </div>

        <h3 class="font-semibold leading-snug">
            {{ $product->product_nama }}
        </h3>

        @if($product->product_deskripsi)
            <p class="text-xs text-slate-400 mt-1">
                {{ Str::limit($product->product_deskripsi, 60) }}
            </p>
        @endif

        @if($product->product_harga)
            <p class="font-bold theme-text mt-3">
                Rp {{ number_format($product->product_harga, 0, ',', '.') }}
            </p>
        @endif

        <a href="{{ route('front.product.click', [$client->user_slug, $product->product_slug]) }}"
           target="_blank"
           class="block text-center mt-4 theme-button py-2 rounded-2xl text-sm">
            Beli Sekarang
        </a>

    </div>
</div>