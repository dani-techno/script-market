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
$product = $config['product'];
?>
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - <?= htmlspecialchars($product['title']) ?></title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        // System Dark Mode Check
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }

        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        heading: ['"Outfit"', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            500: '#0ea5e9', // Sky Blue
                            600: '#0284c7',
                            700: '#0369a1',
                        },
                        dark: {
                            800: '#1e293b',
                            900: '#0f172a',
                            950: '#020617',
                        }
                    },
                    animation: {
                        'blob': 'blob 10s infinite',
                        'scan': 'scan 2.5s linear infinite',
                        'fade-in-up': 'fadeInUp 0.3s ease-out forwards',
                    },
                    keyframes: {
                        blob: {
                            '0%': { transform: 'translate(0px, 0px) scale(1)' },
                            '33%': { transform: 'translate(30px, -50px) scale(1.1)' },
                            '66%': { transform: 'translate(-20px, 20px) scale(0.9)' },
                            '100%': { transform: 'translate(0px, 0px) scale(1)' },
                        },
                        scan: {
                            '0%': { top: '0%', opacity: '0' },
                            '15%': { opacity: '1' },
                            '85%': { opacity: '1' },
                            '100%': { top: '100%', opacity: '0' },
                        },
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(10px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        }
                    }
                }
            }
        };
    </script>
    <style>
        body { background-color: #f8fafc; }
        .dark body { background-color: #020617; }
        
        /* Premium Aurora Background */
        .aurora-bg {
            position: fixed; inset: 0; z-index: -1; overflow: hidden;
        }
        
        /* Modern Glassmorphism */
        .glass-panel {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
        }
        .dark .glass-panel {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        /* QR Code Styling */
        #qrcode img {
            margin: auto;
            border-radius: 12px;
            padding: 8px;
            background: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .dark ::-webkit-scrollbar-thumb { background: #334155; }
    </style>
</head>
<body class="text-slate-800 dark:text-slate-200 antialiased transition-colors duration-300 min-h-screen flex items-center justify-center p-4 selection:bg-brand-500 selection:text-white">

    <div id="toast-container" class="fixed top-5 right-5 z-[100] flex flex-col gap-3 pointer-events-none"></div>

    <div class="aurora-bg">
        <div class="absolute top-0 -left-4 w-96 h-96 bg-purple-400/30 dark:bg-purple-900/40 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob"></div>
        <div class="absolute top-0 -right-4 w-96 h-96 bg-brand-400/30 dark:bg-brand-900/40 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-96 h-96 bg-pink-400/30 dark:bg-pink-900/40 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-4000"></div>
        <div class="absolute inset-0 bg-grid-slate-200/[0.04] dark:bg-grid-slate-800/[0.04] bg-[bottom_1px_center]"></div>
    </div>

    <div class="w-full max-w-5xl glass-panel rounded-[2rem] overflow-hidden flex flex-col md:flex-row md:items-center transition-all duration-300 ring-1 ring-white/20 dark:ring-white/5">
        
        <div class="relative w-full md:w-5/12 aspect-video overflow-hidden group bg-slate-100 dark:bg-slate-900">
            <img src="<?= htmlspecialchars($product['image_url']) ?>" 
                 alt="Product" 
                 class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">
            
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/20 to-transparent"></div>
            
            <div class="absolute top-6 left-6">
                <span class="px-3 py-1.5 bg-white/20 backdrop-blur-md border border-white/20 text-white text-xs font-bold rounded-full flex items-center gap-2 tracking-wide">
                    <i class="fas fa-star text-yellow-400"></i> BEST SELLER
                </span>
            </div>

            <div class="absolute bottom-8 left-8 right-8 text-white transform translate-y-2 group-hover:translate-y-0 transition-transform duration-500">
                <h2 class="text-3xl font-heading font-bold leading-tight drop-shadow-xl"><?= htmlspecialchars($product['title']) ?></h2>
            </div>
        </div>

        <div class="w-full md:w-7/12 p-8 md:p-12 flex flex-col justify-between relative bg-white/40 dark:bg-dark-900/40">
            
            <div>
                <div class="flex items-center justify-between mb-4">
                    <h1 class="text-2xl font-heading font-bold text-slate-900 dark:text-white">Ringkasan Pesanan</h1>
                    <button onclick="toggleDarkMode()" class="w-10 h-10 rounded-full flex items-center justify-center hover:bg-slate-200/50 dark:hover:bg-slate-700/50 text-slate-500 dark:text-slate-400 transition-all active:scale-95">
                        <i class="fas fa-moon dark:hidden"></i>
                        <i class="fas fa-sun hidden dark:block"></i>
                    </button>
                </div>
                
                <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed mb-8">
                    <?= htmlspecialchars($product['description']) ?>
                </p>

                <div class="grid grid-cols-2 gap-4 mb-8">
                    <div class="p-4 rounded-2xl bg-white/60 dark:bg-slate-800/60 border border-slate-200/50 dark:border-slate-700/50 hover:border-brand-500/30 transition-colors">
                        <div class="text-xs text-slate-500 uppercase font-bold tracking-wider mb-1">Metode</div>
                        <div class="font-bold text-slate-800 dark:text-slate-100 flex items-center gap-2">
                            <i class="fas fa-qrcode text-brand-500"></i> QRIS Otomatis
                        </div>
                    </div>
                    <div class="p-4 rounded-2xl bg-white/60 dark:bg-slate-800/60 border border-slate-200/50 dark:border-slate-700/50 hover:border-green-500/30 transition-colors">
                        <div class="text-xs text-slate-500 uppercase font-bold tracking-wider mb-1">Keamanan</div>
                        <div class="font-bold text-slate-800 dark:text-slate-100 flex items-center gap-2">
                            <i class="fas fa-shield-alt text-green-500"></i> Enkripsi SSL
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 pt-6 border-t border-slate-200/50 dark:border-slate-700/50">
                <div class="flex items-end justify-between mb-6">
                    <div class="flex flex-col">
                        <span class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Total Pembayaran</span>
                        <div class="flex items-baseline gap-1">
                            <span class="text-sm font-semibold text-brand-600">Rp</span>
                            <span class="text-4xl font-heading font-bold text-slate-900 dark:text-white tracking-tight">
                                <?= number_format($product['price'], 0, ',', '.') ?>
                            </span>
                        </div>
                    </div>
                </div>

                <button onclick="processOrder()" 
                        class="group relative w-full bg-gradient-to-r from-brand-600 to-brand-500 hover:from-brand-500 hover:to-brand-400 text-white p-4 rounded-xl font-bold shadow-lg shadow-brand-500/20 transition-all duration-300 active:scale-[0.98] overflow-hidden">
                    <span class="relative z-10 flex items-center justify-center gap-3">
                        <span id="btn-text">Bayar Sekarang</span> 
                        <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                    </span>
                    <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-out"></div>
                </button>
            </div>
        </div>
    </div>

    <div id="popup" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity opacity-0 duration-300" 
             id="popup-backdrop" onclick="closePopup()"></div>
        
        <div class="relative w-full max-w-sm mx-4 bg-white dark:bg-dark-800 rounded-[2rem] p-6 shadow-2xl border border-white/10 dark:border-slate-700 transform transition-all scale-95 opacity-0 duration-300" id="popup-content">
            
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-brand-50 dark:bg-brand-900/30 text-brand-500 mb-3">
                    <i class="fas fa-qrcode text-xl"></i>
                </div>
                <h3 class="text-xl font-heading font-bold text-slate-900 dark:text-white">Scan QRIS</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Selesaikan dalam <span id="header-timer" class="text-rose-500 font-mono font-bold bg-rose-50 dark:bg-rose-900/20 px-2 py-0.5 rounded">05:00</span></p>
            </div>

            <div id="qris-wrapper" class="relative bg-white p-4 rounded-2xl border-2 border-dashed border-slate-200 dark:border-slate-600 flex flex-col justify-center items-center min-h-[280px] overflow-hidden transition-all">
                
                <div id="loader" class="absolute inset-0 flex flex-col items-center justify-center bg-white z-20">
                    <i class="fas fa-circle-notch fa-spin text-4xl text-brand-500 mb-4"></i>
                    <p class="text-sm font-semibold text-slate-400 animate-pulse">Membuat QR Code...</p>
                </div>

                <div id="qrcode" class="hidden relative z-10"></div>
                
                <div id="scan-line" class="absolute left-0 w-full h-0.5 bg-brand-500 shadow-[0_0_15px_#0ea5e9] z-10 hidden animate-scan pointer-events-none"></div>

                <div id="success-icon" class="hidden flex-col items-center justify-center absolute inset-0 bg-white z-30 animate-fade-in-up">
                    <div class="w-20 h-20 bg-green-100 text-green-500 rounded-full flex items-center justify-center text-4xl mb-4 shadow-sm">
                        <i class="fas fa-check"></i>
                    </div>
                    <p class="text-slate-800 font-bold text-xl">Pembayaran Berhasil!</p>
                    <p class="text-slate-500 text-sm mt-1">Mengalihkan...</p>
                </div>

                <div id="expired-icon" class="hidden flex-col items-center justify-center absolute inset-0 bg-white z-30 animate-fade-in-up">
                    <div class="w-20 h-20 bg-rose-100 text-rose-500 rounded-full flex items-center justify-center text-4xl mb-4">
                        <i class="fas fa-hourglass-end"></i>
                    </div>
                    <p class="text-slate-800 font-bold text-lg">Waktu Habis</p>
                    <p class="text-xs text-slate-500 mt-1">Silakan buat pesanan baru</p>
                </div>
            </div>

            <div class="mt-6 mb-6 text-center">
                <div id="payment-status-container" class="inline-block px-4 py-2 rounded-full bg-brand-50 dark:bg-brand-900/20">
                    <p id="payment-status" class="text-sm font-bold text-brand-600 dark:text-brand-400 animate-pulse flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-brand-500 animate-ping"></span> Menunggu Pembayaran
                    </p>
                </div>
            </div>

            <div class="space-y-3">
                <a id="download-btn" href="#" onclick="fetchDownloadLink(event)" 
                   class="hidden w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-green-500/30 transition-all text-center flex items-center justify-center gap-2 transform active:scale-[0.98]">
                    <i class="fas fa-download"></i> Download Produk
                </a>
                
                <button id="cancel-btn" onclick="cancelPayment()" 
                        class="w-full bg-slate-100 dark:bg-slate-700 hover:bg-rose-100 hover:text-rose-600 dark:hover:bg-rose-900/30 dark:hover:text-rose-400 text-slate-600 dark:text-slate-300 font-semibold py-3.5 rounded-xl transition-all duration-200 text-sm">
                    Batalkan Pesanan
                </button>
            </div>

            <button onclick="closePopup()" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition bg-slate-100 dark:bg-slate-700 rounded-full w-8 h-8 flex items-center justify-center">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <script>
        // --- SENIOR ENGINEER CONFIG ---
        const CONFIG = {
            timeoutMinutes: 5,
            checkIntervalMs: 4000, // 4 Seconds: Optimal balance for server load vs UX
            storageKeys: {
                refId: 'flowix_ref_id',
                qrString: 'flowix_qr_data',
                expiry: 'flowix_expiry',
                isPaid: 'flowix_paid_status'
            }
        };

        // --- STATE MANAGEMENT ---
        let state = {
            checkInterval: null,
            countdownInterval: null,
            activeRefId: localStorage.getItem(CONFIG.storageKeys.refId),
            isPaid: localStorage.getItem(CONFIG.storageKeys.isPaid) === 'true'
        };

        // --- INIT & THEME ---
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
            if (!('theme' in localStorage)) document.documentElement.classList.toggle('dark', e.matches);
        });

        function toggleDarkMode() {
            const isDark = document.documentElement.classList.toggle('dark');
            localStorage.theme = isDark ? 'dark' : 'light';
        }

        // --- CORE FUNCTIONS ---

        function showToast(message, type = 'success') {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            
            // Icon & Color Config
            const styles = {
                success: { icon: 'fa-check-circle', color: 'text-green-500', border: 'border-l-4 border-green-500' },
                error:   { icon: 'fa-exclamation-circle', color: 'text-rose-500', border: 'border-l-4 border-rose-500' },
                info:    { icon: 'fa-info-circle', color: 'text-brand-500', border: 'border-l-4 border-brand-500' },
                neutral: { icon: 'fa-trash', color: 'text-slate-500', border: 'border-l-4 border-slate-400' }
            };
            const style = styles[type] || styles.info;

            toast.className = `pointer-events-auto flex items-center w-full max-w-xs p-4 space-x-3 text-slate-500 bg-white dark:bg-slate-800 rounded-lg shadow-xl dark:text-slate-300 transform transition-all duration-300 translate-x-10 opacity-0 ${style.border}`;
            toast.innerHTML = `
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 ${style.color} bg-slate-100 dark:bg-slate-700 rounded-lg">
                    <i class="fas ${style.icon}"></i>
                </div>
                <div class="ml-3 text-sm font-medium">${message}</div>
            `;

            container.appendChild(toast);

            // Animate In
            requestAnimationFrame(() => {
                toast.classList.remove('translate-x-10', 'opacity-0');
            });

            // Remove after 3s
            setTimeout(() => {
                toast.classList.add('translate-x-10', 'opacity-0');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        function resetPaymentState() {
            // Clear Storage
            localStorage.removeItem(CONFIG.storageKeys.refId);
            localStorage.removeItem(CONFIG.storageKeys.qrString);
            localStorage.removeItem(CONFIG.storageKeys.expiry);
            localStorage.removeItem(CONFIG.storageKeys.isPaid);

            // Clear Memory
            if (state.checkInterval) clearInterval(state.checkInterval);
            if (state.countdownInterval) clearInterval(state.countdownInterval);
            state.activeRefId = null;
            state.isPaid = false;

            // Reset UI bits if needed
            document.getElementById('header-timer').innerText = "05:00";
        }

        function generateQR(qrString) {
            const container = document.getElementById("qrcode");
            container.innerHTML = "";
            new QRCode(container, {
                text: qrString,
                width: 220,
                height: 220,
                colorDark : "#000000",
                colorLight : "#ffffff",
                correctLevel : QRCode.CorrectLevel.L // Low is faster to scan for dense urls
            });
            container.classList.remove('hidden');
        }

        function startCountdown(expiryTimestamp) {
            if (state.countdownInterval) clearInterval(state.countdownInterval);
            
            const timerEl = document.getElementById('header-timer');
            
            state.countdownInterval = setInterval(() => {
                const now = Date.now();
                const diff = expiryTimestamp - now;
                
                if (diff <= 0) {
                    clearInterval(state.countdownInterval);
                    timerEl.innerText = "00:00";
                    handleExpired();
                } else {
                    const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((diff % (1000 * 60)) / 1000);
                    timerEl.innerText = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                }
            }, 1000);
        }

        // --- UI HANDLERS ---

        function showPopup() {
            const popup = document.getElementById('popup');
            const backdrop = document.getElementById('popup-backdrop');
            const content = document.getElementById('popup-content');
            
            popup.classList.remove('hidden');
            // Small delay to allow display:block to render before opacity transition
            setTimeout(() => {
                backdrop.classList.remove('opacity-0');
                content.classList.remove('opacity-0', 'scale-95');
                content.classList.add('scale-100');
            }, 10);
        }

        function closePopup() {
            const popup = document.getElementById('popup');
            const backdrop = document.getElementById('popup-backdrop');
            const content = document.getElementById('popup-content');
            
            backdrop.classList.add('opacity-0');
            content.classList.add('opacity-0', 'scale-95');
            content.classList.remove('scale-100');
            
            setTimeout(() => {
                popup.classList.add('hidden');
                // IMPORTANT: If user closes popup but hasn't cancelled/paid, 
                // we DO NOT reset state. They might open it again or we might poll in background.
                // However, for this UX, let's stop polling to save resources if they close the modal.
                // But generally, you want to keep polling or auto-cancel. 
                // I will leave state active so they can resume "Bayar" button.
            }, 300);
        }

        function updateUI(status, data = null) {
            const els = {
                loader: document.getElementById('loader'),
                success: document.getElementById('success-icon'),
                expired: document.getElementById('expired-icon'),
                qrcode: document.getElementById('qrcode'),
                scanLine: document.getElementById('scan-line'),
                statusText: document.getElementById('payment-status'),
                statusContainer: document.getElementById('payment-status-container'),
                dlBtn: document.getElementById('download-btn'),
                cancelBtn: document.getElementById('cancel-btn')
            };

            // Reset Visibility
            els.loader.classList.add('hidden');
            els.success.classList.add('hidden');
            els.expired.classList.add('hidden');
            els.qrcode.classList.add('hidden');
            els.scanLine.classList.add('hidden');

            if (status === 'pending') {
                if (data && data.qr) {
                    generateQR(data.qr);
                    els.scanLine.classList.remove('hidden');
                }
                els.cancelBtn.innerHTML = 'Batalkan Pesanan';
                els.cancelBtn.onclick = cancelPayment;
                els.dlBtn.classList.add('hidden');
                els.cancelBtn.classList.remove('hidden');
                
                els.statusText.innerHTML = '<span class="w-2 h-2 rounded-full bg-brand-500 animate-ping"></span> Menunggu Pembayaran';
                els.statusText.className = "text-sm font-bold text-brand-600 dark:text-brand-400 animate-pulse flex items-center gap-2";
                els.statusContainer.className = "inline-block px-4 py-2 rounded-full bg-brand-50 dark:bg-brand-900/20";

            } else if (status === 'success') {
                els.success.classList.remove('hidden');
                els.success.classList.add('flex');
                
                els.dlBtn.classList.remove('hidden');
                els.cancelBtn.classList.add('hidden');
                
                els.statusText.innerText = "Lunas! Terima Kasih";
                els.statusText.className = "text-sm font-bold text-green-600 dark:text-green-400";
                els.statusContainer.className = "inline-block px-4 py-2 rounded-full bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800";
                
                document.getElementById('header-timer').innerText = "LUNAS";
                if (state.countdownInterval) clearInterval(state.countdownInterval);

            } else if (status === 'expired') {
                els.expired.classList.remove('hidden');
                els.expired.classList.add('flex');
                
                els.statusText.innerText = "Waktu Habis";
                els.statusText.className = "text-sm font-bold text-rose-500";
                
                els.cancelBtn.innerHTML = '<i class="fas fa-redo"></i> Buat Ulang';
                els.cancelBtn.onclick = () => { closePopup(); resetPaymentState(); };
                
                if (state.checkInterval) clearInterval(state.checkInterval);
            }
        }

        // --- BUSINESS LOGIC ---

        async function processOrder() {
            // Case 1: Already Paid
            if (state.isPaid) {
                showPopup();
                updateUI('success');
                return;
            }

            // Case 2: Resume Pending Transaction
            if (state.activeRefId) {
                showPopup();
                
                // Check if expired locally first
                const savedExpiry = localStorage.getItem(CONFIG.storageKeys.expiry);
                if (savedExpiry && Date.now() > savedExpiry) {
                    handleExpired();
                    return;
                }

                // Restore View
                const cachedQR = localStorage.getItem(CONFIG.storageKeys.qrString);
                if (cachedQR) updateUI('pending', { qr: cachedQR });
                
                if (savedExpiry) startCountdown(savedExpiry);
                startPolling(state.activeRefId);
                return;
            }

            // Case 3: New Transaction
            showPopup();
            document.getElementById('loader').classList.remove('hidden');
            
            try {
                const res = await fetch('api.php?action=create_payment', { method: 'POST' });
                const result = await res.json();

                if (result.success) {
                    const data = result.data;
                    state.activeRefId = data.ref_id;
                    
                    // Robust Data Retrieval
                    const qrString = data.payment_data?.qr?.string || data.qr_content || "Error-QR";
                    const expiryTime = Date.now() + (CONFIG.timeoutMinutes * 60 * 1000);

                    // Save State
                    localStorage.setItem(CONFIG.storageKeys.refId, state.activeRefId);
                    localStorage.setItem(CONFIG.storageKeys.qrString, qrString);
                    localStorage.setItem(CONFIG.storageKeys.expiry, expiryTime);

                    updateUI('pending', { qr: qrString });
                    startCountdown(expiryTime);
                    startPolling(state.activeRefId);
                } else {
                    showToast(result.message || 'Gagal membuat pesanan', 'error');
                    closePopup();
                }
            } catch (error) {
                console.error(error);
                showToast('Gagal terhubung ke server', 'error');
                closePopup();
            }
        }

        function startPolling(refId) {
            if (state.checkInterval) clearInterval(state.checkInterval);

            // Interval 4 Detik (Sesuai request untuk optimasi 'worth it')
            state.checkInterval = setInterval(async () => {
                // Optimization: Don't poll if document is hidden (user switched tabs)
                // if (document.hidden) return; 
                // ^ Optional: Uncomment if you want to save server resources strictly.
                // Keeping it active for now so they hear the notification if tab is backgrounded.

                try {
                    const res = await fetch('api.php?action=check_status', {
                        method: 'POST',
                        body: JSON.stringify({ ref_id: refId })
                    });
                    const result = await res.json();
                    
                    if (result.success) {
                        const status = result.data.status;
                        
                        if (status === 'success') {
                            // Payment Success
                            localStorage.setItem(CONFIG.storageKeys.isPaid, 'true');
                            // Clean up sensitive transaction data, keep paid status
                            localStorage.removeItem(CONFIG.storageKeys.refId);
                            localStorage.removeItem(CONFIG.storageKeys.expiry);
                            state.isPaid = true;
                            
                            clearInterval(state.checkInterval);
                            updateUI('success');
                            showToast('Pembayaran Berhasil Diterima!', 'success');

                        } else if (['expired', 'failed', 'canceled'].includes(status)) {
                            // Payment Failed/Expired
                            handleExpired();
                        }
                    }
                } catch (e) { console.error("Poll fail", e); }
            }, CONFIG.checkIntervalMs);
        }

        async function handleExpired() {
            resetPaymentState(); // Clear logic state
            updateUI('expired'); // Show visual expired state
        }

        async function cancelPayment() {
            if (!state.activeRefId) {
                closePopup();
                return;
            }

            const btn = document.getElementById('cancel-btn');
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
            btn.disabled = true;

            try {
                await fetch('api.php?action=cancel_payment', {
                    method: 'POST',
                    body: JSON.stringify({ ref_id: state.activeRefId })
                });

                // KEY REQUIREMENT FULFILLED:
                // 1. Notify user
                showToast('Pembayaran berhasil dibatalkan', 'neutral');
                
                // 2. Full Reset Logic so "Make Payment" works immediately
                resetPaymentState();
                
                // 3. Close Popup
                closePopup();

            } catch (e) {
                showToast('Gagal membatalkan transaksi', 'error');
            } finally {
                btn.innerHTML = originalText;
                btn.disabled = false;
            }
        }

        async function fetchDownloadLink(e) {
            e.preventDefault();
            const btn = e.target.closest('a');
            const originalHTML = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Memproses...';
            btn.classList.add('opacity-75', 'cursor-wait');
            
            try {
                const res = await fetch('download.php', { method: 'POST' });
                const data = await res.json();
                if (data.download_url) {
                    window.location.href = data.download_url;
                    showToast('Download dimulai...', 'success');
                } else {
                    showToast('Link belum tersedia', 'error');
                }
            } catch (e) {
                showToast('Gagal melakukan download', 'error');
            } finally {
                btn.innerHTML = originalHTML;
                btn.classList.remove('opacity-75', 'cursor-wait');
            }
        }
    </script>
</body>
</html>