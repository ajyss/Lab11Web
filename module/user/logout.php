<?php
// WAJIB: Memulai sesi agar session_destroy bekerja
session_start();

// Hapus semua variabel sesi
$_SESSION = array();

// Hancurkan sesi
session_destroy();

// Redirect ke halaman login
header('Location: /lab11_full/user/login');
exit;
?>