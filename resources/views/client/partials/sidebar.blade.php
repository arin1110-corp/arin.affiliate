<aside class="fixed left-0 top-0 w-72 h-screen bg-white border-r hidden md:block">

    <div class="p-6 border-b">
        <h1 class="text-2xl font-bold text-pink-600">
            ARIN
        </h1>
        <p class="text-xs text-gray-500">
            {{ auth('arin')->user()->user_brand_name ?? 'Client Panel' }}
        </p>
    </div>

    <nav class="p-4 space-y-2 text-sm">

        <a href="{{ route('client.dashboard') }}"
           class="block px-4 py-3 rounded-2xl {{ request()->routeIs('client.dashboard') ? 'bg-pink-600 text-white' : 'hover:bg-pink-50' }}">
            Dashboard
        </a>

        <a href="{{ route('client.kategori.index') }}"
           class="block px-4 py-3 rounded-2xl {{ request()->routeIs('client.kategori.*') ? 'bg-pink-600 text-white' : 'hover:bg-pink-50' }}">
            Kategori
        </a>

        <a href="#"
           class="block px-4 py-3 rounded-2xl hover:bg-pink-50">
            Produk
        </a>

        <a href="#"
           class="block px-4 py-3 rounded-2xl hover:bg-pink-50">
            Slider
        </a>

        <a href="#"
           class="block px-4 py-3 rounded-2xl hover:bg-pink-50">
            Setting Website
        </a>

    </nav>

</aside>