@extends('admin.layouts.app')

@section('title', 'Edit Client')
@section('page_title', 'Edit Client')

@section('content')

@if($errors->any())
    <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-600 rounded-xl">
        {{ $errors->first() }}
    </div>
@endif

<form method="POST"
      action="{{ route('admin.client.update', $item->user_id) }}"
      class="bg-white rounded-3xl shadow p-6 space-y-6">

    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        <div>
            <label class="text-sm text-gray-600">Nama Client</label>
            <input type="text"
                   name="user_nama"
                   value="{{ old('user_nama', $item->user_nama) }}"
                   class="w-full mt-1 p-3 rounded-xl border"
                   required>
        </div>

        <div>
            <label class="text-sm text-gray-600">Email</label>
            <input type="email"
                   name="user_email"
                   value="{{ old('user_email', $item->user_email) }}"
                   class="w-full mt-1 p-3 rounded-xl border"
                   required>
        </div>

    </div>

    <div>
        <label class="text-sm text-gray-600">Slug Website</label>

        <div class="flex mt-1">
            <span class="px-4 py-3 bg-gray-100 border border-r-0 rounded-l-xl text-sm text-gray-500">
                {{ url('/') }}/
            </span>

            <input type="text"
                   name="user_slug"
                   value="{{ old('user_slug', $item->user_slug) }}"
                   class="flex-1 p-3 rounded-r-xl border"
                   required>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        <div>
            <label class="text-sm text-gray-600">Paket</label>
            <select name="user_package"
                    class="w-full mt-1 p-3 rounded-xl border bg-white"
                    required>
                @foreach($packages as $package)
                    <option value="{{ $package->package_slug }}"
                        {{ old('user_package', $item->user_package) == $package->package_slug ? 'selected' : '' }}>
                        {{ $package->package_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="text-sm text-gray-600">Expired At</label>
            <input type="datetime-local"
                   name="user_expired_at"
                   value="{{ old('user_expired_at', $item->user_expired_at ? $item->user_expired_at->format('Y-m-d\TH:i') : '') }}"
                   class="w-full mt-1 p-3 rounded-xl border">
        </div>

    </div>

    <div>
        <label class="text-sm text-gray-600">Password Baru</label>
        <input type="password"
               name="user_password"
               placeholder="Kosongkan jika tidak diganti"
               class="w-full mt-1 p-3 rounded-xl border">
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <label class="flex items-center gap-2 bg-green-50 border border-green-100 rounded-2xl p-4">
            <input type="checkbox"
                   name="user_is_active"
                   value="1"
                   {{ old('user_is_active', $item->user_is_active) ? 'checked' : '' }}>
            <span>Aktif</span>
        </label>

        <label class="flex items-center gap-2 bg-yellow-50 border border-yellow-100 rounded-2xl p-4">
            <input type="checkbox"
                   name="user_is_trial"
                   value="1"
                   {{ old('user_is_trial', $item->user_is_trial) ? 'checked' : '' }}>
            <span>Trial</span>
        </label>

        <label class="flex items-center gap-2 bg-pink-50 border border-pink-100 rounded-2xl p-4">
            <input type="checkbox"
                   name="user_is_promo"
                   value="1"
                   {{ old('user_is_promo', $item->user_is_promo) ? 'checked' : '' }}>
            <span>Promo</span>
        </label>

    </div>

    <div class="flex gap-3">
        <button class="bg-pink-500 text-white px-6 py-3 rounded-xl">
            Update Client
        </button>

        <a href="{{ route('admin.client.index') }}"
           class="bg-slate-100 text-slate-700 px-6 py-3 rounded-xl">
            Batal
        </a>
    </div>

</form>

@endsection