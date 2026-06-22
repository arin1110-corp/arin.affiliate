@extends('admin.layouts.app')

@section('title', 'Package')
@section('page_title', 'Package')

@section('content')

<div class="flex justify-between mb-6">
    <h1 class="text-2xl font-bold">Package</h1>

    <a href="{{ route('admin.package.create') }}"
       class="bg-pink-500 text-white px-4 py-2 rounded-2xl">
        + Tambah Package
    </a>
</div>

@if(session('success'))
    <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-600 rounded-xl">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-3xl shadow p-4 overflow-x-auto">

    <table class="w-full text-sm">
        <thead>
            <tr class="text-left border-b">
                <th class="p-3">Package</th>
                <th class="p-3">Harga</th>
                <th class="p-3">Masa Aktif</th>
                <th class="p-3">Limit</th>
                <th class="p-3">Fitur</th>
                <th class="p-3">Status</th>
                <th class="p-3 text-right">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($data as $item)
                <tr class="border-b hover:bg-gray-50">

                    <td class="p-3">
                        <div class="font-semibold">
                            {{ $item->package_nama }}
                        </div>

                        <div class="text-xs text-gray-400">
                            /{{ $item->package_slug }}
                        </div>

                        @if($item->package_deskripsi)
                            <div class="text-xs text-gray-500 mt-1 max-w-sm">
                                {{ Str::limit($item->package_deskripsi, 70) }}
                            </div>
                        @endif
                    </td>

                    <td class="p-3">
                        <div class="font-semibold">
                            Rp {{ number_format($item->package_harga_normal, 0, ',', '.') }}
                        </div>

                        @if($item->package_harga_promo)
                            <div class="text-xs text-pink-600 font-semibold">
                                Promo Rp {{ number_format($item->package_harga_promo, 0, ',', '.') }}
                            </div>
                        @endif
                    </td>

                    <td class="p-3">
                        {{ $item->package_masa_aktif }} hari
                    </td>

                    <td class="p-3 text-xs text-gray-600">
                        Produk: {{ $item->package_max_product }}<br>
                        Slider: {{ $item->package_max_slider }}<br>
                        Kategori: {{ $item->package_max_category }}
                    </td>

                    <td class="p-3 text-xs space-y-1">
                        @if($item->package_custom_domain)
                            <span class="inline-block px-2 py-1 bg-blue-100 text-blue-600 rounded-xl">
                                Custom Domain
                            </span>
                        @endif

                        @if($item->package_remove_branding)
                            <span class="inline-block px-2 py-1 bg-purple-100 text-purple-600 rounded-xl">
                                No Branding
                            </span>
                        @endif

                        @if($item->package_google_analytics)
                            <span class="inline-block px-2 py-1 bg-green-100 text-green-600 rounded-xl">
                                Analytics
                            </span>
                        @endif

                        @if($item->package_meta_pixel)
                            <span class="inline-block px-2 py-1 bg-orange-100 text-orange-600 rounded-xl">
                                Meta Pixel
                            </span>
                        @endif
                    </td>

                    <td class="p-3">
                        @if($item->package_is_active)
                            <span class="px-2 py-1 text-xs bg-green-100 text-green-600 rounded-xl">
                                Aktif
                            </span>
                        @else
                            <span class="px-2 py-1 text-xs bg-red-100 text-red-600 rounded-xl">
                                Nonaktif
                            </span>
                        @endif
                    </td>

                    <td class="p-3">
                        <div class="flex justify-end gap-2">

                            <a href="{{ route('admin.package.edit', $item->package_id) }}"
                               class="px-3 py-1 bg-blue-100 text-blue-600 rounded-xl text-xs">
                                Edit
                            </a>

                            <form method="POST" action="{{ route('admin.package.toggle', $item->package_id) }}">
                                @csrf
                                @method('PATCH')

                                @if($item->package_is_active)
                                    <button class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-xl text-xs">
                                        Nonaktifkan
                                    </button>
                                @else
                                    <button class="px-3 py-1 bg-green-100 text-green-600 rounded-xl text-xs">
                                        Aktifkan
                                    </button>
                                @endif
                            </form>

                            <form method="POST" action="{{ route('admin.package.destroy', $item->package_id) }}">
                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Hapus package ini?')"
                                        class="px-3 py-1 bg-red-100 text-red-600 rounded-xl text-xs">
                                    Hapus
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="7" class="p-10 text-center text-gray-400">
                        Belum ada package.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection