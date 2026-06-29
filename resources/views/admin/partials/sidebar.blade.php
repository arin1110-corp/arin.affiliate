<aside class="fixed left-0 top-0 w-72 h-screen bg-slate-900 text-white hidden md:block">

    <div class="p-6 border-b border-slate-800">
        <div class="flex items-center gap-3">

            @if ($appSetting && $appSetting->app_logo)
                <img
                    src="{{ asset($appSetting->app_logo) }}"
                    class="w-11 h-11 rounded-xl object-cover bg-white">
            @else
                <div class="w-11 h-11 rounded-xl bg-pink-500 flex items-center justify-center font-bold">
                    {{ strtoupper(substr($appSetting->app_name ?? 'A', 0, 1)) }}
                </div>
            @endif

            <div>
                <h1 class="text-2xl font-bold leading-tight">
                    {{ $appSetting->app_name ?? 'ARIN' }}
                </h1>

                <p class="text-xs text-slate-400">
                    Affiliate SaaS
                </p>
            </div>

        </div>
    </div>

    <nav class="p-4 space-y-2 text-sm">

        <a
            href="{{ route('admin.dashboard') }}"
            class="block px-4 py-3 rounded-2xl transition
            {{
                request()->routeIs('admin.dashboard')
                    ? 'bg-slate-800 text-white'
                    : 'hover:bg-slate-800 text-slate-300'
            }}">

            Dashboard

        </a>

        <a
            href="{{ route('admin.client.index') }}"
            class="block px-4 py-3 rounded-2xl transition
            {{
                request()->routeIs('admin.client.*')
                    ? 'bg-slate-800 text-white'
                    : 'hover:bg-slate-800 text-slate-300'
            }}">

            Client

        </a>

        <a
            href="{{ route('admin.package.index') }}"
            class="block px-4 py-3 rounded-2xl transition
            {{
                request()->routeIs('admin.package.*')
                    ? 'bg-slate-800 text-white'
                    : 'hover:bg-slate-800 text-slate-300'
            }}">

            Package

        </a>

        <a
            href="{{ route('admin.payment.index') }}"
            class="block px-4 py-3 rounded-2xl transition
            {{
                request()->routeIs('admin.payment.index')
                || request()->routeIs('admin.payment.show')
                    ? 'bg-slate-800 text-white'
                    : 'hover:bg-slate-800 text-slate-300'
            }}">

            Pembayaran

        </a>

        <a
            href="{{ route('admin.payment.setting') }}"
            class="block px-4 py-3 rounded-2xl transition
            {{
                request()->routeIs('admin.payment.setting')
                || request()->routeIs('admin.payment.setting.update')
                    ? 'bg-slate-800 text-white'
                    : 'hover:bg-slate-800 text-slate-300'
            }}">

            Setting Pembayaran

        </a>

        <a
            href="{{ route('admin.landing.setting') }}"
            class="block px-4 py-3 rounded-2xl transition
            {{
                request()->routeIs('admin.landing.*')
                    ? 'bg-slate-800 text-white'
                    : 'hover:bg-slate-800 text-slate-300'
            }}">

            Landing Page

        </a>

        <a
            href="{{ route('admin.setting.index') }}"
            class="block px-4 py-3 rounded-2xl transition
            {{
                request()->routeIs('admin.setting.*')
                    ? 'bg-slate-800 text-white'
                    : 'hover:bg-slate-800 text-slate-300'
            }}">

            Setting Website

        </a>

        <form
            action="{{ route('logout') }}"
            method="POST"
            class="pt-4 mt-4 border-t border-slate-800">

            @csrf

            <button
                class="w-full text-left px-4 py-3 rounded-2xl transition hover:bg-red-500/20 text-red-300">

                Logout

            </button>

        </form>

    </nav>

</aside>