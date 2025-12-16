<?php
// Cek jika sudah login, langsung ke halaman artikel (Sesuai Praktikum 12)
if (isset($_SESSION['is_login'])) {
    header('Location: /lab11_full/artikel/index'); 
    exit;
}

$message = "";

// Logika Proses Login
if ($_POST) {
    // $db diakses karena sudah di-include di index.php
    $db = new Database(); 
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Gunakan method baru untuk mendapatkan data user
    $data = $db->getUserByUsername($username);

    // Verifikasi password (aman karena menggunakan password_verify)
    if ($data && password_verify($password, $data['password'])) {
        // Login Sukses: Set Session
        $_SESSION['is_login'] = true;
        $_SESSION['user_id'] = $data['id']; // <-- KRITIS: Menyimpan ID user untuk profile
        $_SESSION['username'] = $data['username'];
        $_SESSION['nama'] = $data['nama'];
        
        // Redirect ke halaman artikel/index
        header('Location: /lab11_full/artikel/index');
        exit;
    } else {
        $message = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h3 class="text-center mb-4">Login User</h3>
        <?php if ($message): ?>
            <div class="alert alert-danger"><?= $message ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>
</body>
</html>