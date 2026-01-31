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

$config = require 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(403);
    die(json_encode(["error" => "Akses ditolak!"]));
}

$fileUrl = $config['product']['download_url'];

echo json_encode(["download_url" => $fileUrl]);
exit;