@extends('admin.layouts.app')

@section('title', 'Setting Pembayaran')
@section('page_title', 'Setting Pembayaran')

@section('content')

@if(session('success'))
    <div class="mb-5 p-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="mb-5 p-4 bg-red-50 border border-red-200 text-red-700 rounded-2xl">
        {{ $errors->first() }}
    </div>
@endif

<form
    method="POST"
    action="{{ route('admin.payment.setting.update') }}"
    enctype="multipart/form-data"
    class="bg-white rounded-3xl shadow p-8 space-y-8">

    @csrf
    @method('PUT')

    <div>

        <h2 class="text-2xl font-bold">
            Gateway Pembayaran
        </h2>

        <p class="text-gray-500 mt-2">
            Pilih metode pembayaran yang digunakan client.
        </p>

        <select
            name="payment_gateway"
            class="w-full mt-4 p-3 rounded-2xl border">

            <option
                value="manual"
                {{ $setting->payment_gateway == 'manual' ? 'selected' : '' }}>
                Manual Transfer
            </option>

            <option
                value="midtrans"
                {{ $setting->payment_gateway == 'midtrans' ? 'selected' : '' }}>
                Midtrans
            </option>

        </select>

    </div>

    <div class="border-t pt-8">

        <h2 class="text-2xl font-bold">
            QRIS
        </h2>

        <p class="text-gray-500 mt-2">
            Upload QRIS pembayaran.
        </p>

        <input
            type="file"
            name="payment_qris_image"
            class="w-full mt-4 p-3 rounded-2xl border">

        @if($setting->payment_qris_image)
            <img
                src="{{ asset($setting->payment_qris_image) }}"
                class="w-72 mt-5 rounded-2xl border">
        @endif

    </div>

    <div class="border-t pt-8">

        <h2 class="text-2xl font-bold">
            Rekening 1
        </h2>

        <div class="grid md:grid-cols-3 gap-5 mt-5">

            <input
                type="text"
                name="payment_bank_name"
                placeholder="Nama Bank"
                value="{{ old('payment_bank_name', $setting->payment_bank_name) }}"
                class="p-3 rounded-2xl border">

            <input
                type="text"
                name="payment_bank_number"
                placeholder="Nomor Rekening"
                value="{{ old('payment_bank_number', $setting->payment_bank_number) }}"
                class="p-3 rounded-2xl border">

            <input
                type="text"
                name="payment_bank_holder"
                placeholder="Atas Nama"
                value="{{ old('payment_bank_holder', $setting->payment_bank_holder) }}"
                class="p-3 rounded-2xl border">

        </div>

    </div>

    <div class="border-t pt-8">

        <h2 class="text-2xl font-bold">
            Rekening 2
        </h2>

        <div class="grid md:grid-cols-3 gap-5 mt-5">

            <input
                type="text"
                name="payment_bank_name_2"
                placeholder="Nama Bank"
                value="{{ old('payment_bank_name_2', $setting->payment_bank_name_2) }}"
                class="p-3 rounded-2xl border">

            <input
                type="text"
                name="payment_bank_number_2"
                placeholder="Nomor Rekening"
                value="{{ old('payment_bank_number_2', $setting->payment_bank_number_2) }}"
                class="p-3 rounded-2xl border">

            <input
                type="text"
                name="payment_bank_holder_2"
                placeholder="Atas Nama"
                value="{{ old('payment_bank_holder_2', $setting->payment_bank_holder_2) }}"
                class="p-3 rounded-2xl border">

        </div>

    </div>

    <div class="border-t pt-8">

        <h2 class="text-2xl font-bold">
            Rekening 3
        </h2>

        <div class="grid md:grid-cols-3 gap-5 mt-5">

            <input
                type="text"
                name="payment_bank_name_3"
                placeholder="Nama Bank"
                value="{{ old('payment_bank_name_3', $setting->payment_bank_name_3) }}"
                class="p-3 rounded-2xl border">

            <input
                type="text"
                name="payment_bank_number_3"
                placeholder="Nomor Rekening"
                value="{{ old('payment_bank_number_3', $setting->payment_bank_number_3) }}"
                class="p-3 rounded-2xl border">

            <input
                type="text"
                name="payment_bank_holder_3"
                placeholder="Atas Nama"
                value="{{ old('payment_bank_holder_3', $setting->payment_bank_holder_3) }}"
                class="p-3 rounded-2xl border">

        </div>

    </div>

    <div class="border-t pt-8">

        <h2 class="text-2xl font-bold">
            Midtrans
        </h2>

        <div class="space-y-5 mt-5">

            <div>
                <label class="text-sm text-gray-600">
                    Server Key
                </label>

                <input
                    type="text"
                    name="midtrans_server_key"
                    value="{{ old('midtrans_server_key', $setting->midtrans_server_key) }}"
                    class="w-full mt-2 p-3 rounded-2xl border">
            </div>

            <div>
                <label class="text-sm text-gray-600">
                    Client Key
                </label>

                <input
                    type="text"
                    name="midtrans_client_key"
                    value="{{ old('midtrans_client_key', $setting->midtrans_client_key) }}"
                    class="w-full mt-2 p-3 rounded-2xl border">
            </div>

            <label class="flex items-center gap-3">

                <input
                    type="checkbox"
                    name="midtrans_is_production"
                    value="1"
                    {{ $setting->midtrans_is_production ? 'checked' : '' }}>

                Production Mode

            </label>

        </div>

    </div>

    <div class="border-t pt-8">

        <h2 class="text-2xl font-bold">
            Kontak
        </h2>

        <input
            type="text"
            name="payment_whatsapp"
            value="{{ old('payment_whatsapp', $setting->payment_whatsapp) }}"
            placeholder="6281234567890"
            class="w-full mt-5 p-3 rounded-2xl border">

        <textarea
            name="payment_note"
            rows="5"
            class="w-full mt-5 p-3 rounded-2xl border"
            placeholder="Catatan pembayaran...">{{ old('payment_note', $setting->payment_note) }}</textarea>

    </div>

    <button
        class="px-8 py-4 bg-pink-600 text-white rounded-2xl font-semibold">

        Simpan Setting Pembayaran

    </button>

</form>

@endsection