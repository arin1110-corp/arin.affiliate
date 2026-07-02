@extends('admin.layouts.app')

@section('title', 'Client')
@section('page_title', 'Client')

@section('content')

    <div class="flex justify-between mb-6">
        <h1 class="text-2xl font-bold">Client</h1>
    </div>

    @if (session('success'))
        <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-600 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-3xl shadow p-4 overflow-x-auto">

        <table class="w-full text-sm">
            <thead>
                <tr class="text-left border-b">
                    <th class="p-3">Client</th>
                    <th class="p-3">Website</th>
                    <th class="p-3">Paket</th>
                    <th class="p-3">Expired</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Setup</th>
                    <th class="p-3 text-right">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($data as $item)
                    <tr class="border-b hover:bg-gray-50">

                        <td class="p-3">
                            <div class="font-semibold">
                                {{ $item->user_nama }}
                            </div>

                            <div class="text-xs text-gray-400">
                                {{ $item->user_email }}
                            </div>
                        </td>

                        <td class="p-3">
                            <div class="font-medium">
                                {{ $item->user_brand_name ?? '-' }}
                            </div>

                            @php
                                $website = $item->user_domain
                                    ? 'https://' . $item->user_domain
                                    : 'https://' . $item->user_subdomain . '.' . config('app.domain');
                            @endphp

                            <a href="{{ $website }}" target="_blank" class="text-xs text-pink-600 break-all">

                                {{ $website }}

                            </a>
                        </td>

                        <td class="p-3">
                            {{ ucfirst($item->user_package) }}
                        </td>

                        <td class="p-3">
                            @if ($item->user_expired_at)
                                {{ $item->user_expired_at->format('d M Y') }}
                            @else
                                -
                            @endif
                        </td>

                        <td class="p-3">
                            @if ($item->user_is_active)
                                <span class="px-2 py-1 text-xs bg-green-100 text-green-600 rounded-xl">
                                    Aktif
                                </span>
                            @else
                                <span class="px-2 py-1 text-xs bg-red-100 text-red-600 rounded-xl">
                                    Nonaktif
                                </span>
                            @endif

                            @if ($item->user_is_trial)
                                <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-700 rounded-xl">
                                    Trial
                                </span>
                            @endif
                        </td>

                        <td class="p-3">
                            @if ($item->user_is_setup_done)
                                <span class="px-2 py-1 text-xs bg-blue-100 text-blue-600 rounded-xl">
                                    Selesai
                                </span>
                            @else
                                <span class="px-2 py-1 text-xs bg-gray-100 text-gray-600 rounded-xl">
                                    Belum
                                </span>
                            @endif
                        </td>

                        <td class="p-3">
                            <div class="flex justify-end gap-2">

                                <a href="{{ route('admin.client.show', $item->user_id) }}"
                                    class="px-3 py-1 bg-slate-100 text-slate-700 rounded-xl text-xs">
                                    Detail
                                </a>

                                <a href="{{ route('admin.client.edit', $item->user_id) }}"
                                    class="px-3 py-1 bg-blue-100 text-blue-600 rounded-xl text-xs">
                                    Edit
                                </a>

                                <form method="POST" action="{{ route('admin.client.toggle', $item->user_id) }}">
                                    @csrf
                                    @method('PATCH')

                                    @if ($item->user_is_active)
                                        <button class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-xl text-xs">
                                            Nonaktifkan
                                        </button>
                                    @else
                                        <button class="px-3 py-1 bg-green-100 text-green-600 rounded-xl text-xs">
                                            Aktifkan
                                        </button>
                                    @endif
                                </form>

                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-10 text-center text-gray-400">
                            Belum ada client.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

@endsection
