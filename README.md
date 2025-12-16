# README Praktikum 12: Autentikasi dan Session

## Identitas Mahasiswa
* **Nama**: Muhammad Aziz Tri Ramadhan

* **NIM**: 312410380

* **Kelas**: TI24A3

* **Dosen**: Agung Nugroho, S.Kom., M.Kom

---

## 1. Deskripsi
Praktikum 12 menambahkan fitur autentikasi dan session management pada sistem CRUD artikel dari Praktikum 11. Fitur utama meliputi login/logout, proteksi halaman, dan manajemen profil user.

---

## 2. Struktur Direktori
```
lab11_php_oop/
│ index.php
│ config.php
│ .htaccess (opsional)
│
├─ class/
│  ├─ Database.php
│  └─ Form.php
│
├─ module/
│  ├─ home/
│  │  └─ index.php
│  ├─ artikel/
│  │  ├─ index.php
│  │  ├─ tambah.php
│  │  ├─ ubah.php
│  │  └─ hapus.php
│  └─ user/
│     ├─ login.php
│     ├─ logout.php
│     └─ profile.php
│
├─ template/
│  ├─ header.php
│  └─ footer.php
│
└─ screenshots/
   ├─ home.png
   ├─ login.png
   ├─ artikel_index.png
   ├─ tambah.png
   ├─ ubah.png
   ├─ hapus.png
   └─ profile.png
```

---

## 3. Database Config
```php
$config = [
  'host' => 'localhost',
  'username' => 'root',
  'password' => '',
  'db_name' => 'latihan_oop'
];
```

---

## 4. Class Database.php
```php
class Database {
    public function getAll($table) { /* return array */ }
    public function getById($table, $id_key, $id_value) { /* return 1 record */ }
    public function escape($value) { /* SQL Injection prevention */ }
    public function query($sql) { /* execute */ }
}
```

---

## 5. Class Form.php
```php
$form->addField("judul", "Judul", "text", "");
$form->addField("konten", "Konten", "textarea", "");
$form->render();
```

---

## 6. Front Controller (index.php)
```php
$path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/home/index';
$segments = explode('/', trim($path, '/'));
$mod = $segments[0] ?? 'home';
$page = $segments[1] ?? 'index';
$file = "module/{$mod}/{$page}.php";

include "template/header.php";
if (file_exists($file)) include $file;
include "template/footer.php";
```

---

## 7. Autentikasi dan Session

### Session Management
```php
session_start(); // Di awal index.php

// Set session saat login
$_SESSION['is_login'] = true;
$_SESSION['username'] = $data['username'];
$_SESSION['nama'] = $data['nama'];

// Cek session
if (!isset($_SESSION['is_login'])) {
    header('Location: user/login');
}

// Logout
session_destroy();
```

### Proteksi Halaman
```php
$public_pages = ['home', 'user'];
if (!in_array($mod, $public_pages)) {
    if (!isset($_SESSION['is_login'])) {
        header('Location: user/login');
        exit();
    }
}
```

### Login System
**login.php**
```php
if ($_POST) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE username = '{$username}' LIMIT 1";
    $result = $db->query($sql);
    $data = $result->fetch_assoc();
    if ($data && password_verify($password, $data['password'])) {
        $_SESSION['is_login'] = true;
        $_SESSION['username'] = $data['username'];
        $_SESSION['nama'] = $data['nama'];
        header('Location: ../artikel/index');
    }
}
```
**📸Login**  
![Screenshot - Login](screenshots/login.png)

### Profil User
**profile.php**
```php
// Tampilkan data user
echo $_SESSION['nama'];
echo $_SESSION['username'];

// Ubah password
if ($_POST) {
    $current = $_POST['current_password'];
    $new = $_POST['new_password'];
    // Validasi dan update dengan hash
    $hashed = password_hash($new, PASSWORD_DEFAULT);
    $db->query("UPDATE users SET password = '{$hashed}' WHERE username = '{$_SESSION['username']}'");
}
```
**📸Profil**  
![Screenshot - Profile](screenshots/profile.png)

---

## 8. SQL Setup
```sql
CREATE DATABASE latihan_oop;

-- Tabel artikel (dari Praktikum 11)
CREATE TABLE artikel (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    konten TEXT NOT NULL
);

-- Tabel users (untuk autentikasi)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    nama VARCHAR(100) NOT NULL
);

-- Insert user admin
INSERT INTO users (username, password, nama) 
VALUES ('admin', '$2y$10$hnxCnJbsizidVgmfN0CH2.wOBZSN.LOWsChado19ipDfN0E0TGqUq', 'Administrator');
-- Password: admin123 (hashed)
```
CREATE TABLE artikel (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    konten TEXT NOT NULL
);
INSERT INTO artikel VALUES (1, 'Artikel 1', 'Konten 1');
```

---



