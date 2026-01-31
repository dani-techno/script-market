<?php
/**
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
*/

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

// Setup Headers Flowix [cite: 4, 6]
$headers = [
    "Content-Type: application/json",
    "api_key: " . $config['api']['api_key'],
    "merchant_id: " . $config['api']['merchant_id']
];

$response = [];

switch ($action) {
    case 'create_payment':
        // Endpoint: POST /deposit/create [cite: 10]
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
 * Fungsi Helper cURL
 */
function curlRequest($url, $headers, $body) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    // Non-aktifkan SSL verify untuk development local jika perlu (opsional)
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    $result = curl_exec($ch);
    
    if (curl_errno($ch)) {
        return json_encode(['success' => false, 'message' => 'Curl Error: ' . curl_error($ch)]);
    }
    
    curl_close($ch);
    return $result;
}