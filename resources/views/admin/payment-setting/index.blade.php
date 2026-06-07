@extends('admin.layouts.app')

@section('title', 'Setting Pembayaran')
@section('page_title', 'Setting Pembayaran')

@section('content')

@if(session('success'))
    <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-600 rounded-xl">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-600 rounded-xl">
        {{ $errors->first() }}
    </div>
@endif

<form method="POST"
      action="{{ route('admin.payment.setting.update') }}"
      enctype="multipart/form-data"
      class="bg-white/70 backdrop-blur-xl border border-pink-100 rounded-2xl p-6 space-y-6">

    @csrf
    @method('PUT')

    <div>
        <h2 class="text-xl font-bold">QRIS</h2>
        <p class="text-sm text-gray-500">
            Upload gambar QRIS yang akan tampil di halaman pembayaran client.
        </p>
    </div>

    <div>
        <label class="text-sm text-gray-600">Gambar QRIS</label>
        <input type="file"
               name="payment_qris_image"
               class="w-full mt-1 p-3 rounded-xl border border-pink-100 bg-white">

        @if($setting->payment_qris_image)
            <img src="{{ asset($setting->payment_qris_image) }}"
                 class="w-60 rounded-2xl border mt-4">
        @endif
    </div>

    <div class="border-t border-pink-100 pt-6">
        <h2 class="text-xl font-bold">Rekening Utama</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

        <div>
            <label class="text-sm text-gray-600">Nama Bank</label>
            <input type="text"
                   name="payment_bank_name"
                   value="{{ old('payment_bank_name', $setting->payment_bank_name) }}"
                   class="w-full mt-1 p-3 rounded-xl border border-pink-100">
        </div>

        <div>
            <label class="text-sm text-gray-600">Nomor Rekening</label>
            <input type="text"
                   name="payment_bank_number"
                   value="{{ old('payment_bank_number', $setting->payment_bank_number) }}"
                   class="w-full mt-1 p-3 rounded-xl border border-pink-100">
        </div>

        <div>
            <label class="text-sm text-gray-600">Atas Nama</label>
            <input type="text"
                   name="payment_bank_holder"
                   value="{{ old('payment_bank_holder', $setting->payment_bank_holder) }}"
                   class="w-full mt-1 p-3 rounded-xl border border-pink-100">
        </div>

    </div>

    <div class="border-t border-pink-100 pt-6">
        <h2 class="text-xl font-bold">Rekening Kedua</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

        <div>
            <label class="text-sm text-gray-600">Nama Bank</label>
            <input type="text"
                   name="payment_bank_name_2"
                   value="{{ old('payment_bank_name_2', $setting->payment_bank_name_2) }}"
                   class="w-full mt-1 p-3 rounded-xl border border-pink-100">
        </div>

        <div>
            <label class="text-sm text-gray-600">Nomor Rekening</label>
            <input type="text"
                   name="payment_bank_number_2"
                   value="{{ old('payment_bank_number_2', $setting->payment_bank_number_2) }}"
                   class="w-full mt-1 p-3 rounded-xl border border-pink-100">
        </div>

        <div>
            <label class="text-sm text-gray-600">Atas Nama</label>
            <input type="text"
                   name="payment_bank_holder_2"
                   value="{{ old('payment_bank_holder_2', $setting->payment_bank_holder_2) }}"
                   class="w-full mt-1 p-3 rounded-xl border border-pink-100">
        </div>

    </div>

    <div class="border-t border-pink-100 pt-6">
        <h2 class="text-xl font-bold">Kontak & Catatan</h2>
    </div>

    <div>
        <label class="text-sm text-gray-600">WhatsApp Admin</label>
        <input type="text"
               name="payment_whatsapp"
               value="{{ old('payment_whatsapp', $setting->payment_whatsapp) }}"
               placeholder="6281234567890"
               class="w-full mt-1 p-3 rounded-xl border border-pink-100">
    </div>

    <div>
        <label class="text-sm text-gray-600">Catatan Pembayaran</label>
        <textarea name="payment_note"
                  rows="4"
                  class="w-full mt-1 p-3 rounded-xl border border-pink-100">{{ old('payment_note', $setting->payment_note) }}</textarea>
    </div>

    <button class="bg-pink-500 text-white px-6 py-3 rounded-xl">
        Simpan Setting Pembayaran
    </button>

</form>

@endsection