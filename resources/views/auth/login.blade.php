<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login ARIN</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-pink-900 flex items-center justify-center">

    <div class="w-full max-w-md px-6">

        <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl p-8">

            <div class="text-center mb-8">
                <div class="w-16 h-16 mx-auto rounded-2xl bg-pink-600 text-white flex items-center justify-center text-2xl font-bold">
                    A
                </div>

                <h1 class="text-2xl font-bold mt-4">
                    ARIN Affiliate
                </h1>

                <p class="text-sm text-gray-500">
                    Admin & Client Login
                </p>
            </div>

            @if(session('error'))
                <div class="mb-4 bg-red-50 border border-red-200 text-red-600 p-3 rounded-xl text-sm">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('authenticate') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="text-sm text-gray-600">Email</label>
                    <input type="email"
                           name="email"
                           class="w-full mt-1 px-4 py-3 rounded-2xl border border-gray-200 focus:ring-2 focus:ring-pink-300 outline-none"
                           placeholder="admin@arinaffiliate.com"
                           required>
                </div>

                <div>
                    <label class="text-sm text-gray-600">Password</label>
                    <input type="password"
                           name="password"
                           class="w-full mt-1 px-4 py-3 rounded-2xl border border-gray-200 focus:ring-2 focus:ring-pink-300 outline-none"
                           placeholder="••••••••"
                           required>
                </div>

                <button class="w-full bg-pink-600 text-white py-3 rounded-2xl font-semibold hover:bg-pink-700 transition">
                    Login
                </button>
            </form>

        </div>

        <p class="text-center text-xs text-white/60 mt-6">
            © {{ date('Y') }} ARIN Affiliate
        </p>

    </div>

</body>
</html>