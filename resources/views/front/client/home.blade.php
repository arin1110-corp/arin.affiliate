@extends('front.client.layout')

@section('content')

    {{-- HERO --}}
    <section class="max-w-7xl mx-auto px-4 pt-8">

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

    </section>

    {{-- KATEGORI --}}
    <section id="kategori" class="max-w-7xl mx-auto px-4 mt-14">

        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold">
                Kategori Pilihan
            </h2>
        </div>

        @if (isset($kategori) && $kategori->count())
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach ($kategori as $kat)
                    <div
                        class="bg-white/70 backdrop-blur-xl border theme-border rounded-3xl p-4 hover:shadow-xl transition">

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

                        @if ($kat->kategori_deskripsi)
                            <p class="text-xs text-slate-400 mt-1">
                                {{ Str::limit($kat->kategori_deskripsi, 60) }}
                            </p>
                        @endif

                    </div>
                @endforeach
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

    {{-- PRODUK --}}
    <section id="produk" class="max-w-7xl mx-auto px-4 mt-14">

        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold">
                Produk Terbaru
            </h2>
        </div>

        <div class="bg-white/70 backdrop-blur-xl border theme-border rounded-3xl p-10 text-center">
            <h3 class="font-bold text-xl">
                Belum ada produk
            </h3>

            <p class="text-slate-400 mt-2">
                Produk affiliate akan tampil setelah ditambahkan melalui dashboard.
            </p>
        </div>

    </section>

@endsection
