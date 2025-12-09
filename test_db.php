<?php
// Simple DB connectivity test for local environment
require_once 'config.php';
require_once 'class/Database.php';

try {
    $db = new Database();
    $res = $db->query("SELECT 1 AS ok");
    if ($res) {
        $row = $res->fetch_assoc();
        echo "Koneksi DB berhasil. Test query returned: " . ($row['ok'] ?? 'n/a');
    } else {
        echo "Koneksi terjalin, tapi query test gagal.";
    }
} catch (Exception $e) {
    echo "Gagal koneksi: " . htmlspecialchars($e->getMessage());
}
