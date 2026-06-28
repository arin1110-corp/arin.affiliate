<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Setup Website - ARIN</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-slate-100 flex items-center justify-center py-10">

    <div class="bg-white rounded-3xl shadow p-8 max-w-2xl w-full">

        <h1 class="text-2xl font-bold mb-2">Setup Website Affiliate</h1>
        <p class="text-gray-500 mb-6">
            Lengkapi identitas website kamu sebelum masuk dashboard.
        </p>

        <form method="POST" action="{{ route('client.setup.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="text-sm text-gray-600">Nama Website</label>
                <input type="text" name="user_brand_name" value="{{ $user->user_brand_name }}"
                    class="w-full p-3 border rounded-xl" required>
            </div>
            <div>
                <label class="text-sm text-gray-600">Link Website</label>
                <div class="flex mt-1">
                    <input type="text" name="user_subdomain"
                        value="{{ old('user_subdomain', $user->user_subdomain) }}"
                        class="flex-1 p-3 border border-r-0 rounded-l-xl" placeholder="nama-toko" required>

                    <span class="px-4 py-3 bg-gray-100 border rounded-r-xl text-sm text-gray-500 whitespace-nowrap">
                        .{{ config('app.domain') }}
                    </span>
                </div>

                <p class="text-xs text-gray-400 mt-1">
                    Contoh: demo-store → {{ url('/demo-store') }}
                </p>
            </div>

            <div>
                <label class="text-sm text-gray-600">Tagline</label>
                <input type="text" name="user_tagline" value="{{ $user->user_tagline }}"
                    class="w-full p-3 border rounded-xl" placeholder="Temukan rekomendasi produk terbaik">
            </div>

            <div>
                <label class="text-sm text-gray-600">Deskripsi</label>
                <textarea name="user_description" rows="3" class="w-full p-3 border rounded-xl">{{ $user->user_description }}</textarea>
            </div>

            <div>
                <label class="text-sm text-gray-600">Logo</label>
                <input type="file" name="user_logo" class="w-full p-3 border rounded-xl bg-white">
            </div>

            <div>
                <label class="text-sm text-gray-600">WhatsApp</label>
                <input type="text" name="user_whatsapp" value="{{ $user->user_whatsapp }}"
                    class="w-full p-3 border rounded-xl" placeholder="6281234567890">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-sm text-gray-600">Instagram</label>
                    <input type="text" name="user_instagram" value="{{ $user->user_instagram }}"
                        class="w-full p-3 border rounded-xl">
                </div>

                <div>
                    <label class="text-sm text-gray-600">TikTok</label>
                    <input type="text" name="user_tiktok" value="{{ $user->user_tiktok }}"
                        class="w-full p-3 border rounded-xl">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-sm text-gray-600">Warna Utama</label>
                    <input type="color" name="user_theme_primary"
                        value="{{ $user->user_theme_primary ?? '#ec4899' }}" class="w-full h-12 border rounded-xl">
                </div>

                <div>
                    <label class="text-sm text-gray-600">Warna Background</label>
                    <input type="color" name="user_theme_secondary"
                        value="{{ $user->user_theme_secondary ?? '#fdf2f8' }}" class="w-full h-12 border rounded-xl">
                </div>
            </div>

            <div class="bg-pink-50 border border-pink-100 rounded-2xl p-4 text-pink-700 text-sm">
                Link website kamu:
                <br>
                <b>{{ url('/' . $user->user_slug) }}</b>
            </div>

            <button class="w-full bg-pink-600 text-white py-3 rounded-2xl font-semibold">
                Simpan & Masuk Dashboard
            </button>

        </form>
    </div>

</body>

</html>
