# 🚀 Panduan Menjalankan Website - Getse Elektronik (DewiElektro)

Panduan ini berisi langkah-langkah lengkap untuk memasang dan menjalankan website **Getse Elektronik (DewiElektro)** di lingkungan lokal Anda. Proyek ini dibangun menggunakan **Laravel 12** dan **Vite** dengan sistem otomatisasi setup yang praktis.

---

## 📋 Prasyarat Sistem
Sebelum memulai, pastikan komputer Anda sudah terpasang:
*   **PHP (Minimal versi 8.2)**
*   **Composer** (Manajer Dependensi PHP)
*   **Node.js & npm** (Untuk kompilasi aset frontend)
*   **MySQL atau MariaDB** (Sebagai database server, misalnya melalui Laragon, XAMPP, atau instalasi mandiri)

---

## ⚙️ Langkah-Langkah Instalasi

Ikuti 5 langkah mudah berikut untuk mempersiapkan website:

### 1. Buat Database MySQL
1. Buka database manager Anda (phpMyAdmin, Laragon, DBeaver, dll.).
2. Buat database baru dengan nama:
   ```sql
   dewi_ecommerce
   ```

### 2. Salin dan Sesuaikan Konfigurasi Environment (`.env`)
1. Proyek ini membutuhkan file `.env` untuk konfigurasi koneksi database.
2. Jika file `.env` belum ada, sistem setup akan otomatis menyalin dari `.env.example`.
3. Buka file `.env` di text editor Anda dan pastikan konfigurasi database sudah benar:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=dewi_ecommerce
   DB_USERNAME=root
   DB_PASSWORD=
   ```
   *(Sesuaikan `DB_USERNAME` dan `DB_PASSWORD` sesuai dengan konfigurasi server MySQL lokal Anda).*

### 3. Jalankan Otomatisasi Setup Proyek
Proyek ini sudah dilengkapi dengan script setup sekali-klik yang sangat praktis. Buka terminal/command prompt di direktori proyek, lalu jalankan:

```bash
composer run setup
```

**Apa saja yang dilakukan oleh perintah di atas secara otomatis?**
1. Menginstal seluruh dependensi PHP via **Composer** (`composer install`).
2. Membuat file `.env` jika belum ada.
3. Membuat Application Key unik Laravel (`php artisan key:generate`).
4. Menjalankan migrasi database (`php artisan migrate --force`).
5. Menginstal dependensi frontend via **npm** (`npm install`).
6. Membangun aset produksi frontend (`npm run build`).

---

### 4. Isi Database dengan Data Awal (Seeding)
Agar website tidak kosong dan langsung terisi dengan produk, kategori, brand, serta akun demo, jalankan perintah seeder berikut di terminal:

```bash
php artisan db:seed
```

#### 🔑 Akun Demo Hasil Seeder
Setelah berhasil melakukan seeding, Anda dapat masuk menggunakan akun berikut:

| Peran (Role) | Email | Password | Kegunaan |
| :--- | :--- | :--- | :--- |
| **Administrator** | `admin@dewielektro.com` | `password` | Mengelola produk, kategori, pesanan, dll. |
| **Customer** | `budi@example.com` | `password` | Simulasi belanja di website |

---

## 🏃‍♂️ Cara Menjalankan Website (Development Mode)

Untuk mulai menjalankan website dalam mode pengembangan secara bersamaan (server backend + frontend Vite compiler + queue worker + real-time logs), jalankan satu perintah cerdas berikut di terminal:

```bash
composer run dev
```

> [!TIP]
> Perintah `composer run dev` ini menggunakan package `concurrently` untuk menjalankan 4 proses sekaligus dalam satu terminal:
> *   **php artisan serve** (Menjalankan web server Laravel di `http://localhost:8000`)
> *   **npm run dev** (Menjalankan Vite dev server untuk pembaruan instan/hot-reload aset frontend)
> *   **php artisan queue:listen** (Mendengarkan antrean tugas latar belakang seperti pengiriman email)
> *   **php artisan pail** (Mencetak log error secara real-time langsung ke terminal Anda)

Setelah dijalankan, buka browser kesayangan Anda dan akses:
👉 **[http://localhost:8000](http://localhost:8000)**

---

## 🛠️ Pemecahan Masalah (Troubleshooting)

### 1. Error: `composer : The term 'composer' is not recognized`
Error ini terjadi karena Composer belum terpasang secara global di Windows atau belum terdaftar di Environment Path Anda.
*   **Solusi Cepat (Menggunakan `composer.phar` Lokal):**
    Saya telah mengunduh berkas `composer.phar` resmi dan meletakkannya langsung di dalam folder proyek Anda (`c:\dewi\composer.phar`). Anda tidak perlu menginstal composer secara global. Cukup gunakan awalan **`php composer.phar`** untuk menggantikan perintah `composer`.
    *   *Sebelumnya:* `composer run setup` ➡️ *Menjadi:* `php composer.phar run setup`
    *   *Sebelumnya:* `composer run dev` ➡️ *Menjadi:* `php composer.phar run dev`
*   **Solusi Permanen (Sangat Direkomendasikan):**
    1. Unduh installer resmi **Composer-Setup.exe** dari [getcomposer.org](https://getcomposer.org/download/).
    2. Jalankan instalasi dan arahkan ke lokasi file `php.exe` terbaru Anda.
    3. Setelah selesai, tutup dan buka kembali VS Code / terminal Anda agar perubahan aktif secara global.

---

### 2. Error: `Composer detected issues in your platform: Your Composer dependencies require a PHP version ">= 8.2.0". You are running 8.0.25.`
Laravel 12 (versi terbaru yang digunakan oleh website ini) mewajibkan **PHP 8.2.0 atau lebih baru**. Saat ini komputer Anda mendeteksi PHP bawaan XAMPP versi lama (8.0.25).
*   **Opsi A (Sangat Direkomendasikan untuk Laravel di Windows): Beralih ke Laragon**
    Laragon adalah alternatif XAMPP yang sangat modern, ringan, dan cepat untuk pengembangan Laravel di Windows. Ia otomatis menyertakan PHP terbaru dan Composer siap pakai.
    1. Unduh Laragon Full di [laragon.org/download](https://laragon.org/download/).
    2. Pindahkan folder proyek Anda dari `c:\dewi` ke `C:\laragon\www\dewi`.
    3. Jalankan Laragon, klik **Start All**, lalu buka terminal dari tombol terminal Laragon.
*   **Opsi B: Perbarui XAMPP Anda ke Versi Terbaru**
    1. Backup folder `C:\xampp\htdocs` dan ekspor database penting Anda dari phpMyAdmin.
    2. Unduh dan instal XAMPP versi terbaru dengan PHP 8.2 atau 8.3 dari [apachefriends.org](https://www.apachefriends.org/download.html).
*   **Opsi C: Perbarui Versi PHP pada XAMPP Secara Manual**
    1. Unduh file zip PHP 8.2/8.3 Windows Thread Safe dari [windows.php.net/download](https://windows.php.net/download/).
    2. Masuk ke folder XAMPP Anda, ubah nama folder `C:\xampp\php` lama menjadi `C:\xampp\php_old`.
    3. Buat folder baru `C:\xampp\php` dan ekstrak isi file zip PHP baru ke dalamnya.
    4. Salin file `php.ini` dari `php_old` ke `php` baru, lalu buka file tersebut dan pastikan ekstensi penting telah diaktifkan dengan menghapus tanda titik koma (`;`) di awal baris:
       `extension=pdo_mysql`, `extension=openssl`, `extension=mbstring`, `extension=curl`, `extension=fileinfo`.

---

### 3. Masalah Lainnya
*   **Error: Database `dewi_ecommerce` tidak ditemukan**
    *   *Solusi:* Pastikan Anda telah membuat database di MySQL dengan nama `dewi_ecommerce` di phpMyAdmin sebelum menjalankan `php composer.phar run setup` atau `php artisan migrate`.
*   **Error port 8000 sedang digunakan**
    *   *Solusi:* Laravel akan otomatis menggunakan port berikutnya (misalnya `8001`). Perhatikan output di terminal Anda untuk melihat URL port yang aktif.
*   **Ingin menjalankan server backend & Vite secara manual di terminal terpisah?**
    *   Terminal 1 (Backend): `php artisan serve`
    *   Terminal 2 (Frontend): `npm run dev`
