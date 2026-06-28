@extends('client.layouts.app')

@section('title', 'Setting Website')
@section('page_title', 'Setting Website')

@php
    $landing = \App\Models\ModelLandingSetting::first();
    $appSetting = \App\Models\ModelSetting::first();

    $primary = $user->user_theme_primary
        ?? $landing->primary_color
        ?? '#6366f1';

    $secondary = $user->user_theme_secondary
        ?? $landing->secondary_color
        ?? '#f8fafc';

    $accent = $user->user_theme_accent
        ?? $landing->accent_color
        ?? '#4f46e5';

    $websiteUrl =
        'https://'
        . $user->user_subdomain
        . '.'
        . config('app.domain');
@endphp

@section('content')

@if(session('success'))
<div
    class="
        mb-6
        p-4
        rounded-2xl
        bg-green-50
        border
        border-green-200
        text-green-700
    ">
    {{ session('success') }}
</div>
@endif

@if ($errors->any())
<div
    class="
        mb-6
        p-4
        rounded-2xl
        bg-red-50
        border
        border-red-200
        text-red-700
    ">

    <ul class="space-y-1">
        @foreach ($errors->all() as $error)
            <li>
                • {{ $error }}
            </li>
        @endforeach
    </ul>

</div>
@endif

<div
    class="
        grid
        grid-cols-1
        lg:grid-cols-3
        gap-6
    ">

    <div class="lg:col-span-2">

        <form
            method="POST"
            action="{{ route('client.setting.update') }}"
            enctype="multipart/form-data"
            class="
                bg-white/80
                backdrop-blur-xl
                border
                rounded-3xl
                shadow
                p-6
                space-y-6
            ">

            @csrf
            @method('PUT')

            <div>
                <h2 class="text-xl font-bold">
                    Identitas Website
                </h2>

                <p class="text-sm text-gray-500">
                    Data ini akan tampil di website publik affiliate kamu.
                </p>
            </div>

            <div>

                <label
                    class="
                        text-sm
                        font-medium
                        text-gray-600
                    ">
                    Nama Website
                </label>

                <input
                    type="text"
                    name="user_brand_name"
                    value="{{ old('user_brand_name', $user->user_brand_name) }}"
                    class="
                        w-full
                        mt-2
                        p-3
                        rounded-2xl
                        border
                    "
                    required>

            </div>

            <div>

                <label
                    class="
                        text-sm
                        font-medium
                        text-gray-600
                    ">
                    Link Website
                </label>

                <div class="flex mt-2">

                    <input
                        type="text"
                        name="user_subdomain"
                        value="{{ old('user_subdomain', $user->user_subdomain) }}"
                        class="
                            flex-1
                            p-3
                            rounded-l-2xl
                            border
                        "
                        placeholder="nama-toko"
                        required>

                    <span
                        class="
                            px-4
                            py-3
                            bg-gray-100
                            border
                            border-l-0
                            rounded-r-2xl
                            text-sm
                            text-gray-500
                        ">
                        .{{ config('app.domain') }}
                    </span>

                </div>

                <p class="text-xs text-gray-400 mt-2">
                    Contoh:
                    demo-store.{{ config('app.domain') }}
                </p>

            </div>

            <div>

                <label
                    class="
                        text-sm
                        font-medium
                        text-gray-600
                    ">
                    Tagline
                </label>

                <input
                    type="text"
                    name="user_tagline"
                    value="{{ old('user_tagline', $user->user_tagline) }}"
                    class="
                        w-full
                        mt-2
                        p-3
                        rounded-2xl
                        border
                    "
                    placeholder="Rekomendasi Produk Pilihan">

            </div>

            <div>

                <label
                    class="
                        text-sm
                        font-medium
                        text-gray-600
                    ">
                    Deskripsi Website
                </label>

                <textarea
                    name="user_description"
                    rows="4"
                    class="
                        w-full
                        mt-2
                        p-3
                        rounded-2xl
                        border
                    "
                    placeholder="Tulis deskripsi singkat website kamu...">{{ old('user_description', $user->user_description) }}</textarea>

            </div>

            <div
                class="
                    grid
                    md:grid-cols-2
                    gap-6
                ">
                                <div>

                    <label
                        class="
                            text-sm
                            font-medium
                            text-gray-600
                        ">
                        Logo Website
                    </label>

                    <input
                        type="file"
                        name="user_logo"
                        class="
                            w-full
                            mt-2
                            p-3
                            rounded-2xl
                            border
                            bg-white
                        ">

                    @if ($user->user_logo)
                        <img
                            src="{{ asset($user->user_logo) }}"
                            class="
                                w-20
                                h-20
                                rounded-2xl
                                object-cover
                                mt-4
                                border
                            ">
                    @endif

                </div>

                <div>

                    <label
                        class="
                            text-sm
                            font-medium
                            text-gray-600
                        ">
                        Favicon
                    </label>

                    <input
                        type="file"
                        name="user_favicon"
                        class="
                            w-full
                            mt-2
                            p-3
                            rounded-2xl
                            border
                            bg-white
                        ">

                    @if ($user->user_favicon)
                        <img
                            src="{{ asset($user->user_favicon) }}"
                            class="
                                w-12
                                h-12
                                rounded-xl
                                object-cover
                                mt-4
                                border
                            ">
                    @endif

                </div>

            </div>

            <div class="border-t pt-6">

                <h2 class="text-xl font-bold">
                    Kontak & Sosial Media
                </h2>

                <p class="text-sm text-gray-500">
                    Informasi ini dapat ditampilkan di footer website kamu.
                </p>

            </div>

            <div>

                <label
                    class="
                        text-sm
                        font-medium
                        text-gray-600
                    ">
                    WhatsApp
                </label>

                <input
                    type="text"
                    name="user_whatsapp"
                    value="{{ old('user_whatsapp', $user->user_whatsapp) }}"
                    placeholder="6281234567890"
                    class="
                        w-full
                        mt-2
                        p-3
                        rounded-2xl
                        border
                    ">

            </div>

            <div
                class="
                    grid
                    md:grid-cols-2
                    gap-6
                ">

                <div>

                    <label
                        class="
                            text-sm
                            font-medium
                            text-gray-600
                        ">
                        Instagram
                    </label>

                    <input
                        type="text"
                        name="user_instagram"
                        value="{{ old('user_instagram', $user->user_instagram) }}"
                        placeholder="https://instagram.com/username"
                        class="
                            w-full
                            mt-2
                            p-3
                            rounded-2xl
                            border
                        ">

                </div>

                <div>

                    <label
                        class="
                            text-sm
                            font-medium
                            text-gray-600
                        ">
                        TikTok
                    </label>

                    <input
                        type="text"
                        name="user_tiktok"
                        value="{{ old('user_tiktok', $user->user_tiktok) }}"
                        placeholder="https://tiktok.com/@username"
                        class="
                            w-full
                            mt-2
                            p-3
                            rounded-2xl
                            border
                        ">

                </div>

            </div>

            <div class="border-t pt-6">

                <h2 class="text-xl font-bold">
                    Warna Website
                </h2>

                <p class="text-sm text-gray-500">
                    Warna ini akan langsung mengubah tampilan website publik.
                </p>

            </div>

            <div
                class="
                    grid
                    md:grid-cols-3
                    gap-6
                ">

                <div>

                    <label
                        class="
                            text-sm
                            font-medium
                            text-gray-600
                        ">
                        Warna Utama
                    </label>

                    <input
                        type="color"
                        name="user_theme_primary"
                        value="{{ old('user_theme_primary', $user->user_theme_primary ?? $primary) }}"
                        class="
                            w-full
                            h-12
                            rounded-2xl
                            border
                            bg-white
                            mt-2
                        ">

                </div>

                <div>

                    <label
                        class="
                            text-sm
                            font-medium
                            text-gray-600
                        ">
                        Background
                    </label>

                    <input
                        type="color"
                        name="user_theme_secondary"
                        value="{{ old('user_theme_secondary', $user->user_theme_secondary ?? $secondary) }}"
                        class="
                            w-full
                            h-12
                            rounded-2xl
                            border
                            bg-white
                            mt-2
                        ">

                </div>

                <div>

                    <label
                        class="
                            text-sm
                            font-medium
                            text-gray-600
                        ">
                        Accent
                    </label>

                    <input
                        type="color"
                        name="user_theme_accent"
                        value="{{ old('user_theme_accent', $user->user_theme_accent ?? $accent) }}"
                        class="
                            w-full
                            h-12
                            rounded-2xl
                            border
                            bg-white
                            mt-2
                        ">

                </div>

            </div>
            <div class="border-t pt-6">

    <h2 class="text-xl font-bold">
        SEO Website
    </h2>

    <p class="text-sm text-gray-500">
        Pengaturan ini digunakan untuk Google dan media sosial.
    </p>

