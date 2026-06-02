@extends('client.layouts.app')

@section('title', 'Produk')
@section('page_title', 'Produk')

@section('content')

<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold">Produk</h1>
        <p class="text-sm text-gray-500 mt-1">
            Kelola produk affiliate yang tampil di website kamu.
        </p>
    </div>

    <a href="{{ route('client.product.create') }}"
       class="theme-button px-4 py-3 rounded-2xl text-center font-medium">
        + Tambah Produk
    </a>
</div>

@if(session('success'))
    <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-600 rounded-xl">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white/80 backdrop-blur-xl border theme-border rounded-3xl shadow p-4 overflow-x-auto">

    <table class="w-full text-sm">
        <thead>
            <tr class="text-left border-b">
                <th class="p-3">Foto</th>
                <th class="p-3">Produk</th>
                <th class="p-3">Kategori</th>
                <th class="p-3">Harga</th>
                <th class="p-3">Click</th>
                <th class="p-3">Status</th>
                <th class="p-3 text-right">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($data as $item)
                <tr class="border-b hover:bg-gray-50">

                    <td class="p-3">
                        @if($item->product_thumbnail)
                            <img src="{{ asset($item->product_thumbnail) }}"
                                 class="w-14 h-14 rounded-xl object-cover">
                        @else
                            <div class="w-14 h-14 theme-soft rounded-xl flex items-center justify-center theme-text font-bold">
                                {{ strtoupper(substr($item->product_nama, 0, 1)) }}
                            </div>
                        @endif
                    </td>

                    <td class="p-3">
                        <div class="font-semibold text-gray-800">
                            {{ $item->product_nama }}

                            @if($item->product_featured)
                                <span class="ml-2 text-xs bg-yellow-100 text-yellow-700 px-2 py-1 rounded-xl">
                                    Unggulan
                                </span>
                            @endif
                        </div>

                        <div class="text-xs text-gray-400 mt-1">
                            /{{ $item->product_slug }}
                        </div>

                        @if($item->product_deskripsi)
                            <div class="text-xs text-gray-500 mt-1 max-w-md">
                                {{ Str::limit($item->product_deskripsi, 80) }}
                            </div>
                        @endif
                    </td>

                    <td class="p-3">
                        {{ $item->kategori->kategori_nama ?? '-' }}
                    </td>

                    <td class="p-3">
                        @if($item->product_harga)
                            <span class="font-semibold theme-text">
                                Rp {{ number_format($item->product_harga, 0, ',', '.') }}
                            </span>
                        @else
                            -
                        @endif
                    </td>

                    <td class="p-3">
                        {{ number_format($item->product_total_click) }}
                    </td>

                    <td class="p-3">
                        @if($item->product_status === 'active')
                            <span class="px-2 py-1 text-xs bg-green-100 text-green-600 rounded-xl">
                                Aktif
                            </span>
                        @else
                            <span class="px-2 py-1 text-xs bg-gray-100 text-gray-600 rounded-xl">
                                Draft
                            </span>
                        @endif
                    </td>

                    <td class="p-3">
                        <div class="flex justify-end gap-2">

                            <a href="{{ route('client.product.edit', $item->product_id) }}"
                               class="px-3 py-1 bg-blue-100 text-blue-600 rounded-xl text-xs">
                                Edit
                            </a>

                            <a href="{{ route('front.product.click', [auth('arin')->user()->user_slug, $item->product_slug]) }}"
                               target="_blank"
                               class="px-3 py-1 theme-soft theme-text rounded-xl text-xs">
                                Test
                            </a>

                            <form method="POST" action="{{ route('client.product.toggle', $item->product_id) }}">
                                @csrf
                                @method('PATCH')

                                @if($item->product_status === 'active')
                                    <button class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-xl text-xs">
                                        Draft
                                    </button>
                                @else
                                    <button class="px-3 py-1 bg-green-100 text-green-600 rounded-xl text-xs">
                                        Aktifkan
                                    </button>
                                @endif
                            </form>

                            <form method="POST" action="{{ route('client.product.destroy', $item->product_id) }}">
                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Hapus produk ini?')"
                                        class="px-3 py-1 bg-red-100 text-red-600 rounded-xl text-xs">
                                    Hapus
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="p-10 text-center">
                        <div class="max-w-md mx-auto">
                            <div class="w-16 h-16 theme-soft theme-text rounded-3xl flex items-center justify-center mx-auto text-2xl font-bold">
                                +
                            </div>

                            <h3 class="font-bold text-lg mt-4">
                                Belum ada produk
                            </h3>

                            <p class="text-gray-400 mt-2">
                                Tambahkan produk affiliate pertama kamu agar website mulai terlihat hidup.
                            </p>

                            <a href="{{ route('client.product.create') }}"
                               class="inline-block mt-5 theme-button px-5 py-3 rounded-2xl">
                                Tambah Produk
                            </a>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection