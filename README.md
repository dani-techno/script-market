# 🚀 Sistem Pembelian dengan QRIS – Integrasi ForestAPI  

Proyek ini adalah sistem pembelian digital berbasis **PHP** dan **Tailwind CSS**, yang diintegrasikan dengan **[ForestAPI](https://forestapi.web.id)** untuk pemrosesan pembayaran melalui **QRIS**.  

## 🛠️ Fitur  

✅ Tampilan modern dengan **Tailwind CSS**  
✅ Pembayaran otomatis melalui **QRIS (ForestAPI)**  
✅ Penyimpanan status pembayaran di **localStorage**  
✅ Unduhan otomatis setelah transaksi sukses  

## 📂 Struktur Proyek  

```
/script-market
│── index.php          # Halaman utama pembelian  
│── config.php         # Konfigurasi API dan produk  
│── download.php       # Endpoint untuk unduhan setelah pembayaran  
```

## 🔧 Konfigurasi  

Proyek ini menggunakan **ForestAPI** untuk pemrosesan pembayaran. Pastikan `config.php` sudah dikonfigurasi dengan benar:  

```php
<?php
return [
    'api' => [
        'base_url' => 'https://forestapi.web.id', // URL API ForestAPI  
        'api_key'  => 'YOUR_SECRET_KEY', // Ganti dengan API Key Anda  
    ],
    'product' => [
        'title'        => 'Script Bot WhatsApp',
        'description'  => 'Otomatisasi pesan pelanggan dengan fitur AI dan API.',
        'price'        => 5000, // Harga dalam IDR
        'image_url'    => 'https://forestapi.web.id/home/images/project-wa-bot-topup.jpg',
        'download_url' => 'https://www.mediafire.com/file/au98orgynjpqj10/bot.zip/file',
    ],
];
```

## ▶️ Cara Menggunakan  

1. **Pastikan API Key Valid**  
   - Dapatkan API Key dari **[ForestAPI](https://forestapi.web.id)**  
   - Masukkan API Key ke dalam `config.php`  

2. **Jalankan Server**  
   Gunakan server lokal seperti **XAMPP** atau PHP built-in server:  

   ```
   php -S localhost:8000
   ```

3. **Akses Halaman Pembelian**  
   - Buka browser: `http://localhost:8000/index.php`  
   - Klik tombol **"Order"** untuk membuat transaksi QRIS  
   - Pindai kode QR dan lakukan pembayaran  

4. **Unduh Produk**  
   - Setelah pembayaran sukses, tautan unduhan akan muncul secara otomatis  
   - Jika transaksi gagal atau dibatalkan, pengguna bisa mencoba ulang  

## 🔗 API Endpoint (ForestAPI)  

| Endpoint | Deskripsi |  
|----------|------------|  
| `POST /api/h2h/deposit/create` | Membuat pembayaran QRIS |  
| `POST /api/h2h/deposit/status` | Mengecek status pembayaran |  
| `POST /api/h2h/deposit/cancel` | Membatalkan pembayaran |  

## ⚙️ Teknologi yang Digunakan  

- **Frontend:** Tailwind CSS, Font Awesome  
- **Backend:** PHP  
- **API Pembayaran:** **ForestAPI** (QRIS)  

## 📌 Catatan  

- Pastikan **API Key** aman dan tidak dibagikan secara publik  
- Cek status pembayaran sebelum mengunduh produk  
- Jika terjadi masalah dengan transaksi, hubungi **ForestAPI Support**  

## 📄 Informasi  

- **Pembuat / Pengembang:** **Dani Technology** - Full Stack Developer & Software Engineer  
- **Kontak Pembuat / Pengembang:**  
  - **WhatsApp:** +62 838-3499-4479 / +62 823-2066-7363  
  - **Email:** dani.technology.id@gmail.com  

## 💖 Terima Kasih Kepada  

- **Dani Technology** - Full Stack Developer & Software Engineer (Pembuat / Pengembang)  
- **ForestAPI** | [forestapi.web.id](https://forestapi.web.id) (Penyedia API Payment Gateway)  
