@extends('admin.layouts.app')

@section('title', 'Detail Client')
@section('page_title', 'Detail Client')

@section('content')

@if(session('success'))
    <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-600 rounded-xl">
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <div class="lg:col-span-2 bg-white rounded-3xl shadow p-6">

        <h2 class="text-2xl font-bold mb-6">
            {{ $item->user_nama }}
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">

            <div>
                <p class="text-gray-500">Email</p>
                <p class="font-semibold">{{ $item->user_email }}</p>
            </div>

            <div>
                <p class="text-gray-500">Paket</p>
                <p class="font-semibold">{{ ucfirst($item->user_package) }}</p>
            </div>

            <div>
                <p class="text-gray-500">Brand Website</p>
                <p class="font-semibold">{{ $item->user_brand_name ?? '-' }}</p>
            </div>

            <div>
                <p class="text-gray-500">Slug</p>
                <p class="font-semibold">/{{ $item->user_slug }}</p>
            </div>

            <div>
                <p class="text-gray-500">Expired</p>
                <p class="font-semibold">
                    {{ $item->user_expired_at ? $item->user_expired_at->format('d M Y H:i') : '-' }}
                </p>
            </div>

            <div>
                <p class="text-gray-500">Status</p>
                <p class="font-semibold">
                    {{ $item->user_is_active ? 'Aktif' : 'Nonaktif' }}
                </p>
            </div>

            <div>
                <p class="text-gray-500">Trial</p>
                <p class="font-semibold">
                    {{ $item->user_is_trial ? 'Ya' : 'Tidak' }}
                </p>
            </div>

            <div>
                <p class="text-gray-500">Setup</p>
                <p class="font-semibold">
                    {{ $item->user_is_setup_done ? 'Selesai' : 'Belum' }}
                </p>
            </div>

        </div>

        <div class="mt-8">
            <p class="text-gray-500 text-sm">Link Website</p>

            <a href="{{ url('/'.$item->user_slug) }}"
               target="_blank"
               class="text-pink-600 font-semibold break-all">
                {{ url('/'.$item->user_slug) }}
            </a>
        </div>

    </div>

    <div class="bg-white rounded-3xl shadow p-6 h-fit">

        <h3 class="font-bold text-lg mb-4">
            Aksi Cepat
        </h3>

        <a href="{{ route('admin.client.edit', $item->user_id) }}"
           class="block bg-blue-600 text-white px-5 py-3 rounded-2xl text-center">
            Edit Client
        </a>

        <form method="POST"
              action="{{ route('admin.client.extend', $item->user_id) }}"
              class="mt-4">
            @csrf
            @method('PATCH')

            <label class="text-sm text-gray-600">Perpanjang Hari</label>

            <input type="number"
                   name="extend_days"
                   value="30"
                   class="w-full mt-1 p-3 rounded-xl border">

            <button class="w-full mt-3 bg-green-600 text-white px-5 py-3 rounded-2xl">
                Perpanjang
            </button>
        </form>

        <form method="POST"
              action="{{ route('admin.client.toggle', $item->user_id) }}"
              class="mt-3">
            @csrf
            @method('PATCH')

            @if($item->user_is_active)
                <button class="w-full bg-yellow-500 text-white px-5 py-3 rounded-2xl">
                    Nonaktifkan
                </button>
            @else
                <button class="w-full bg-green-500 text-white px-5 py-3 rounded-2xl">
                    Aktifkan
                </button>
            @endif
        </form>

        <a href="{{ route('admin.client.index') }}"
           class="block mt-3 bg-slate-100 text-slate-700 px-5 py-3 rounded-2xl text-center">
            Kembali
        </a>

    </div>

</div>

@endsection