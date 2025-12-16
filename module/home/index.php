<div class='container mt-5'>
<h1>Selamat Datang di Sistem Manajemen Artikel</h1>
<p class='lead'>Praktikum 12 - Autentikasi dan Session</p>
<p>Pilih menu navigasi di atas untuk mengelola artikel.</p>
<hr>
<div class='alert alert-info'>
<strong>Fitur Aplikasi:</strong>
<ul>
<li>✓ Autentikasi Login/Logout</li>
<li>✓ Manajemen Profil User</li>
<li>✓ Menampilkan daftar artikel</li>
<li>✓ Menambah artikel baru</li>
<li>✓ Mengubah artikel</li>
<li>✓ Menghapus artikel</li>
</ul>
</div>
<?php if (isset($_SESSION['is_login'])): ?>
<a href='/lab11_full/artikel/index' class='btn btn-primary btn-lg'>Kelola Artikel</a>
<?php else: ?>
<a href='/lab11_full/user/login' class='btn btn-primary btn-lg'>Kelola Artikel</a>
<?php endif; ?>
</div>
