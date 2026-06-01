<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi Email - ARIN</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-100 flex items-center justify-center">

<div class="bg-white rounded-3xl shadow p-8 max-w-md w-full text-center">
    <h1 class="text-2xl font-bold mb-3">Verifikasi Email</h1>

    <p class="text-gray-500 mb-6">
        Kami akan mengirimkan link verifikasi ke:
        <br>
        <b>{{ $user->user_email }}</b>
    </p>

    <p class="text-sm text-gray-400 mb-6">
        Untuk sementara mode development, klik tombol di bawah untuk verifikasi manual.
    </p>

    <form method="POST" action="{{ route('client.verify.manual') }}">
        @csrf
        <button class="bg-pink-600 text-white px-6 py-3 rounded-2xl">
            Verifikasi Email
        </button>
    </form>
</div>

</body>
</html>