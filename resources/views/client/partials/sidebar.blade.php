@php
    $user = auth('arin')->user();

    $websiteUrl = $user->user_domain
        ? 'https://' . $user->user_domain
        : request()->getScheme() . '://' . $user->user_subdomain . '.' . config('app.domain');
@endphp

<aside
    class="
        fixed
        left-0
        top-0
        w-72
        h-screen
        bg-white/80
        backdrop-blur-xl
        border-r
        theme-border
        hidden
        md:block
    ">

    <div class="p-6 border-b theme-border">

        <div class="flex items-center gap-3">

            @if ($user->user_logo)
                <img src="{{ asset($user->user_logo) }}"
                    class="
                        w-12
                        h-12
                        rounded-2xl
                        object-cover
                    ">
            @else
                <div
                    class="
                        w-12
                        h-12
                        rounded-2xl
                        theme-button
                        flex
                        items-center
                        justify-center
                        font-bold
                    ">
                    {{ strtoupper(substr($user->user_brand_name ?? 'A', 0, 1)) }}
                </div>
            @endif

            <div class="min-w-0">

                <h1
                    class="
                        text-xl
                        font-bold
                        theme-text
                        truncate
                    ">
                    {{ $user->user_brand_name ?? 'ARIN' }}
                </h1>

                <p
                    class="
                        text-xs
                        text-gray-500
                        truncate
                    ">
                    @if ($user->user_domain)
                        {{ $user->user_domain }}
                    @else
                        {{ $user->user_subdomain }}.{{ config('app.domain') }}
                    @endif
                </p>

            </div>

        </div>

    </div>

    <nav class="p-4 space-y-2 text-sm">

        <a href="{{ route('client.dashboard') }}"
            class="
                block
                px-4
                py-3
                rounded-2xl
                {{ request()->routeIs('client.dashboard') ? 'theme-menu-active' : 'theme-menu-hover' }}
            ">
            Dashboard
        </a>

        <a href="{{ route('client.kategori.index') }}"
            class="
                block
                px-4
                py-3
                rounded-2xl
                {{ request()->routeIs('client.kategori.*') ? 'theme-menu-active' : 'theme-menu-hover' }}
            ">
            Kategori
        </a>

        <a href="{{ route('client.product.index') }}"
            class="
                block
                px-4
                py-3
                rounded-2xl
                {{ request()->routeIs('client.product.*') ? 'theme-menu-active' : 'theme-menu-hover' }}
            ">
            Produk
        </a>

        <a href="{{ route('client.slider.index') }}"
            class="
                block
                px-4
                py-3
                rounded-2xl
                {{ request()->routeIs('client.slider.*') ? 'theme-menu-active' : 'theme-menu-hover' }}
            ">
            Slider
        </a>

        <a href="{{ route('client.payment.index') }}"
            class="
                block
                px-4
                py-3
                rounded-2xl
                {{ request()->routeIs('client.payment.*') ? 'theme-menu-active' : 'theme-menu-hover' }}
            ">
            Pembayaran
        </a>

        <a href="{{ route('client.setting.index') }}"
            class="
                block
                px-4
                py-3
                rounded-2xl
                {{ request()->routeIs('client.setting.*') ? 'theme-menu-active' : 'theme-menu-hover' }}
            ">
            Setting Website
        </a>

        <div class="pt-4 mt-4 border-t theme-border">

            <a href="{{ $websiteUrl }}" target="_blank"
                class="
                    block
                    px-4
                    py-3
                    rounded-2xl
                    bg-gray-100
                    text-gray-700
                    hover:bg-gray-200
                    transition
                ">
                🌐 Lihat Website
            </a>

        </div>

    </nav>

</aside>
