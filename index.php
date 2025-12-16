<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "config.php";
include "class/Database.php";
include "class/Form.php";
session_start();

$path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/home/index';
$segments = explode('/', trim($path,'/'));
$mod = $segments[0] ?? 'home';
$page = $segments[1] ?? 'index';

// Cek Session Login
// Halaman yang boleh diakses tanpa login: home, dan modul user (login)
$public_pages = ['home', 'user'];
if (!in_array($mod, $public_pages)) {
    // Jika tidak ada session is_login, lempar ke halaman login
    if (!isset($_SESSION['is_login'])) {
        header('Location: /lab11_php_oop/user/login');
        exit();
    }
}

$file = "module/{$mod}/{$page}.php";

if(file_exists($file)){
    // Jangan load header/footer jika sedang di halaman login (opsional, agar tampilan bersih)
    if ($mod == 'user' && $page == 'login') {
        include $file;
    } else {
        include "template/header.php";
        include $file;
        include "template/footer.php";
    }
} else {
    echo "<div class='alert alert-danger'>Modul tidak ditemukan: {$mod}/{$page}</div>";
}
?>