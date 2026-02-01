<?php
/*
================================================================================
          PERINGATAN HAK CIPTA DAN PERJANJIAN LISENSI KOMERSIAL
================================================================================

HAK CIPTA (COPYRIGHT) © 2026 PT INOVIXA TECHNOLOGIES SOLUTION
SELURUH HAK DILINDUNGI UNDANG-UNDANG.

Dokumen ini merupakan perjanjian hukum yang mengikat antara Anda (Pengguna) 
dan PT INOVIXA TECHNOLOGIES SOLUTION (Pemilik Hak Cipta).

Pengembangan dan pemeliharaan proyek ini dilakukan oleh:
Nama            : Dani Joest
Tanggal Rilis   : 1 Febuari 2026

Proyek ini merupakan KARYA INTELEKTUAL BERBAYAR (PROPRIETARY SOFTWARE).
Penyalinan, pendistribusian, atau penggunaan tanpa lisensi resmi adalah 
tindakan ILEGAL dan DILARANG KERAS.

================================================================================
                        INFORMASI KONTAK RESMI
================================================================================

Apabila Anda memerlukan verifikasi lisensi atau dukungan teknis, silakan 
menghubungi kontak resmi di bawah ini:

🏢 KONTAK PERUSAHAAN (PUBLISHER)
   -----------------------------
   Nama Perusahaan : PT INOVIXA TECHNOLOGIES SOLUTION
   WhatsApp        : +62 851-2297-7536
   Telegram        : @inovixa
   Email           : hello@inovixa.web.id
   Website         : www.inovixa.web.id

👨‍💻 KONTAK PENGEMBANG (DEVELOPER)
   -----------------------------
   Nama            : Tn. Dani Joest, S.M.T., C.P.M.
   WhatsApp        : +62 823-2066-7363
   Telegram        : @dani_joest
   Email           : dani.joest.id@gmail.com
   Website         : www.danidev.web.id

================================================================================
                            KETENTUAN LISENSI
================================================================================

1. WAJIB LISENSI RESMI
   Setiap penggunaan, instalasi, atau akses terhadap kode sumber (source code) 
   proyek ini wajib disertai dengan bukti pembelian lisensi yang sah dari 
   PT INOVIXA TECHNOLOGIES SOLUTION.

2. LARANGAN KLAIM KEPEMILIKAN
   Dilarang keras mengklaim proyek ini sebagai milik pribadi, milik entitas 
   lain, atau menghapus jejak kepemilikan asli (rebranding tanpa izin).

3. LARANGAN DISTRIBUSI ULANG (NO RESELLING)
   Dilarang memperjualbelikan, mendistribusikan ulang, membagikan secara 
   gratis, atau memodifikasi proyek ini untuk tujuan komersial tanpa 
   persetujuan tertulis dari Pemilik Hak Cipta.

4. INTEGRITAS ATRIBUSI
   Dilarang menghapus, menyembunyikan, atau memodifikasi atribusi Hak Cipta, 
   header file, atau pemberitahuan lisensi yang tercantum dalam perangkat lunak.

================================================================================
                    KONSEKUENSI HUKUM & SANKSI PELANGGARAN
================================================================================

Pelanggaran terhadap ketentuan lisensi ini akan diproses melalui jalur hukum 
secara tegas, meliputi namun tidak terbatas pada:

1. GANTI RUGI FINANSIAL
   Tuntutan ganti rugi minimum sebesar Rp 1.000.000.000 (Satu Miliar Rupiah) 
   sesuai Pasal 113 UU Hak Cipta No. 28 Tahun 2014.

2. PENGHENTIAN PAKSA
   Penghentian permanen atas hak penggunaan proyek beserta seluruh produk 
   turunannya (derivatif), sesuai Pasal 114 UU Hak Cipta No. 28 Tahun 2014.

3. TINDAKAN PIDANA & PERDATA
   Proses hukum tambahan baik pidana maupun perdata akan ditempuh sesuai 
   Pasal 115 UU Hak Cipta No. 28 Tahun 2014.

================================================================================
                          PERNYATAAN PERSETUJUAN
================================================================================

Dengan mengunduh, menginstal, menyalin, atau menggunakan perangkat lunak ini, 
Anda menyatakan telah MEMBACA, MEMAHAMI, dan MENYETUJUI untuk terikat pada 
seluruh syarat dan ketentuan yang tertulis di atas.

PELANGGARAN AKAN DITINDAK TEGAS TANPA TOLERANSI.

PT INOVIXA TECHNOLOGIES SOLUTION
Est. 2026
**/