</div>

<div>

    <label
        class="
            text-sm
            font-medium
            text-gray-600
        ">
        Meta Title
    </label>

    <input
        type="text"
        name="user_meta_title"
        value="{{ old('user_meta_title', $user->user_meta_title) }}"
        class="
            w-full
            mt-2
            p-3
            rounded-2xl
            border
        ">

</div>

<div>

    <label
        class="
            text-sm
            font-medium
            text-gray-600
        ">
        Meta Description
    </label>

    <textarea
        name="user_meta_description"
        rows="4"
        class="
            w-full
            mt-2
            p-3
            rounded-2xl
            border
        ">{{ old('user_meta_description', $user->user_meta_description) }}</textarea>

</div>

<div>

    <label
        class="
            text-sm
            font-medium
            text-gray-600
        ">
        Footer Text
    </label>

    <input
        type="text"
        name="user_footer_text"
        value="{{ old('user_footer_text', $user->user_footer_text) }}"
        class="
            w-full
            mt-2
            p-3
            rounded-2xl
            border
        ">

</div>

<div class="pt-4">

    <button
        class="
            w-full
            py-4
            rounded-2xl
            text-white
            font-semibold
            shadow-lg
        "
        style="
            background:
            {{ $primary }};
        ">

        Simpan Setting Website

    </button>

