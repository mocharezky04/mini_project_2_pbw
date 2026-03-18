# Portfolio Website - Mochammad Rezky Ramadhan

## Tampilan Section

### 1. Home (Hero Section)
- Loading screen terminal saat pertama buka halaman
- Particle network background (canvas animasi)
- Status badge "Available for Opportunities"
- Floating badges melayang di sekitar foto profil
- Foto profil dengan double spinning ring animasi
- Nama dengan efek glitch saat hover
- Typed terminal text yang berketik otomatis
- Tombol Instagram & LinkedIn dengan magnetic effect
- Stats row (count-up animasi): Experiences, Certificates, Skills Tracked
<p align="center">
  <img src="https://github.com/user-attachments/assets/da213778-a6f5-4383-82ed-db62e1bd498c" width="600"/>
</p>

### 2. About Me
- Deskripsi diri diambil dari database (tabel `profile`)
- Skills dengan animated progress bar (animasi saat masuk viewport)
- Panel Experience dengan bullet glowing
- Panel Tools & Tech berisi chip interaktif (Linux, Wireshark, Nmap, Splunk, dll)
<p align="center">
  <img src="https://github.com/user-attachments/assets/b0e86d66-2362-4c8d-a114-8a16b831696d" width="600"/>
</p>

### 3. Certificates
- Sertifikat dalam bentuk card layout grid
- Setiap card punya shimmer/shine effect saat hover
- Data diambil dari database (tabel `certificates`)
<p align="center">
  <img src="https://github.com/user-attachments/assets/3fa56b2b-7450-489f-bd52-1b4aea8caaea" width="600"/>
</p>

### 4. Admin Page
- Form tambah Skill, Experience, dan Certificate (upload file gambar)
- List data dengan tombol hapus + konfirmasi dialog
- Toast notification muncul setelah aksi berhasil/gagal
- Tema dark konsisten dengan halaman utama
<p align="center">
  <img src="https://github.com/user-attachments/assets/3689a247-5f70-4c97-b914-8180fd7385a8" width="600"/>
</p>

---
 
## Penjelasan Code Setiap Section/Fitur
 
### 1. Navbar (`index.php`)
- Navbar fixed dengan `backdrop-filter: blur` agar transparan saat di-scroll
- Menampilkan nama pemilik portfolio dan menu navigasi: Home, About, Certs, Admin
- Setiap menu menggunakan anchor link ke section dengan `id` terkait
- **Scrollspy**: link navbar auto-highlight sesuai section yang sedang dilihat menggunakan `IntersectionObserver` di `script.js`
- Active state ditandai dengan dot glowing di bawah link
 
### 2. Hero Section (`index.php`)
- Section utama full layar (`min-height: 100vh`) dengan dark cybersecurity theme
- Data nama, role, dan deskripsi diambil dari tabel `profile` di database
- Tombol Instagram & LinkedIn diambil dari tabel `social_links` di database
- Foto profil menggunakan `onerror` fallback ke inisial nama bila gambar gagal dimuat
- Efek glitch pada nama menggunakan CSS `::before` dan `::after` dengan `clip-path`
- Floating badges (CTF Player, Blue Team, Linux User, SOC Learner) dengan animasi `translateY` berbeda tiap badge
 
### 3. Loading Screen (`index.php` + `script.js`)
- Splash screen muncul saat halaman pertama dibuka
- Progress bar dan persentase naik dari 0% ke 100% secara animasi
- Hilang otomatis setelah halaman selesai load menggunakan event `window.load`
 
### 4. Particle Network (`script.js`)
- Canvas HTML5 fullscreen fixed di background
- 90 titik partikel bergerak acak dan terhubung dengan garis tipis bila jaraknya < 130px
- Warna cyan `rgba(0,200,255)` menyesuaikan tema
 
### 5. Custom Cursor (`script.js` + `style.css`)
- Cursor default disembunyikan (`cursor: none`)
- Diganti dengan dot cyan kecil + ring transparan yang mengikuti mouse
- Ring menggunakan efek lag/lerp (linear interpolation) agar gerakannya halus
- Membesar otomatis saat hover link atau button menggunakan CSS `:has()`
- Dinonaktifkan di perangkat mobile/touchscreen
 
### 6. Scroll Progress Bar (`script.js` + `style.css`)
- Garis tipis 2px di paling atas halaman
- Memanjang dari kiri ke kanan seiring halaman di-scroll
- Warna gradient cyan ke green dengan glow effect
 
### 7. About Me Section (`index.php`)
- Data deskripsi diambil dari kolom `about` di tabel `profile`
- Dibagi menjadi dua panel: Skills (kiri) dan Experience (kanan)
- Panel Tools & Tech berisi chip-chip tool yang hardcode di `$tools` array di PHP
 
### 8. Skills Feature (`index.php` + `script.js`)
- Data skill diambil dari tabel `skills` di database
- Progress bar width dianimasikan dari 0 ke target saat panel masuk viewport menggunakan `IntersectionObserver`
- Ada glowing dot di ujung kanan setiap bar
- Warna bar dipetakan dari `color_class` di DB ke class CSS (`f-blue`, `f-cyan`, dll)
 
### 9. Stats Row (`index.php` + `script.js`)
- Menampilkan 3 angka: jumlah Experience, Certificate, dan Skills dari database menggunakan `count()`
- Animasi count-up dari 0 ke angka target saat masuk viewport
- Hover effect: garis gradient muncul di atas dengan `scaleX` transition
 
### 10. Diagonal Section Divider (`index.php` + `style.css`)
- Transisi antar section menggunakan SVG `<path>` diagonal
- Arah bergantian (kiri-ke-kanan dan kanan-ke-kiri) untuk variasi visual
 
### 11. Certificates Section (`index.php`)
- Data sertifikat diambil dari tabel `certificates` di database
- Grid responsif menggunakan `repeat(auto-fill, minmax(220px, 1fr))`
- Shimmer/shine effect saat hover menggunakan `::after` pseudo-element dengan `translateX`
- Fallback placeholder bila gambar tidak ditemukan
 
### 12. Admin Page (`admin.php`)
- Halaman khusus mengelola data portfolio (tambah/hapus Skill, Experience, Certificate)
- Setiap aksi diproses oleh file terpisah di folder `actions/`
- Status aksi dikirim via URL query `?status=` dan ditampilkan sebagai toast notification
- Toast muncul dengan animasi slide-down dan hilang otomatis setelah 3.2 detik
- Upload gambar certificate ditangani oleh `aksi_tambah_certificate.php` dengan validasi ekstensi (`jpg`, `jpeg`, `png`, `webp`) dan penamaan file acak menggunakan `bin2hex(random_bytes(4))`
- Custom file input: input asli disembunyikan, diganti label custom yang menampilkan nama file dipilih via JavaScript
 
### 13. Magnetic Buttons (`script.js`)
- Tombol Instagram & LinkedIn di hero section mengikuti posisi mouse saat dihover
- Menggunakan `getBoundingClientRect()` untuk menghitung offset dan `transform: translate()` untuk menggeser tombol
- Kembali ke posisi semula dengan spring effect `cubic-bezier(.34,1.56,.64,1)` saat mouse keluar
- Dinonaktifkan di perangkat touchscreen
 
### 14. Scroll Reveal (`script.js` + `style.css`)
- Semua card dan panel di-render dengan `opacity: 0` dan `translateY(24px)`
- Menjadi visible saat masuk viewport menggunakan `IntersectionObserver`
- Setiap elemen punya `transition-delay` berbeda untuk efek staggered
 
### 15. Footer (`index.php`)
- Data social links diambil dari tabel `social_links` di database menggunakan `foreach`
- Icon dirender dari kolom `icon_class` (Bootstrap Icons class)
- Link GitHub profile menggunakan URL langsung ke profil GitHub Saya, membuka tab baru dengan target="_blank"

---
 
## Penjelasan CSS (`style.css`)
 
### 1. CSS Variables & Global Style
- Semua warna didefinisikan sebagai CSS custom properties di `:root` (`--bg`, `--accent`, `--accent2`, dll)
- Font utama `Outfit` untuk body, `Share Tech Mono` untuk elemen terminal/mono
- `scroll-behavior: smooth` untuk perpindahan section yang halus
 
### 2. Loading Screen Style
- `.loader-box::before` — garis animasi yang berjalan dari kiri ke kanan (`loaderLine` keyframe)
- `.loader-fill` — progress bar dengan `transition: width 0.08s linear`
 
### 3. Custom Cursor Style
- `#cursor-dot` dan `#cursor-ring` dengan `position: fixed` dan `pointer-events: none`
- `body:has(a:hover)` selector untuk membesar saat hover link
 
### 4. Noise Texture & Scanlines
- `body::before` — SVG inline fractalNoise dengan opacity 0.03 sebagai grain texture
- `body::after` — `repeating-linear-gradient` 4px untuk efek scanlines monitor CRT
 
### 5. Hero & Floating Badges
- `.profile-ring::before` dan `::after` — dua ring berputar berlawanan arah dengan `animation: spin`
- `.fb1` sampai `.fb4` — masing-masing badge punya keyframe float berbeda (`floatBadge1` sampai `floatBadge4`)
- `.glitch::before/after` — efek glitch dengan `clip-path` dan `steps(2)` animation
 
### 6. Skill Bar
- `.skill-fill` — `width: 0` default, diset via JavaScript saat viewport
- `::after` pseudo-element sebagai glowing dot di ujung bar
 
### 7. Certificate Card
- `.cert-card::after` — shimmer effect dengan `translateX(-120%)` ke `translateX(120%)` saat hover
- `transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1)` untuk bounce effect saat hover
 
### 8. Admin Page Style
- Semua style admin di-scope dengan `body.admin-page` untuk menghindari konflik dengan halaman utama
- Custom file input menggunakan `.file-input` wrapper dengan input asli `display: none`
- Toast notification dengan `opacity: 0` default dan class `.show`/`.hide` untuk animasi

---
 
## Penjelasan JavaScript (`script.js`)
 
### 1. Loading Screen
- `setInterval` menaikkan nilai `n` secara random setiap 80ms hingga 99%
- Saat `window.load` event, langsung set 100% dan tambah class `.hide` ke `#loader`
 
### 2. Custom Cursor (Lerp)
- `mousemove` event listener menggerakkan dot secara langsung
- Ring menggunakan linear interpolation: `rx += (targetX - rx) * 0.12` di setiap frame `requestAnimationFrame`
 
### 3. Scroll Progress Bar
- `scroll` event listener menghitung `scrollY / (scrollHeight - innerHeight) * 100`
- Hasilnya di-set sebagai `width` pada `#scroll-bar`
 
### 4. Particle Network
- Array 90 titik dengan posisi, kecepatan, radius, dan opacity random
- `requestAnimationFrame` loop: tiap frame titik bergerak, bila keluar canvas muncul dari sisi lain
- Setiap pasang titik dicek jaraknya, bila < 130px digambar garis dengan opacity proporsional terhadap jarak
 
### 5. Scrollspy Navbar
- `IntersectionObserver` dengan threshold 0.4 mengamati semua `section[id]`
- Saat section masuk viewport, semua link `.active` dihapus lalu link yang sesuai diberi class `.active`
 
### 6. Typed Terminal Text
- Array 5 command hacker yang diketik dan dihapus bergantian secara loop
- Kecepatan mengetik 76ms/karakter, menghapus 38ms/karakter
- Delay 1800ms setelah selesai ketik, 400ms setelah selesai hapus
 
### 7. Scroll Reveal
- `IntersectionObserver` threshold 0.12 mengamati semua elemen `.reveal`
- Saat masuk viewport, class `.visible` ditambahkan yang men-trigger CSS transition
 
### 8. Skill Bar Animation
- `IntersectionObserver` threshold 0.25 mengamati `#skill-panel`
- Saat masuk viewport, semua `.skill-fill` di dalamnya di-set `width` dari `data-pct` attribute
 
### 9. Count-Up Stats
- `IntersectionObserver` threshold 0.4 mengamati `.stat-item`
- `setInterval` menaikkan angka dari 0 ke `data-target` dengan step `ceil(target/40)`
 
### 10. Magnetic Buttons
- `mousemove` menghitung offset dari tengah tombol dan mengaplikasikan `transform: translate()`
- `mouseleave` mereset transform dengan spring easing `cubic-bezier(.34,1.56,.64,1)`
 
---

## Teknologi yang Digunakan
- **PHP** — server-side rendering, koneksi database, logika tambah/hapus data
- **MySQL** — penyimpanan data profil, skills, experience, certificates, social links
- **JavaScript (Vanilla JS)** — animasi interaktif: particles, cursor, typed text, scroll reveal, count-up, magnetic buttons
- **CSS (Custom)** — dark cyber theme, animasi keyframe, CSS variables, responsive design
- **Bootstrap 5** — layouting di halaman admin (grid system, utilities)
- **Bootstrap Icons** — icon set untuk tombol, navbar, dan admin panel
- **Google Fonts** — Outfit (body) & Share Tech Mono (terminal/mono elements)
 
---

## Struktur Repo
```text
├── index.php
├── admin.php
├── style.css
├── script.js
├── images/
├── actions/
│   ├── aksi_tambah_skill.php
│   ├── aksi_hapus_skill.php
│   ├── aksi_tambah_experience.php
│   ├── aksi_hapus_experience.php
│   ├── aksi_tambah_certificate.php
│   └── aksi_hapus_certificate.php
├── config/
│   └── koneksi.php
└── db/
    └── db_web_porto.sql
```

---

## Cara Menjalankan

### Requirement
- [Laragon](https://laragon.org/)
- PHP
- MySQL / MariaDB

### Langkah-langkah

**1. Clone repository**
```bash
git clone https://github.com/mocharezky04/mini_project_2_pbw.git
```

**2. Pindahkan ke folder Laragon**

Taruh folder hasil clone di:
```
C:/laragon/www/
```

**3. Import database**
- Buka `http://localhost/phpmyadmin`
- Buat database baru bernama `web_porto`
- Pilih database `web_porto` → klik tab **Import**
- Upload file `db/db_web_porto.sql`
- Upload file `db/db_web_porto_updated.sql` untuk melihat update (sebenarnya yang updated cuma saya mencoba nambah sertifikat apakah berhasil atau tidak)

**4. Sesuaikan koneksi database**

Buka file `config/koneksi.php`, pastikan isinya sesuai:
```php
$host   = "localhost";
$user   = "root";
$pass   = "";          // kosong jika tidak ada password
$dbname = "web_porto";
```

**5. Jalankan website**
- Pastikan Laragon sudah running (Apache + MySQL)
- Buka browser dan akses:
```
http://localhost/mini_project_2_pbw/
```

**6. Akses halaman admin**
```
http://localhost/mini_project_2_pbw/admin.php
```

---
