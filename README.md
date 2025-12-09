# ðŸ“˜ README â€“ Praktikum 11: Front Controller & Modular Architecture

## ðŸ‘¤ Identitas Mahasiswa
* **Nama**: ......................................................
* **NIM**: ......................................................
* **Kelas**: ......................................................
* **Dosen**: Agung Nugroho, S.Kom., M.Kom

---

## ðŸ”¥ 1. Deskripsi
Praktikum 11 mengembangkan Praktikum 10 dengan Front Controller Pattern, Modular Architecture, dan URL Routing.

---

## ðŸ“‚ 2. Struktur Direktori
```
lab11_full/
â”œâ”€ config.php          (Database Config)
â”œâ”€ index.php           (Front Controller)
â”œâ”€ .htaccess           (URL Rewriting)
â”œâ”€ class/
â”‚   â”œ Database.php     (CRUD)
â”‚   â”” Form.php         (Form Builder)
â”œâ”€ module/
â”‚   â”œâ”€ home/index.php
â”‚   â””â”€ artikel/        (index, tambah, ubah, hapus)
â””â”€ template/
   â”œ header.php
   â”” footer.php
```

---

## âš™ï¸ 3. Database Config
```php
$config = [
  'host' => 'localhost',
  'username' => 'root',
  'password' => '',
  'db_name' => 'latihan_oop'
];
```

---

## ðŸ”§ 4. Class Database.php
```php
class Database {
    public function getAll($table) { /* return array */ }
    public function getById($table, $id_key, $id_value) { /* return 1 record */ }
    public function escape($value) { /* SQL Injection prevention */ }
    public function query($sql) { /* execute */ }
}
```

---

## ðŸ“‹ 5. Class Form.php
```php
$form->addField("judul", "Judul", "text", "");
$form->addField("konten", "Konten", "textarea", "");
$form->render();
```

---

## ðŸŽ¯ 6. Front Controller (index.php)
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

## ðŸ“° 7. CRUD Artikel

**index.php** - List
```php
$db = new Database();
$data = $db->getAll('artikel');
// Tampilkan dalam tabel
```

**tambah.php** - Add
```php
if(isset($_POST['submit'])){
    $sql = "INSERT INTO artikel (judul,konten) VALUES (...)";
    $db->query($sql);
    header("Location: /lab11_full/artikel/index");
}
```

**ubah.php** - Edit
```php
$artikel = $db->getById('artikel', 'id', $_GET['id']);
// Update via POST
```

**hapus.php** - Delete
```php
$db->query("DELETE FROM artikel WHERE id='$_GET[id]'");
header("Location: /lab11_full/artikel/index");
```

---

## ðŸ—„ï¸ 8. SQL Setup
```sql
CREATE DATABASE latihan_oop;
CREATE TABLE artikel (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    konten TEXT NOT NULL
);
INSERT INTO artikel VALUES (1, 'Artikel 1', 'Konten 1');
```

---

## ðŸŽ¨ 9. Template
**header.php** - Bootstrap navbar & CSS
ðŸ“¸ *(screenshot)*

**footer.php** - Copyright footer
ðŸ“¸ *(screenshot)*

---

## ðŸš€ 10. Cara Jalankan
1. XAMPP running
2. Import SQL database
3. Buka `http://localhost/lab11_full/`
4. Test CRUD


## 📸 Screenshots
Letakkan hasil screenshot Anda di folder `screenshots/` (buat folder di root project) dan beri nama file sesuai petunjuk di bawah agar gambar tampil otomatis di README. Contoh: `screenshots/index.png`.

- **Index (Daftar Artikel)**  
    ![Screenshot - Index](screenshots/index.png)
    *Saran nama file:* `screenshots/index.png`

- **Tambah (Form Tambah Artikel)**  
    ![Screenshot - Tambah](screenshots/tambah.png)
    *Saran nama file:* `screenshots/tambah.png`

- **Ubah (Form Ubah Artikel)**  
    ![Screenshot - Ubah](screenshots/ubah.png)
    *Saran nama file:* `screenshots/ubah.png`

- **Hapus (Konfirmasi / Setelah Hapus)**  
    ![Screenshot - Hapus](screenshots/hapus.png)
    *Saran nama file:* `screenshots/hapus.png`

Catatan: Gunakan path relatif `screenshots/<nama>.png` agar gambar tampil saat README dibuka di GitHub atau browser lokal.

---

## âœ¨ 11. Fitur Utama
âœ… Front Controller Pattern
âœ… Modular Architecture
âœ… CRUD dengan OOP Class
âœ… Clean URL Routing
âœ… Security (SQL Injection prevention)

---
