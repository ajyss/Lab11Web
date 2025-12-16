<?php
// ----------------------------------------------------
// PENGECEKAN SESI (WAJIB UNTUK HALAMAN TERLINDUNGI)
// Cek ini sudah di-handle oleh router (index.php) Anda, tapi dipertahankan untuk redundansi
// ----------------------------------------------------
if (!isset($_SESSION['is_login'])) {
    header("Location: /lab11_full/user/login");
    exit;
}
// ----------------------------------------------------

// Inisialisasi Class hanya dilakukan SATU KALI
$db = new Database();
$form = new Form("", "Simpan");

// Logika hanya berjalan jika tombol 'submit' ditekan
if(isset($_POST['submit'])){
    
    $data = [
        // Pastikan Anda juga menyimpan user_id yang sedang login sebagai foreign key
        // Jika tabel artikel Anda memiliki kolom 'user_id' atau 'penulis_id'
        // 'user_id' => $_SESSION['user_id'] ?? 1, // Contoh: Ambil dari sesi

        'judul' => $db->escape($_POST['judul']),
        'konten' => $db->escape($_POST['konten'])
    ];
    
    // Logika INSERT
    $columns = implode(",", array_keys($data));
    $values = "'" . implode("','", array_values($data)) . "'";
    $sql = "INSERT INTO artikel ($columns) VALUES ($values)";
    
    if($db->query($sql)){
        header("Location: /lab11_full/artikel/index");
        exit; // Penting: Tambahkan exit setelah header redirect
    }
}
?>

<div class='container mt-4'>
    <h2>Tambah Artikel</h2>
    <?php
    $form->addField("judul","Judul","text","");
    $form->addField("konten","Konten","textarea","");
    $form->render();
    ?>
</div>