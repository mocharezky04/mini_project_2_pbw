# Portfolio Website - Mochammad Rezky Ramadhan

## Tampilan Section
1. Home (Hero Section)
   - Foto profile
   - Nama dan deskripsi
   - Tombol Instagram & LinkedIn
<p align="center">
  <img src="https://github.com/user-attachments/assets/da213778-a6f5-4383-82ed-db62e1bd498c" width="600"/>
</p>

2. About Me
   - Deskripsi diri
   - Skills dengan progress bar
   - Pengalaman organisasi dan project
<p align="center">
  <img src="https://github.com/user-attachments/assets/b0e86d66-2362-4c8d-a114-8a16b831696d" width="600"/>
</p>

3. Certificates
   - Sertifikat dalam bentuk card layout grid
<p align="center">
  <img src="https://github.com/user-attachments/assets/3fa56b2b-7450-489f-bd52-1b4aea8caaea" width="600"/>
</p>

4. Admin Page
   - Form tambah skill, experience, dan certificate
   - List data dengan tombol hapus
<p align="center">
  <img src="https://github.com/user-attachments/assets/3689a247-5f70-4c97-b914-8180fd7385a8" width="600"/>
</p>

## Penjelasan Code Setiap Section/Fitur

### 1. Navbar (`index.php`)
- Menampilkan nama pemilik portfolio dan menu navigasi:
  - `Home`
  - `About Me`
  - `Certificates`
- Setiap menu menggunakan anchor link ke section dengan `id` terkait (`#home`, `#about`, `#certificates`).
- Navbar bersifat fixed di atas saat halaman di-scroll.

### 2. Hero Section (`index.php`)
- Section utama perkenalan diri.
- Menampilkan:
  - Foto profil
  - Nama lengkap
  - Role/tujuan karier
  - Deskripsi singkat
- Terdapat tombol sosial media:
  - Instagram
  - LinkedIn
- Tombol sosial media menggunakan Bootstrap Icons.

### 3. About Me Section (`index.php`)
- Berisi deskripsi singkat latar belakang dan minat.
- Dibagi menjadi dua kolom:
  - Kolom kiri: `Skills` (dengan progress bar)
  - Kolom kanan: `Experience` (daftar pengalaman/proyek)

### 4. Skills Feature (`index.php`)
- Setiap skill menampilkan persentase kemampuan lewat progress bar.
- Persentase ditampilkan dengan:
  - lebar bar (`data-pct`)
  - teks persentase di header skill
- Skill contoh:
  - Python & Java
  - SOC Analyst
  - Web Penetration

### 5. Experience Feature (`index.php`)
- Berupa daftar pengalaman dan proyek.
- Contoh isi pengalaman:
  - Organisasi
  - Proyek Python
  - Proyek Java (EnergiSense)
  - Rencana belajar Blue Team SOC Analyst
  - Pembelajaran Flutter/Dart dan HTML/CSS

### 6. Certificates Section (`index.php`)
- Menampilkan kartu sertifikat dalam grid.
- Setiap card terdiri dari:
  - Gambar sertifikat
  - Judul sertifikat
  - Deskripsi singkat

### 7. Admin Page (`admin.php`)
- Halaman khusus untuk mengelola data portfolio (tambah/hapus).
- Fitur yang tersedia:
  - Tambah Skill
  - Tambah Experience
  - Tambah Certificate (upload gambar)
  - Hapus Skill/Experience/Certificate
- Setelah aksi berhasil/gagal, muncul notifikasi (toast) di halaman admin.
- Proses tambah/hapus ditangani oleh file `actions/aksi_*.php` dan koneksi DB ada di `config/koneksi.php`.

### 8. Footer (`index.php`)
- Bagian penutup halaman.
- Memuat copyright dan identitas pemilik portfolio.

## Penjelasan CSS (`style.css`)

### 1. Global Style
- `body`:
  - Mengatur font utama menggunakan `Outfit` dan `Share Tech Mono`.
  - Mengaktifkan `scroll-behavior: smooth` agar perpindahan antar section lebih halus.

### 2. Hero Style
- Hero dibuat full layar (`min-height: 100vh`) dengan tampilan dark-cyber.
- Elemen hero memakai animasi reveal dan efek glow.

### 3. Profile Image Style
- Foto profil berbentuk lingkaran.
- Terdapat ring animasi dan fallback avatar bila gambar gagal dimuat.

### 4. Section Spacing
- Setiap section memiliki padding agar konten tidak tertutup navbar fixed.

### 5. Certificate Image Style
- Gambar di card sertifikat dibuat proporsional dengan `object-fit: cover`.

## Teknologi yang Digunakan
- PHP
- MySQL
- CSS
- Bootstrap Icons

## Struktur Folder
- `index.php`, `admin.php`, `style.css`, `script.js` (root)
- `images/` aset gambar
- `actions/` file aksi tambah/hapus (`aksi_*.php`)
- `config/` konfigurasi DB (`koneksi.php`)
- `db/` file SQL (`db_web_porto.sql`)
