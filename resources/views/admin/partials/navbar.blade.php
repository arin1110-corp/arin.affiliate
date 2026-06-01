<header class="bg-white border-b px-6 py-4 flex items-center justify-between">

    <div>
        <h2 class="text-xl font-bold">
            @yield('page_title', 'Dashboard')
        </h2>
        <p class="text-xs text-gray-500">
            ARIN Affiliate Platform
        </p>
    </div>

    <div class="flex items-center gap-4">

        <div class="text-right">
            <p class="text-sm font-medium">
                {{ auth('arin')->user()->user_nama }}
            </p>
            <p class="text-xs text-gray-400">
                {{ ucfirst(auth('arin')->user()->user_role) }}
            </p>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="bg-red-500 text-white px-4 py-2 rounded-xl text-sm">
                Logout
            </button>
        </form>

    </div>

</header>