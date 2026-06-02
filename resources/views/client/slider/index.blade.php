@extends('client.layouts.app')

@section('title', 'Slider')
@section('page_title', 'Slider')

@section('content')

<div class="flex justify-between mb-6">
    <h1 class="text-2xl font-bold">Slider</h1>

    <a href="{{ route('client.slider.create') }}"
       class="theme-button px-4 py-2 rounded-2xl">
        + Tambah Slider
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
                <th class="p-3">Image</th>
                <th class="p-3">Judul</th>
                <th class="p-3">Link</th>
                <th class="p-3">Sort</th>
                <th class="p-3">Status</th>
                <th class="p-3">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($data as $item)
                <tr class="border-b hover:bg-gray-50">

                    <td class="p-3">
                        @if($item->slider_image)
                            <img src="{{ asset($item->slider_image) }}"
                                 class="w-24 h-14 rounded-xl object-cover">
                        @else
                            <div class="w-24 h-14 bg-pink-100 rounded-xl"></div>
                        @endif
                    </td>

                    <td class="p-3">
                        <div class="font-semibold">
                            {{ $item->slider_judul ?? '-' }}
                        </div>

                        @if($item->slider_subjudul)
                            <div class="text-xs text-gray-400 mt-1">
                                {{ Str::limit($item->slider_subjudul, 60) }}
                            </div>
                        @endif
                    </td>

                    <td class="p-3 text-gray-500">
                        {{ $item->slider_link ?? '-' }}
                    </td>

                    <td class="p-3">
                        {{ $item->slider_sort_order }}
                    </td>

                    <td class="p-3">
                        @if($item->slider_is_active)
                            <span class="px-2 py-1 text-xs bg-green-100 text-green-600 rounded-xl">
                                Active
                            </span>
                        @else
                            <span class="px-2 py-1 text-xs bg-red-100 text-red-600 rounded-xl">
                                Inactive
                            </span>
                        @endif
                    </td>

                    <td class="p-3 flex gap-2">

                        <a href="{{ route('client.slider.edit', $item->slider_id) }}"
                           class="px-3 py-1 bg-blue-100 text-blue-600 rounded-xl text-xs">
                            Edit
                        </a>

                        <form method="POST" action="{{ route('client.slider.toggle', $item->slider_id) }}">
                            @csrf
                            @method('PATCH')

                            @if($item->slider_is_active)
                                <button class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-xl text-xs">
                                    Nonaktifkan
                                </button>
                            @else
                                <button class="px-3 py-1 bg-green-100 text-green-600 rounded-xl text-xs">
                                    Aktifkan
                                </button>
                            @endif
                        </form>

                        <form method="POST" action="{{ route('client.slider.destroy', $item->slider_id) }}">
                            @csrf
                            @method('DELETE')

                            <button onclick="return confirm('Hapus slider ini?')"
                                    class="px-3 py-1 bg-red-100 text-red-600 rounded-xl text-xs">
                                Hapus
                            </button>
                        </form>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="p-6 text-center text-gray-400">
                        Belum ada slider.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection