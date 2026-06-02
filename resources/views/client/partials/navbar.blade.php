@php
    $user = auth('arin')->user();
@endphp

<header class="bg-white/80 backdrop-blur-xl border-b theme-border px-6 py-4 flex items-center justify-between">

    <div>
        <h2 class="text-xl font-bold text-gray-800">
            @yield('page_title', 'Dashboard')
        </h2>

        <p class="text-xs text-gray-500 mt-1">
            {{ $user->user_brand_name ?? 'ARIN Store' }} Panel
        </p>
    </div>

    <div class="flex items-center gap-4">

        <a href="{{ url('/'.$user->user_slug) }}"
           target="_blank"
           class="hidden md:inline-block px-4 py-2 rounded-xl text-sm theme-soft theme-text">
            Lihat Website
        </a>

        <div class="text-right">
            <p class="text-sm font-medium">
                {{ $user->user_nama }}
            </p>

            <p class="text-xs text-gray-400">
                {{ ucfirst($user->user_package) }}
            </p>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button class="px-4 py-2 text-white rounded-xl text-sm theme-button">
                Logout
            </button>
        </form>

    </div>

</header>