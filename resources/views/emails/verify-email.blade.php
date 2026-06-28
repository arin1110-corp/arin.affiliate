<h2>Verifikasi Email Affilio</h2>

<p>Halo {{ $user->user_nama }},</p>

<p>Klik tombol di bawah untuk memverifikasi email kamu.</p>

<p>
    <a href="{{ route('client.verify.email', $user->user_email_verify_token) }}">
        Verifikasi Email
    </a>
</p>

<p>Link ini hanya digunakan sekali.</p>