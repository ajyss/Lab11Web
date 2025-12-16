<?php
// Session check sudah dilakukan di index.php, tapi boleh dipertahankan
if (!isset($_SESSION['is_login'])) {
    header('Location: /lab11_full/user/login');
    exit;
}

$db = new Database();
$message = "";
$user_id = $_SESSION['user_id'] ?? null; 

// Ambil data user saat ini
$current_user_data = $db->getById('users', 'id', $user_id);

if (!$user_id || !$current_user_data) {
    $message = "<div class='alert alert-danger'>Data user tidak ditemukan. Silakan login ulang.</div>";
}

// Logika Proses Ubah Password
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validasi
    if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
        $message = "Semua field harus diisi!";
    } elseif ($new_password !== $confirm_password) {
        $message = "Password baru dan konfirmasi tidak cocok!";
    } elseif (strlen($new_password) < 6) {
        $message = "Password baru minimal 6 karakter!";
    } 
    // Verifikasi password lama menggunakan hash
    elseif (!password_verify($current_password, $current_user_data['password'])) {
        $message = "Password lama salah!";
    } else {
        // Hash password baru (Sesuai Praktikum 12)
        $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update password di database menggunakan method updateUser
        $update_data = ['password' => $hashed_new_password];
        if ($db->updateUser($user_id, $update_data)) {
            $message = "<div class='alert alert-success'>Password berhasil diubah!</div>";
        } else {
            $message = "<div class='alert alert-danger'>Gagal mengubah password!</div>";
        }
    }
}
?>

<div class="container mt-4">
    <h2>Profil User</h2>
    <?php if ($message): ?>
        <div class="alert alert-info"><?= $message ?></div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-6">
            <h4>Data User</h4>
            <table class="table table-bordered">
                <tr>
                    <th>Nama</th>
                    <td><?= htmlspecialchars($_SESSION['nama'] ?? 'N/A') ?></td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td><?= htmlspecialchars($_SESSION['username'] ?? 'N/A') ?></td>
                </tr>
                <tr>
                    <th>ID User</th>
                    <td><?= htmlspecialchars($_SESSION['user_id'] ?? 'N/A') ?></td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            <h4>Ubah Password</h4>
            <form method="POST" action="">
                <div class="mb-3">
                    <label>Password Lama</label>
                    <input type="password" name="current_password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Password Baru</label>
                    <input type="password" name="new_password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Konfirmasi Password Baru</label>
                    <input type="password" name="confirm_password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Ubah Password</button>
            </form>
        </div>
    </div>
</div>