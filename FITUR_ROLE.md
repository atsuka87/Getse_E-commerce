# Panduan Hak Akses & Fitur Role Website

Website e-commerce ini menggunakan sistem *Role-Based Access Control* (RBAC) di mana fitur yang bisa diakses oleh pengguna ditentukan berdasarkan peran (*role*) yang mereka miliki. 

Berikut adalah rincian lengkap mengenai batasan akses dan fitur untuk setiap *role*:

---

## 1. Pengunjung Publik (Tanpa Login)
Pengguna yang baru membuka website dan belum melakukan *login* atau pendaftaran akun.
- **Melihat Katalog Produk**: Dapat melihat daftar semua produk, mencari produk, dan melihat detail produk (harga, gambar, deskripsi, spesifikasi, garansi, ulasan).
- **Keranjang Belanja**: Dapat menambahkan produk ke keranjang, merubah jumlah (kuantitas), serta menghapus produk dari keranjang belanja.

---

## 2. Customer (Pelanggan)
Pengguna yang sudah melakukan pendaftaran (registrasi) dan *login* ke dalam sistem. Ini adalah *role* bawaan (default) saat seseorang membuat akun baru.
- **Profil**: Memperbarui informasi profil (nama, email, alamat pengiriman, kota, provinsi, kode pos).
- **Checkout Pesanan**: Memproses isi keranjang belanja untuk dijadikan pesanan resmi.
- **Manajemen Pesanan**:
  - Melihat riwayat seluruh pesanan yang pernah dibuat.
  - Mengunggah foto bukti pembayaran.
  - Melacak status resi pengiriman secara langsung (terintegrasi dengan tombol lacak).
  - Melakukan konfirmasi bahwa barang telah diterima dengan baik.
- **Ulasan (Review)**: Memberikan rating bintang dan ulasan tertulis pada produk yang sudah dibeli dan pesanannya sudah selesai.
- **Klaim Garansi**: 
  - Membuat tiket klaim garansi untuk produk yang bermasalah.
  - Melampirkan foto bukti kerusakan.
  - Memantau status persetujuan klaim garansi.

---

## 3. Admin
Pengguna yang bertugas mengelola operasional harian toko. 
- **Dashboard Operasional**: Melihat ringkasan metrik penjualan, pesanan hari ini, dan stok yang menipis.
- **Manajemen Produk**: Menambah produk baru, mengedit harga/diskon, memperbarui stok, menambah gambar galeri produk, dan mengatur spesifikasi teknis.
- **Manajemen Kategori & Merek (Brand)**: Membuat kategori atau daftar merek baru.
- **Manajemen Pesanan**:
  - Memverifikasi pembayaran yang diunggah oleh pelanggan.
  - Memproses pesanan dari status Menunggu, Diproses, Dikirim, hingga Selesai.
  - Memasukkan nomor resi pengiriman untuk pelanggan.
- **Manajemen Ulasan (Review)**: Menyetujui atau menyembunyikan ulasan yang masuk.
- **Manajemen Klaim Garansi**: Meninjau pengajuan garansi, mengubah status menjadi Disetujui, Ditolak, atau Selesai, serta memberikan catatan solusi perbaikan.
- **Manajemen Ekspedisi (Shipping Method)**: Menambah atau mengubah metode pengiriman beserta ongkos kirim flat-nya.
- **Manajemen Supplier (Pemasok)**: Mencatat daftar pihak pemasok/grosir (*contoh: Win Mulia Abadi, Berlian Elektronik, dll*).
- **Laporan Penjualan**: Melihat rekapitulasi transaksi dan **Mengunduh Laporan ke format Excel (CSV)**.
- **Pengaturan Toko**: Memperbarui nomor rekening bank, kontak WhatsApp toko, profil Instagram, dan alamat fisik toko.

---

## 4. Pemilik (Owner)
Pemilik bisnis atau *stakeholder* tingkat atas yang lebih fokus pada performa bisnis secara keseluruhan tanpa perlu terlibat pada operasional pesanan harian.
- **Dashboard Ringkasan Eksekutif**: Melihat grafik statistik penjualan, total pendapatan, jumlah pesanan, dan tren bisnis.
- **Unduh Laporan Keuangan**: Dapat mengekspor seluruh laporan pendapatan bulanan ke format Excel untuk keperluan pembukuan atau audit keuangan.

---

> [!NOTE]
> Semua rute (*routes*) untuk Admin dan Pemilik telah dilindungi oleh komponen keamanan bernama *Middleware* secara ketat. Seorang *Customer* biasa sama sekali tidak akan bisa mengakses URL khusus Admin/Pemilik, dan sebaliknya, Pemilik yang sifatnya pengawas tidak bisa mengedit data master produk untuk menghindari salah ubah.