header('Content-Type: application/json');
$config = require 'config.php';

// Validasi request method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method Not Allowed']);
    exit;
}

// Ambil payload dari frontend
$input = json_decode(file_get_contents('php://input'), true);
$action = $_GET['action'] ?? '';

// Setup Headers Flowix
$headers = [
    "Content-Type: application/json",
    "api_key: " . $config['api']['api_key'],
    "merchant_id: " . $config['api']['merchant_id']
];

$response = [];

switch ($action) {
    case 'create_payment':
        // Endpoint: POST /deposit/create
        $url = $config['api']['base_url'] . '/api/v1/deposit/create';
        
        // Generate Reff ID unik
        $reffId = 'ORDER-' . time() . '-' . rand(100, 999);
        
        $body = [
            'amount' => (int) $config['product']['price'],
            'method_code' => 'QRISFAST', // [cite: 9]
            'fee_by_customer' => false, // Fee ditanggung merchant [cite: 11]
            'reff_id' => $reffId // Parameter sesuai dokumentasi, meski di doc tertulis ref_id, pastikan konsisten
        ];
        
        $response = curlRequest($url, $headers, $body);
        break;

    case 'check_status':
        // Endpoint: POST /deposit/status [cite: 14]
        $url = $config['api']['base_url'] . '/api/v1/deposit/status'; // Menggunakan /deposit/status sesuai doc
        
        if (empty($input['ref_id'])) {
            echo json_encode(['success' => false, 'message' => 'Reference ID Required']);
            exit;
        }

        $body = [
            'ref_id' => $input['ref_id'] // [cite: 14]
        ];
        
        $response = curlRequest($url, $headers, $body);
        break;

    case 'cancel_payment':
        // Endpoint: POST /deposit/cancel [cite: 16]
        $url = $config['api']['base_url'] . '/api/v1/deposit/cancel';
        
        if (empty($input['ref_id'])) {
            echo json_encode(['success' => false, 'message' => 'Reference ID Required']);
            exit;
        }

        $body = [
            'ref_id' => $input['ref_id'] // [cite: 17]
        ];
        
        $response = curlRequest($url, $headers, $body);
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Invalid Action']);
        exit;
}

echo $response;

/**
 * Fungsi Helper Request Tanpa cURL (Native PHP Stream)
 * Kompatibel: Windows, Linux, Termux (Tanpa perlu edit php.ini)
 */
function curlRequest($url, $headers, $body) {
    // 1. Konversi Header Format cURL ke Format Stream Context
    // cURL pakai array ['Key: Value'], Stream butuh string "Key: Value\r\n"
    $headerString = "";
    foreach ($headers as $header) {
        $headerString .= $header . "\r\n";
    }
    // Tambah User-Agent agar tidak diblokir server/WAF
    $headerString .= "User-Agent: Flowix-Client/1.0 (Non-cURL)\r\n";

    // 2. Setup Opsi Stream (Mirip curl_setopt)
    $options = [
        'http' => [
            'method'  => 'POST',
            'header'  => $headerString,
            'content' => json_encode($body),
            'timeout' => 30, // Timeout 30 detik
            'ignore_errors' => true // Tetap ambil body meski status 4xx/5xx
        ],
        "ssl" => [
            // Matikan verifikasi SSL (Setara CURLOPT_SSL_VERIFYPEER = false)
            // Solusi untuk error sertifikat di local environment
            "verify_peer" => false,
            "verify_peer_name" => false,
        ]
    ];

    // 3. Eksekusi Request
    $context  = stream_context_create($options);
    
    // Suppress warning (@) agar error ditangkap logic kita sendiri
    $result = @file_get_contents($url, false, $context);

    // 4. Error Handling
    if ($result === FALSE) {
        $error = error_get_last();
        return json_encode([
            'success' => false, 
            'message' => 'Connection Error: ' . ($error['message'] ?? 'Unknown Error'),
            'debug_hint' => 'Pastikan allow_url_fopen aktif (default: on)'
        ]);
    }

    // 5. Cek HTTP Response Header (Variabel global $http_response_header otomatis terisi)
    // Format baris pertama biasanya "HTTP/1.1 200 OK"
    if (isset($http_response_header[0])) {
        preg_match('#HTTP/\S+\s(\d{3})#', $http_response_header[0], $matches);
        $statusCode = isset($matches[1]) ? (int)$matches[1] : 500;

        if ($statusCode >= 400) {
            return json_encode([
                'success' => false,
                'message' => "HTTP Request Failed. Status Code: {$statusCode}",
                'raw_response' => $result
            ]);
        }
    }

    return $result;
}