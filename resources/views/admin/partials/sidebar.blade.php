<aside class="fixed left-0 top-0 w-72 h-screen bg-slate-900 text-white hidden md:block">

    <div class="p-6 border-b border-slate-800">
        <h1 class="text-2xl font-bold">
            ARIN
        </h1>

        <p class="text-xs text-slate-400">
            Affiliate SaaS
        </p>
    </div>

    <nav class="p-4 space-y-2 text-sm">

        <a href="{{ route('admin.dashboard') }}"
            class="block px-4 py-3 rounded-2xl {{ request()->routeIs('admin.dashboard') ? 'bg-slate-800' : 'hover:bg-slate-800' }}">
            Dashboard
        </a>

        <a href="{{ route('admin.client.index') }}"
            class="block px-4 py-3 rounded-2xl {{ request()->routeIs('admin.client.*') ? 'bg-slate-800' : 'hover:bg-slate-800' }}">
            Client
        </a>

        <a href="#"
            class="block px-4 py-3 rounded-2xl {{ request()->routeIs('admin.package.*') ? 'bg-slate-800' : 'hover:bg-slate-800' }}">
            Package
        </a>

        <a href="{{ route('admin.payment.index') }}"
            class="block px-4 py-3 rounded-2xl
           {{ request()->routeIs('admin.payment.index') || request()->routeIs('admin.payment.show') || request()->routeIs('admin.payment.approve') || request()->routeIs('admin.payment.reject') ? 'bg-slate-800' : 'hover:bg-slate-800' }}">
            Pembayaran
        </a>

        <a href="{{ route('admin.landing.setting') }}"
            class="block px-4 py-3 rounded-2xl
           {{ request()->routeIs('admin.landing.*') ? 'bg-slate-800' : 'hover:bg-slate-800' }}">
            Landing Page
        </a>

        <a href="#"
            class="block px-4 py-3 rounded-2xl {{ request()->routeIs('admin.setting.*') ? 'bg-slate-800' : 'hover:bg-slate-800' }}">
            Setting
        </a>

    </nav>

</aside>
