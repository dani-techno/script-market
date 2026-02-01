# 💎 Flowix Instant Checkout – QRIS Digital Payment System

![PHP Version](https://img.shields.io/badge/PHP-8.0%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.0-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Payment Gateway](https://img.shields.io/badge/Gateway-Flowix%20%2F%20QRIS-000000?style=for-the-badge&logo=google-pay&logoColor=white)
![Status](https://img.shields.io/badge/Status-Production%20Ready-success?style=for-the-badge)

> **Modern, Lightweight, & Secure.** Sistem *checkout* produk digital *single-page* yang terintegrasi penuh dengan Payment Gateway Flowix. Dilengkapi dengan antarmuka *Glassmorphism*, dukungan *Dark Mode*, dan sistem *Real-time Polling* untuk validasi pembayaran QRIS otomatis.

---

## 📑 Daftar Isi
- [Arsitektur & Logika Sistem](#-arsitektur--logika-sistem)
- [Fitur Utama](#-fitur-utama)
- [Teknologi](#-teknologi)
- [Struktur Proyek](#-struktur-proyek)
- [Instalasi & Konfigurasi](#-instalasi--konfigurasi)
- [API Reference (Internal Proxy)](#-api-reference-internal-proxy)
- [Keamanan & Best Practices](#-keamanan--best-practices)
- [Credits](#-credits)

---

## 🧠 Arsitektur & Logika Sistem

Sistem ini menggunakan pola **Backend-for-Frontend (BFF)** sederhana melalui `api.php` untuk mengamankan kredensial API.

### Diagram Alur Transaksi
1.  **Inisiasi (Client):** User menekan "Bayar Sekarang". Frontend memanggil `POST /api.php?action=create_payment`.
2.  **Secure Proxy (Server):** `api.php` menyuntikkan `API_KEY` & `MERCHANT_ID` dari server-side (tidak terekspos di browser) dan meneruskan request ke Gateway Flowix.
3.  **Respon QR:** Server menerima string QR Code, Frontend merender QR menggunakan `qrcode.js`.
4.  **Polling Strategy:** Frontend melakukan *short-polling* setiap 4 detik ke `api.php?action=check_status` untuk memantau status pembayaran secara *real-time* tanpa membebani server secara berlebihan.
5.  **Penyelesaian:** Jika status `paid`, tombol download dibuka. Sistem menyimpan state di `localStorage` untuk mencegah data hilang saat *refresh* browser.

---

## ✨ Fitur Utama

### 🎨 User Interface (UI/UX)
* **Glassmorphism Premium Design:** Menggunakan transparansi dan blur effect yang modern.
* **Adaptive Dark Mode:** Otomatis mendeteksi preferensi sistem pengguna atau toggle manual.
* **Responsive Mobile-First:** Tampilan optimal di semua perangkat.
* **Interactive Feedback:** Toast notifications, loading states, dan animasi transisi yang halus.

### ⚙️ Backend & Logic
* **Secure API Proxying:** Kunci API (Sensitive Data) tetap aman di sisi server (`config.php`), tidak pernah dikirim ke frontend.
* **Smart Polling & Caching:** Mengurangi beban request dengan interval polling yang optimal (4 detik) dan caching state lokal.
* **Auto-Expiry Handling:** Menangani sesi pembayaran yang kadaluarsa secara otomatis di UI.
* **QRIS Generation:** Render QR Code di sisi klien untuk performa yang lebih cepat.

---

## 🛠 Teknologi

* **Language:** PHP 8.x (Native, tanpa framework berat)
* **Styling:** Tailwind CSS (via CDN untuk kemudahan deployment)
* **JS Libraries:**
    * `qrcode.js` (Generasi QR Code)
    * `FontAwesome 6` (Ikonografi)
* **HTTP Client:** cURL (Standard PHP Library)

---

## 📂 Struktur Proyek

```bash
/project-root
│
├── api.php             # Core Logic: Proxy request ke Payment Gateway & validasi
├── config.php          # Central Config: API Keys, Merchant ID, & Info Produk
├── download.php        # Secure Endpoint: Proteksi akses file produk
├── index.php           # Frontend: UI/UX, State Management, & Polling Logic
├── wa-bot-topup.jpg    # Aset gambar produk
└── README.md           # Dokumentasi Proyek

```

---

## 🚀 Instalasi & Konfigurasi

### 1. Prerequisites

Pastikan server Anda memenuhi syarat berikut:

* PHP >= 7.4 (Disarankan PHP 8.1+)
* Ekstensi PHP: `cURL`, `json`

### 2. Setup Project

Clone repositori atau ekstrak file ke web server (htdocs/www).

```bash
git clone https://github.com/dani-techno/script-market.git
cd script-market

```

### 3. Konfigurasi Kredensial

Buka file `config.php` dan sesuaikan dengan data dari dashboard Flowix/Atlantic Anda:

```php
// config.php
return [
    'api' => [
        'base_url'    => 'https://flowix.web.id, //
        'api_key'     => 'sk-xxxx-xxxx',          // API Key Rahasia Anda
        'merchant_id' => 'MID-DANxxxx',           //
    ],
    'product' => [
        'title'        => 'Nama Produk Digital',
        'price'        => 50000,
        // ...
    ],
];

```

### 4. Menjalankan Server (Local Development)

Jika tidak menggunakan XAMPP/Laragon, Anda bisa menggunakan built-in server PHP:

```bash
php -S localhost:8000

```

Buka `http://localhost:8000` di browser Anda.

---

## 📡 API Reference (Internal Proxy)

Frontend berinteraksi dengan `api.php`, bukan langsung ke Gateway. Berikut spesifikasi internal endpoint:

| Action | Method | Parameter | Deskripsi |
| --- | --- | --- | --- |
| `create_payment` | `POST` | `-` | Membuat transaksi baru & mendapatkan string QR. |
| `check_status` | `POST` | `ref_id` | Mengecek status transaksi ke Gateway. |
| `cancel_payment` | `POST` | `ref_id` | Membatalkan transaksi yang sedang berjalan. |

---

## 🛡 Keamanan & Best Practices

Sebagai **Senior Engineer**, berikut adalah catatan penting untuk *deployment* ke Production:

1. **SSL/TLS Wajib:** Jangan pernah menggunakan HTTP biasa di production. Enkripsi lalu lintas data sangat krusial untuk transaksi pembayaran.
2. **Database Implementation:**
* Kode saat ini (`download.php`) menggunakan logika bypass sederhana untuk demo.
* **Rekomendasi:** Simpan status transaksi sukses di Database (MySQL/PostgreSQL) dan verifikasi `ref_id` di database sebelum mengizinkan download file.


3. **Hidden Files:** Pastikan file `config.php` tidak bisa diakses langsung via browser (configure `.htaccess` atau nginx conf).
4. **Error Handling:** Di production, matikan `display_errors` di `php.ini` untuk mencegah *path disclosure*.

---

## 👨‍💻 Credits

Project ini dikembangkan dengan standar tinggi untuk kebersihan kode dan performa.

* **Core Developer:** Dani Joest (Full-Stack Software Engineer)
* **Integrasi Payment:** Flowix Technology
* **Kontak Support:**
* WhatsApp: +62 823-2066-7363
* Email: dani.joest.id@gmail.com



---

> *"Code is like humor. When you have to explain it, it’s bad."* – **Clean Code**

Build with ❤️ by **Mr. Dani Joest, S.M.T., C.P.M**.