</div>

</form>

</div>

<div>

    <div
        class="
            bg-white
            rounded-3xl
            shadow
            p-6
            sticky
            top-6
        ">

        <h2
            class="
                text-xl
                font-bold
                mb-6
            ">
            Preview Website
        </h2>

        @if ($user->user_logo)

            <img
                src="{{ asset($user->user_logo) }}"
                class="
                    w-24
                    h-24
                    rounded-3xl
                    object-cover
                    mx-auto
                    border
                ">

        @else

            <div
                class="
                    w-24
                    h-24
                    rounded-3xl
                    text-white
                    flex
                    items-center
                    justify-center
                    mx-auto
                    text-3xl
                    font-bold
                "
                style="
                    background:
                    {{ $primary }};
                ">

                {{ strtoupper(substr($user->user_brand_name ?? 'A', 0, 1)) }}

            </div>

        @endif

        <h3
            class="
                text-center
                text-xl
                font-bold
                mt-5
            ">

            {{ $user->user_brand_name }}

        </h3>

        <p
            class="
                text-center
                text-gray-500
                mt-2
            ">

            {{ $user->user_tagline ?: 'Belum ada tagline' }}

        </p>

        <div
            class="
                mt-6
                p-4
                rounded-2xl
                bg-slate-50
                border
            ">

            <p
                class="
                    text-xs
                    text-gray-500
                    mb-2
                ">
                Link Website
            </p>

            <div
                class="
                    flex
                    items-center
                    justify-between
                    gap-3
                ">

                <span
                    class="
                        text-sm
                        break-all
                    ">
                    {{ $websiteUrl }}
                </span>

                <button
                    type="button"
                    onclick="copyLink()"
                    class="
                        px-3
                        py-2
                        rounded-xl
                        text-white
                        text-sm
                    "
                    style="
                        background:
                        {{ $primary }};
                    ">

                    Copy

                </button>

            </div>

        </div>

        <a
            href="{{ $websiteUrl }}"
            target="_blank"
            class="
                block
                mt-5
                text-center
                py-3
                rounded-2xl
                text-white
                font-semibold
            "
            style="
                background:
                {{ $accent }};
            ">

            Buka Website

        </a>

    </div>

</div>

</div>

<script>
function copyLink()
{
    navigator.clipboard.writeText(
        "{{ $websiteUrl }}"
    );

    alert('Link berhasil disalin');
}
</script>

@endsection