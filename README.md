Product Manager - Web Application (PHP & MySQL)
Proyek ini adalah Aplikasi Manajemen Produk (CRUD) berbasis web yang dibangun menggunakan PHP Native (PDO), MySQL, dan CSS3. Aplikasi ini dibuat untuk memenuhi Tugas Akhir Pemrograman Web (Pertemuan 3).

Identitas Pembuat
Nama: Salis Safira Ramadhona
NIM: 250180173
Mata Kuliah: Pemrograman Web

Fitur Utama
Create (Tambah Produk): Form penambahan produk baru (Nama, Kategori, Harga, Stok).
Validasi Server-Side: Nama produk minimal 3 karakter. Harga harus berupa angka lebih besar dari 0. Stok tidak boleh negatif (\ge 0).
Menggunakan Pola PRG (Post-Redirect-Get) untuk mencegah pendaftaran/submit ganda saat halaman di-refresh.

Read (Tampil Produk):
Menampilkan daftar produk menggunakan layout Responsive Card Grid. Menampilkan pesan konfirmasi / notifikasi saat aksi berhasil.

Update (Edit Produk):
Mengubah data produk yang sudah ada berdasarkan ID produk.

Delete (Hapus Produk):
Menghapus produk secara aman menggunakan Method POST dan Token CSRF untuk mencegah serangan Cross-Site Request Forgery.

Security (Keamanan):
Proteksi XSS (Cross-Site Scripting) menggunakan htmlspecialchars() pada semua output user. Prepared Statements (PDO) untuk mencegah serangan SQL Injection.

Fitur Bonus (Search & Filter):
Pencarian produk berdasarkan nama atau kategori menggunakan parameter query GET yang aman.

Struktur Folder Proyek
product-manager/
├── config/
│   └── db.php           # Koneksi Database menggunakan PDO
├── public/
│   ├── assets/
│   │   └── style.css    # Styling aplikasi (Responsive Grid & UI)
│   ├── index.php        # Halaman utama (Read & Search)
│   ├── create.php       # Form & pemrosesan Tambah Produk (PRG)
│   ├── edit.php         # Form & pemrosesan Edit Produk
│   └── delete.php       # Pemrosesan Hapus Produk (CSRF Protected)
└── database/
    └── store_db.sql     # File skema database & tabel


Cara Menjalankan Aplikasi di Localhost
1. Prasyarat
XAMPP / WAMP / Laragon (PHP >= 7.4 & MySQL/MariaDB)
Web Browser (Chrome, Edge, Firefox, dll.)
2. Langkah Instalasi
Jalankan Apache dan MySQL pada XAMPP Control Panel.
Salin (copy) folder proyek ini ke dalam direktori htdocs XAMPP:
C:\xampp\htdocs\product-manager
Buka phpMyAdmin di browser (http://localhost/phpmyadmin).
Buat database baru dengan nama store_db.
Import file SQL yang berada di database/store_db.sql ke dalam database store_db.
Akses aplikasi melalui URL berikut:
http://localhost/product-manager/public/index.php

Teknologi yang Digunakan
PHP Native (Prepared Statements PDO, Sessions, Token CSRF)
MySQL / MariaDB
HTML5 & CSS3 (Flexbox & CSS Grid)
FontAwesome (Ikon UI)

