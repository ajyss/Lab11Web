<!DOCTYPE html>
<html>
<head>
<title>Praktikum 12 - Autentikasi dan Session</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<style>
body { background-color: #f5f5f5; }
.navbar-brand { font-weight: bold; font-size: 1.5em; }
.btn { margin: 5px; }
table { background-color: white; }
.container { background-color: white; padding: 20px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
</style>
</head>
<body>
<nav class='navbar navbar-expand-lg navbar-dark bg-dark p-3'>
  <div class='container-fluid'>
    <a class='navbar-brand' href='/lab11_full/home/index'>📰 Manajemen Artikel</a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="/lab11_full/home/index">Home</a></li>
        <?php if (isset($_SESSION['is_login'])): ?>
          <li class="nav-item"><a class="nav-link" href="/lab11_full/artikel/index">Data Artikel</a></li>
        <?php endif; ?>
      </ul>

      <ul class="navbar-nav ms-auto">
        <?php if (isset($_SESSION['is_login'])): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-warning" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Halo, <?= htmlspecialchars($_SESSION['nama'] ?? 'User') ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="/lab11_full/user/profile">👤 Profil</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item text-danger" href="/lab11_full/user/logout">🚪 Logout</a></li>
            </ul>
          </li>
          
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link btn btn-outline-light" href="/lab11_full/user/login">🔑 Login</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>