@extends('admin.layouts.app')

@section('title', 'Setting Website')
@section('page_title', 'Setting Website')

@section('content')

@if(session('success'))
<div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-600 rounded-xl">
    {{ session('success') }}
</div>
@endif

<form method="POST"
      action="{{ route('admin.setting.update') }}"
      enctype="multipart/form-data"
      class="bg-white rounded-3xl shadow p-6 space-y-6">

    @csrf
    @method('PUT')

    <div>
        <label>Nama Aplikasi</label>

        <input
            type="text"
            name="app_name"
            value="{{ old('app_name',$setting->app_name) }}"
            class="w-full mt-1 p-3 rounded-xl border">
    </div>

    <div>
        <label>Email Support</label>

        <input
            type="email"
            name="support_email"
            value="{{ old('support_email',$setting->support_email) }}"
            class="w-full mt-1 p-3 rounded-xl border">
    </div>

    <div>
        <label>Whatsapp Support</label>

        <input
            type="text"
            name="support_whatsapp"
            value="{{ old('support_whatsapp',$setting->support_whatsapp) }}"
            class="w-full mt-1 p-3 rounded-xl border">
    </div>

    <div>
        <label>Footer</label>

        <input
            type="text"
            name="footer_text"
            value="{{ old('footer_text',$setting->footer_text) }}"
            class="w-full mt-1 p-3 rounded-xl border">
    </div>

    <div>
        <label>Logo</label>

        <input
            type="file"
            name="app_logo"
            class="w-full mt-1 p-3 rounded-xl border">

        @if($setting->app_logo)
            <img src="{{ asset($setting->app_logo) }}"
                 class="h-20 mt-3">
        @endif
    </div>

    <div>
        <label>Favicon</label>

        <input
            type="file"
            name="app_favicon"
            class="w-full mt-1 p-3 rounded-xl border">

        @if($setting->app_favicon)
            <img src="{{ asset($setting->app_favicon) }}"
                 class="h-12 mt-3">
        @endif
    </div>

    <button class="bg-pink-500 text-white px-6 py-3 rounded-xl">
        Simpan Setting
    </button>

</form>

@endsection