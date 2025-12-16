<?php
$db = new Database();
$data = $db->getAll('artikel');
?>
<div class='container mt-4'>
<h2>Daftar Artikel</h2>
<a href='/lab11_php_oop/artikel/tambah' class='btn btn-primary mb-3'>Tambah Artikel</a>
<table class='table table-bordered table-striped'>
<tr><th>ID</th><th>Judul</th><th>Konten</th><th>Aksi</th></tr>
<?php if($data): ?>
<?php foreach($data as $row): ?>
<tr>
<td><?= htmlspecialchars($row['id']) ?></td>
<td><?= htmlspecialchars($row['judul']) ?></td>
<td><?= htmlspecialchars(substr($row['konten'], 0, 50)) . '...' ?></td>
<td>
<a href='/lab11_php_oop/artikel/ubah?id=<?= $row['id'] ?>' class='btn btn-warning btn-sm'>Ubah</a>
<a href='/lab11_php_oop/artikel/hapus?id=<?= $row['id'] ?>' class='btn btn-danger btn-sm' onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
</td>
</tr>
<?php endforeach; ?>
<?php else: ?>
<tr><td colspan='4'>Belum ada data.</td></tr>
<?php endif; ?>
</table>
</div>
