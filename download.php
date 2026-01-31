<?php
$config = require 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(403);
    die(json_encode(["error" => "Akses ditolak!"]));
}

// NOTE: Di implementasi nyata, CEK database Anda di sini apakah user IP/Session ini sudah berstatus 'paid'.
// Karena ini kode demo tanpa DB, kita asumsikan frontend sudah handle logic (tapi ini tidak aman 100%).
// Untuk keamanan maksimal, simpan status pembayaran di $_SESSION['is_paid'] saat webhook/check_status sukses.

$fileUrl = $config['product']['download_url'];

echo json_encode(["download_url" => $fileUrl]);
exit;