<?php
// Cek jika belum login, redirect ke login
if (!isset($_SESSION['is_login'])) {
    header('Location: /lab11_php_oop/user/login');
    exit;
}

$db = new Database();
$message = "";

// Jika form submit untuk ubah password
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
    } else {
        // Ambil data user dari database
        $username = $db->escape($_SESSION['username']);
        $sql = "SELECT password FROM users WHERE username = '{$username}' LIMIT 1";
        $result = $db->query($sql);
        if ($result) {
            $user = $result->fetch_assoc();
        } else {
            $user = null;
        }

        // Verifikasi password lama
        if (!$user || !password_verify($current_password, $user['password'])) {
            $message = "Password lama salah!";
        } else {
            // Hash password baru
            $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Update password di database
            $update_sql = "UPDATE users SET password = '{$hashed_new_password}' WHERE username = '{$username}'";
            if ($db->query($update_sql)) {
                $message = "Password berhasil diubah!";
            } else {
                $message = "Gagal mengubah password!";
            }
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
                    <td><?= $_SESSION['nama'] ?></td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td><?= $_SESSION['username'] ?></td>
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