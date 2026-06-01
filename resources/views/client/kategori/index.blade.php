@extends('client.layouts.app')

@section('title', 'Kategori')
@section('page_title', 'Kategori')

@section('content')

<div class="flex justify-between mb-6">
    <h1 class="text-2xl font-bold">Kategori</h1>

    <a href="{{ route('client.kategori.create') }}"
       class="bg-pink-600 text-white px-4 py-2 rounded-2xl">
        + Tambah Kategori
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
                <th class="p-3">Thumbnail</th>
                <th class="p-3">Nama</th>
                <th class="p-3">Slug</th>
                <th class="p-3">Visible</th>
                <th class="p-3">Status</th>
                <th class="p-3">Sort</th>
                <th class="p-3">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($data as $item)
                <tr class="border-b hover:bg-gray-50">

                    <td class="p-3">
                        @if($item->kategori_thumbnail)
                            <img src="{{ asset($item->kategori_thumbnail) }}"
                                 class="w-14 h-14 rounded-xl object-cover">
                        @else
                            <div class="w-14 h-14 bg-pink-100 rounded-xl"></div>
                        @endif
                    </td>

                    <td class="p-3 font-medium">
                        {{ $item->kategori_nama }}
                    </td>

                    <td class="p-3 text-gray-500">
                        {{ $item->kategori_slug }}
                    </td>

                    <td class="p-3">
                        @if($item->kategori_is_visible)
                            <span class="px-2 py-1 text-xs bg-blue-100 text-blue-600 rounded-xl">
                                Visible
                            </span>
                        @else
                            <span class="px-2 py-1 text-xs bg-gray-100 text-gray-600 rounded-xl">
                                Hidden
                            </span>
                        @endif
                    </td>

                    <td class="p-3">
                        @if($item->kategori_is_active)
                            <span class="px-2 py-1 text-xs bg-green-100 text-green-600 rounded-xl">
                                Active
                            </span>
                        @else
                            <span class="px-2 py-1 text-xs bg-red-100 text-red-600 rounded-xl">
                                Inactive
                            </span>
                        @endif
                    </td>

                    <td class="p-3">
                        {{ $item->kategori_sort_order }}
                    </td>

                    <td class="p-3 flex gap-2">

                        <a href="{{ route('client.kategori.edit', $item->kategori_id) }}"
                           class="px-3 py-1 bg-blue-100 text-blue-600 rounded-xl text-xs">
                            Edit
                        </a>

                        <form method="POST" action="{{ route('client.kategori.toggle', $item->kategori_id) }}">
                            @csrf
                            @method('PATCH')

                            @if($item->kategori_is_active)
                                <button class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-xl text-xs">
                                    Nonaktifkan
                                </button>
                            @else
                                <button class="px-3 py-1 bg-green-100 text-green-600 rounded-xl text-xs">
                                    Aktifkan
                                </button>
                            @endif
                        </form>

                        <form method="POST" action="{{ route('client.kategori.destroy', $item->kategori_id) }}">
                            @csrf
                            @method('DELETE')

                            <button onclick="return confirm('Hapus kategori ini?')"
                                    class="px-3 py-1 bg-red-100 text-red-600 rounded-xl text-xs">
                                Hapus
                            </button>
                        </form>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="p-6 text-center text-gray-400">
                        Belum ada kategori.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection