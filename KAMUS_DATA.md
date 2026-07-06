# 📖 Kamus Data Database - Getse Elektronik (DewiElektro)

Dokumen ini berisi spesifikasi teknis dan rincian kamus data untuk seluruh tabel yang digunakan dalam sistem basis data e-commerce **Getse Elektronik (DewiElektro)**.

---

## 📂 1. Kelompok Pengguna & Keamanan

### Tabel `users`
Tabel ini digunakan untuk menyimpan informasi seluruh pengguna website, baik pelanggan (*customer*) maupun administrator (*admin*).

| Nama Kolom | Tipe Data | Atribut | Keterangan / Deskripsi |
| :--- | :--- | :--- | :--- |
| `id` | `BigInt` | `PK`, `Auto Increment` | ID unik pengguna. |
| `name` | `Varchar(255)` | `Not Null` | Nama lengkap pengguna. |
| `email` | `Varchar(255)` | `Unique`, `Not Null` | Alamat email (digunakan untuk login). |
| `email_verified_at`| `Timestamp` | `Nullable` | Waktu ketika email diverifikasi oleh pengguna. |
| `password` | `Varchar(255)` | `Not Null` | Hash password pengguna. |
| `role` | `Enum` | `Default: 'customer'` | Peran pengguna: `'customer'` atau `'admin'`. |
| `phone` | `Varchar(20)` | `Nullable` | Nomor telepon/WhatsApp aktif. |
| `address` | `Text` | `Nullable` | Alamat pengiriman utama. |
| `city` | `Varchar(255)` | `Nullable` | Kota atau Kabupaten. |
| `province` | `Varchar(255)` | `Nullable` | Provinsi tempat tinggal. |
| `postal_code` | `Varchar(10)` | `Nullable` | Kode pos alamat. |
| `avatar` | `Varchar(255)` | `Nullable` | Path berkas foto profil pengguna. |
| `remember_token` | `Varchar(100)` | `Nullable` | Token fitur "Ingat Saya" saat login. |
| `created_at` | `Timestamp` | `Nullable` | Waktu pendaftaran akun dibuat. |
| `updated_at` | `Timestamp` | `Nullable` | Waktu pembaruan profil terakhir. |

---

## 📦 2. Kelompok Katalog Produk

### Tabel `categories`
Menyimpan kategori barang elektronik yang tersedia di website (misalnya: Handphone, Laptop, TV).

| Nama Kolom | Tipe Data | Atribut | Keterangan / Deskripsi |
| :--- | :--- | :--- | :--- |
| `id` | `BigInt` | `PK`, `Auto Increment` | ID unik kategori. |
| `name` | `Varchar(255)` | `Not Null` | Nama kategori produk. |
| `slug` | `Varchar(255)` | `Unique`, `Not Null` | Slug URL kategori ramah SEO. |
| `description` | `Text` | `Nullable` | Deskripsi singkat mengenai kategori. |
| `icon` | `Varchar(255)` | `Nullable` | Ikon visual kategori (emoji/class icon). |
| `image` | `Varchar(255)` | `Nullable` | Path gambar kategori. |
| `is_active` | `Boolean` | `Default: true` | Status keaktifan kategori. |
| `sort_order` | `Integer` | `Default: 0` | Urutan penampilan kategori di halaman utama. |
| `created_at` / `updated_at` | `Timestamp` | `Nullable` | Waktu data dibuat & diperbarui. |

### Tabel `brands`
Menyimpan merek/produsen dari produk elektronik (misalnya: Samsung, Apple, Xiaomi, ASUS).

| Nama Kolom | Tipe Data | Atribut | Keterangan / Deskripsi |
| :--- | :--- | :--- | :--- |
| `id` | `BigInt` | `PK`, `Auto Increment` | ID unik merek. |
| `name` | `Varchar(255)` | `Not Null` | Nama merek (*Brand*). |
| `slug` | `Varchar(255)` | `Unique`, `Not Null` | Slug URL merek untuk SEO. |
| `logo` | `Varchar(255)` | `Nullable` | Path berkas logo merek. |
| `description` | `Text` | `Nullable` | Penjelasan ringkas merek. |
| `is_active` | `Boolean` | `Default: true` | Status aktif/tidaknya merek tersebut. |
| `created_at` / `updated_at` | `Timestamp` | `Nullable` | Waktu data dibuat & diperbarui. |

### Tabel `products`
Tabel inti yang memuat seluruh spesifikasi utama, harga, dan jumlah stok barang.

| Nama Kolom | Tipe Data | Atribut | Keterangan / Deskripsi |
| :--- | :--- | :--- | :--- |
| `id` | `BigInt` | `PK`, `Auto Increment` | ID unik produk. |
| `category_id` | `BigInt` | `FK (categories.id)`, `Not Null` | Kategori produk (Terhapus otomatis jika kategori dihapus). |
| `brand_id` | `BigInt` | `FK (brands.id)`, `Nullable` | Merek produk (Set Null jika merek dihapus). |
| `name` | `Varchar(255)` | `Not Null` | Nama lengkap produk elektronik. |
| `slug` | `Varchar(255)` | `Unique`, `Not Null` | Slug URL unik produk untuk navigasi SEO. |
| `short_description` | `Text` | `Nullable` | Rangkuman singkat produk (untuk card view). |
| `description` | `LongText` | `Nullable` | Spesifikasi dan rincian lengkap produk. |
| `price` | `Decimal(15,2)`| `Not Null` | Harga normal/dasar barang. |
| `sale_price` | `Decimal(15,2)`| `Nullable` | Harga promo/diskon (jika ada). |
| `stock` | `Integer` | `Default: 0` | Jumlah stok barang saat ini. |
| `low_stock_threshold`| `Integer` | `Default: 5` | Ambang batas peringatan stok menipis. |
| `sku` | `Varchar(255)` | `Unique`, `Nullable` | Kode unik inventaris (*Stock Keeping Unit*). |
| `weight` | `Decimal(10,2)`| `Nullable` | Berat barang (dalam gram atau kilogram). |
| `status` | `Enum` | `Default: 'active'` | Status produk: `'active'`, `'inactive'`, `'out_of_stock'`, `'discontinued'`. |
| `condition` | `Enum` | `Default: 'new'` | Kondisi fisik produk: `'new'` (baru), `'second'`, `'refurbished'`. |
| `instagram_url` | `Varchar(255)` | `Nullable` | Link tautan postingan produk di Instagram. |
| `views` | `Integer` | `Default: 0` | Berapa kali halaman produk dilihat pengunjung. |
| `is_featured` | `Boolean` | `Default: false` | Menandai produk sebagai rekomendasi/unggulan. |
| `created_at` / `updated_at` | `Timestamp` | `Nullable` | Waktu data dibuat & diperbarui. |
| `deleted_at` | `Timestamp` | `Nullable` | Mendukung *Soft Delete* (penghapusan sementara). |

### Tabel `product_images`
Menyimpan gambar visual pendukung produk. Satu produk bisa memiliki banyak gambar (*One-to-Many*).

| Nama Kolom | Tipe Data | Atribut | Keterangan / Deskripsi |
| :--- | :--- | :--- | :--- |
| `id` | `BigInt` | `PK`, `Auto Increment` | ID unik gambar produk. |
| `product_id` | `BigInt` | `FK (products.id)`, `Not Null`| Terhubung ke produk utama terkait. |
| `image_path` | `Varchar(255)` | `Not Null` | Path direktori penyimpanan berkas gambar. |
| `alt_text` | `Varchar(255)` | `Nullable` | Keterangan teks alternatif gambar (SEO). |
| `is_primary` | `Boolean` | `Default: false` | Menandai gambar utama/cover depan produk. |
| `sort_order` | `Integer` | `Default: 0` | Urutan tampilan galeri gambar. |

### Tabel `product_specs`
Tabel dinamis dengan skema *Key-Value* untuk menyimpan detail teknis produk yang bervariasi (contoh RAM, Chipset, Kapasitas Baterai).

| Nama Kolom | Tipe Data | Atribut | Keterangan / Deskripsi |
| :--- | :--- | :--- | :--- |
| `id` | `BigInt` | `PK`, `Auto Increment` | ID unik baris spesifikasi. |
| `product_id` | `BigInt` | `FK (products.id)`, `Not Null`| Terhubung ke produk utama terkait. |
| `spec_key` | `Varchar(255)` | `Not Null` | Nama spesifikasi (contoh: `"Baterai"`, `"RAM"`). |
| `spec_value` | `Varchar(255)` | `Not Null` | Nilai/Isi spesifikasi (contoh: `"5000 mAh"`, `"8 GB"`). |
| `sort_order` | `Integer` | `Default: 0` | Urutan penampilan baris spesifikasi. |

### Tabel `warranties`
Menyimpan ketentuan garansi bawaan produk saat dibeli.

| Nama Kolom | Tipe Data | Atribut | Keterangan / Deskripsi |
| :--- | :--- | :--- | :--- |
| `id` | `BigInt` | `PK`, `Auto Increment` | ID unik garansi. |
| `product_id` | `BigInt` | `FK (products.id)`, `Not Null`| Terhubung ke produk terkait. |
| `type` | `Enum` | `Default: 'store'` | Jenis garansi: `'store'` (toko), `'supplier'`, `'official'` (resmi). |
| `duration_days` | `Integer` | `Not Null` | Durasi jaminan garansi dalam hitungan hari. |
| `duration_label` | `Varchar(255)` | `Not Null` | Label durasi (contoh: `"1 Tahun Garansi Resmi"`). |
| `description` | `Text` | `Nullable` | Deskripsi cakupan bagian yang digaransi. |
| `terms` | `Text` | `Nullable` | Syarat & ketentuan pengajuan klaim garansi. |

---

## 🛒 3. Kelompok Transaksi Penjualan & Pemesanan

### Tabel `orders`
Tabel induk transaksi yang menampung total pembayaran, data kurir logistik, dan alamat pengiriman customer.

| Nama Kolom | Tipe Data | Atribut | Keterangan / Deskripsi |
| :--- | :--- | :--- | :--- |
| `id` | `BigInt` | `PK`, `Auto Increment` | ID unik pesanan. |
| `user_id` | `BigInt` | `FK (users.id)`, `Not Null` | Pembeli (User tipe customer). |
| `order_number` | `Varchar(255)` | `Unique`, `Not Null` | Kode unik faktur/pesanan (contoh: `ORD-YYYYMMDD-XXXX`). |
| `status` | `Enum` | `Default: 'pending'` | Status proses: `'pending'`, `'awaiting_payment'`, `'payment_verification'`, `'processing'`, `'shipped'`, `'delivered'`, `'completed'`, `'cancelled'`, `'refunded'`. |
| `subtotal` | `Decimal(15,2)`| `Not Null` | Total harga seluruh barang sebelum ongkir & diskon. |
| `shipping_cost` | `Decimal(15,2)`| `Default: 0` | Biaya ongkos kirim. |
| `discount` | `Decimal(15,2)`| `Default: 0` | Nominal pemotongan harga (jika ada promo). |
| `total` | `Decimal(15,2)`| `Not Null` | Total bersih yang wajib dibayar (`subtotal + shipping_cost - discount`). |
| `shipping_name` | `Varchar(255)` | `Not Null` | Nama lengkap penerima paket. |
| `shipping_phone`| `Varchar(20)` | `Not Null` | Nomor telepon penerima paket. |
| `shipping_address`| `Text` | `Not Null` | Alamat lengkap tujuan pengiriman paket. |
| `shipping_city` | `Varchar(255)` | `Not Null` | Kota/Kabupaten tujuan pengiriman. |
| `shipping_province`| `Varchar(255)`| `Not Null` | Provinsi tujuan. |
| `shipping_postal_code`| `Varchar(10)`| `Not Null` | Kode pos tujuan. |
| `shipping_courier`| `Varchar(255)`| `Nullable` | Ekspedisi yang digunakan (contoh: JNE, J&T). |
| `tracking_number`| `Varchar(255)` | `Nullable` | Nomor resi pelacakan kurir logistik. |
| `notes` | `Text` | `Nullable` | Catatan khusus dari pembeli untuk kurir/toko. |
| `paid_at` / `shipped_at` / `delivered_at` / `completed_at` / `cancelled_at` | `Timestamp` | `Nullable` | Jejak waktu perubahan status alur pesanan. |

### Tabel `order_items`
Tabel rincian detail barang belanjaan di dalam suatu pesanan (*Many-to-One* ke `orders`).

| Nama Kolom | Tipe Data | Atribut | Keterangan / Deskripsi |
| :--- | :--- | :--- | :--- |
| `id` | `BigInt` | `PK`, `Auto Increment` | ID rincian item. |
| `order_id` | `BigInt` | `FK (orders.id)`, `Not Null` | Relasi ke data pesanan induk. |
| `product_id` | `BigInt` | `FK (products.id)`, `Not Null` | Relasi ke data produk yang dibeli. |
| `product_name` | `Varchar(255)` | `Not Null` | Nama produk saat dibeli (disalin untuk menghindari perubahan nama produk di masa depan mempengaruhi riwayat nota). |
| `price` | `Decimal(15,2)`| `Not Null` | Harga produk satuan saat transaksi dibuat. |
| `quantity` | `Integer` | `Not Null` | Jumlah unit produk yang dibeli. |
| `subtotal` | `Decimal(15,2)`| `Not Null` | Total perkalian harga barang dengan kuantitas (`price * quantity`). |

---

## 💳 4. Kelompok Pembayaran & Bukti Transfer

### Tabel `payments`
Mendokumentasikan data penagihan transfer bank atau QRIS dari pesanan pembeli.

| Nama Kolom | Tipe Data | Atribut | Keterangan / Deskripsi |
| :--- | :--- | :--- | :--- |
| `id` | `BigInt` | `PK`, `Auto Increment` | ID unik transaksi bayar. |
| `order_id` | `BigInt` | `FK (orders.id)`, `Not Null` | Terhubung ke transaksi pemesanan terkait. |
| `method` | `Enum` | `Default: 'bank_transfer'` | Metode pembayaran: `'bank_transfer'` atau `'qris'`. |
| `bank_name` | `Varchar(255)` | `Nullable` | Nama bank pengirim/asal transfer. |
| `account_number`| `Varchar(255)` | `Nullable` | Nomor rekening asal transfer. |
| `account_name` | `Varchar(255)` | `Nullable` | Nama pemilik rekening asal transfer. |
| `amount` | `Decimal(15,2)`| `Not Null` | Jumlah uang yang dikirimkan. |
| `status` | `Enum` | `Default: 'pending'` | Status pembayaran: `'pending'`, `'uploaded'` (bukti diunggah), `'verified'` (sah), `'rejected'` (ditolak). |
| `admin_notes` | `Text` | `Nullable` | Catatan/pesan admin (contoh: alasan bukti ditolak). |
| `verified_at` | `Timestamp` | `Nullable` | Tanggal verifikasi keabsahan pembayaran. |
| `verified_by` | `BigInt` | `FK (users.id)`, `Nullable` | Petugas admin yang memverifikasi transaksi. |

### Tabel `payment_proofs`
Menyimpan tautan file gambar bukti transfer fisik yang diunggah customer.

| Nama Kolom | Tipe Data | Atribut | Keterangan / Deskripsi |
| :--- | :--- | :--- | :--- |
| `id` | `BigInt` | `PK`, `Auto Increment` | ID unik bukti pembayaran. |
| `payment_id` | `BigInt` | `FK (payments.id)`, `Not Null` | Menunjuk ke baris transaksi pembayaran terkait. |
| `image_path` | `Varchar(255)` | `Not Null` | Jalur direktori penyimpanan foto struk/bukti bayar. |
| `notes` | `Text` | `Nullable` | Keterangan tambahan dari customer saat unggah. |

---

## 🌟 5. Kelompok Ulasan & Rating Pelanggan

### Tabel `reviews`
Menyimpan evaluasi bintang (1-5) dan komentar ulasan pembeli terhadap produk yang telah berhasil dibeli.

| Nama Kolom | Tipe Data | Atribut | Keterangan / Deskripsi |
| :--- | :--- | :--- | :--- |
| `id` | `BigInt` | `PK`, `Auto Increment` | ID unik review. |
| `user_id` | `BigInt` | `FK (users.id)`, `Not Null` | Penulis ulasan (Customer). |
| `product_id` | `BigInt` | `FK (products.id)`, `Not Null` | Produk yang diulas. |
| `order_id` | `BigInt` | `FK (orders.id)`, `Not Null` | Pesanan asal (pembelian nyata barang tersebut). |
| `rating` | `TinyInt` | `Not Null` | Skor ulasan (skala angka 1 s/d 5). |
| `comment` | `Text` | `Nullable` | Isi tulisan ulasan/komentar pembeli. |
| `status` | `Enum` | `Default: 'pending'` | Status tampil ulasan: `'pending'`, `'approved'`, `'rejected'`. |
| `admin_notes` | `Text` | `Nullable` | Catatan dari admin pengelola web. |
| **Constraint Unik**| `[user_id, product_id, order_id]` | `Unique` | Mencegah pembeli mengulas produk yang sama berulang kali di pesanan yang sama. |

### Tabel `review_images`
Menyimpan foto asli (*real-picture*) dari customer saat mengulas barang elektronik.

| Nama Kolom | Tipe Data | Atribut | Keterangan / Deskripsi |
| :--- | :--- | :--- | :--- |
| `id` | `BigInt` | `PK`, `Auto Increment` | ID unik foto ulasan. |
| `review_id` | `BigInt` | `FK (reviews.id)`, `Not Null` | Hubungan ke data induk ulasan. |
| `image_path` | `Varchar(255)` | `Not Null` | Path berkas penyimpanan foto ulasan produk. |

---

## 🛡️ 6. Kelompok Layanan Purnajual (Klaim Garansi)

### Tabel `warranty_claims`
Menampung permintaan perbaikan/klaim unit bermasalah yang diajukan pembeli bergaransi aktif.

| Nama Kolom | Tipe Data | Atribut | Keterangan / Deskripsi |
| :--- | :--- | :--- | :--- |
| `id` | `BigInt` | `PK`, `Auto Increment` | ID unik formulir klaim. |
| `claim_number` | `Varchar(255)` | `Unique`, `Not Null` | Nomor klaim resmi (contoh: `CLM-YYYYMMDD-XXXX`). |
| `user_id` | `BigInt` | `FK (users.id)`, `Not Null` | Pengaju klaim garansi. |
| `order_id` | `BigInt` | `FK (orders.id)`, `Not Null` | Transaksi asal pembelian produk. |
| `product_id` | `BigInt` | `FK (products.id)`, `Not Null` | Barang elektronik yang diklaim bermasalah. |
| `warranty_id` | `BigInt` | `FK (warranties.id)`, `Not Null`| Rujukan jenis garansi yang digunakan saat klaim. |
| `issue_description`| `Text` | `Not Null` | Penjelasan kronologi kerusakan/kendala barang. |
| `status` | `Enum` | `Default: 'submitted'`| Status klaim: `'submitted'` (diajukan), `'under_review'` (ditinjau), `'approved'`, `'rejected'`, `'in_repair'` (sedang diperbaiki), `'completed'`. |
| `admin_notes` | `Text` | `Nullable` | Catatan tinjauan internal tim teknisi/admin. |
| `resolution` | `Text` | `Nullable` | Hasil/solusi keputusan klaim (contoh: Ganti Baru). |
| `resolved_at` | `Timestamp` | `Nullable` | Waktu selesainya proses resolusi garansi. |

### Tabel `warranty_claim_images`
Menyimpan foto dokumentasi kondisi fisik kerusakan produk yang diklaim pembeli.

| Nama Kolom | Tipe Data | Atribut | Keterangan / Deskripsi |
| :--- | :--- | :--- | :--- |
| `id` | `BigInt` | `PK`, `Auto Increment` | ID unik foto kerusakan. |
| `warranty_claim_id`| `BigInt` | `FK (warranty_claims.id)`, `Not Null` | Menunjuk ke berkas klaim garansi terkait. |
| `image_path` | `Varchar(255)` | `Not Null` | Path file bukti foto fisik kerusakan barang. |

---

## ⚙️ 7. Konfigurasi Sistem Dinamis

### Tabel `social_settings`
Menyimpan konfigurasi data statis/sosial toko secara dinamis (sehingga admin bisa merubah nama toko, nomor WhatsApp CS, alamat, atau rekening bank langsung dari dasbor web tanpa merubah kode program).

| Nama Kolom | Tipe Data | Atribut | Keterangan / Deskripsi |
| :--- | :--- | :--- | :--- |
| `id` | `BigInt` | `PK`, `Auto Increment` | ID unik baris pengaturan. |
| `key` | `Varchar(255)` | `Unique`, `Not Null` | Kunci pemanggilan (contoh: `"whatsapp_number"`, `"store_name"`). |
| `value` | `Text` | `Nullable` | Isi data konfigurasi (contoh: `"62812345678"`). |
| `label` | `Varchar(255)` | `Nullable` | Label nama ramah di dashboard admin (contoh: `"Nomor WhatsApp"`). |
| `type` | `Varchar(255)` | `Default: 'text'` | Jenis input form HTML (contoh: `"text"`, `"textarea"`, `"email"`). |

---

## 🔒 8. Tabel Bawaan Sistem Laravel

* **`password_reset_tokens`**: Menyimpan token enkripsi sementara saat pengguna melakukan reset kata sandi lewat email.
* **`sessions`**: Menyimpan sesi enkripsi pengguna yang sedang login aktif (menyimpan info IP Address, User Agent peramban browser, payload sesi, dan waktu aktivitas terakhir).
* **`cache` / `cache_locks`**: Digunakan untuk menyimpan temporary data cache demi mempercepat loading web.
* **`jobs` / `job_batches` / `failed_jobs`**: Digunakan oleh Laravel Queue Worker untuk memproses proses asynchronous di background (seperti mengirim email notifikasi pembelian).

---

*Hak Cipta © 2026 - Getse Elektronik (DewiElektro). Dokumen Teknis Basis Data.*
