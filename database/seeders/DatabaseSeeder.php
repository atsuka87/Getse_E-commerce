<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductSpec;
use App\Models\Warranty;
use App\Models\SocialSetting;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::create([
            'name' => 'Admin DewiElektro',
            'email' => 'admin@dewielektro.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'phone' => '628123456789',
            'email_verified_at' => now(),
        ]);

        // Customer user
        User::create([
            'name' => 'Budi Customer',
            'email' => 'budi@example.com',
            'password' => bcrypt('password'),
            'role' => 'customer',
            'phone' => '628987654321',
            'address' => 'Jl. Merdeka No. 123',
            'city' => 'Jakarta',
            'province' => 'DKI Jakarta',
            'postal_code' => '10110',
            'email_verified_at' => now(),
        ]);

        // Categories
        $categories = [
            ['name' => 'Handphone', 'slug' => 'handphone', 'icon' => '📱', 'sort_order' => 1, 'description' => 'Smartphone dan handphone terbaru'],
            ['name' => 'Laptop', 'slug' => 'laptop', 'icon' => '💻', 'sort_order' => 2, 'description' => 'Laptop untuk kerja, gaming, dan sekolah'],
            ['name' => 'TV & Monitor', 'slug' => 'tv-monitor', 'icon' => '📺', 'sort_order' => 3, 'description' => 'Smart TV dan monitor berkualitas'],
            ['name' => 'Audio', 'slug' => 'audio', 'icon' => '🎧', 'sort_order' => 4, 'description' => 'Speaker, earphone, dan headphone'],
            ['name' => 'Aksesoris', 'slug' => 'aksesoris', 'icon' => '🔌', 'sort_order' => 5, 'description' => 'Charger, casing, dan aksesoris lainnya'],
            ['name' => 'Kamera', 'slug' => 'kamera', 'icon' => '📷', 'sort_order' => 6, 'description' => 'Kamera digital dan mirrorless'],
            ['name' => 'Gaming', 'slug' => 'gaming', 'icon' => '🎮', 'sort_order' => 7, 'description' => 'Console dan aksesoris gaming'],
            ['name' => 'Tablet', 'slug' => 'tablet', 'icon' => '📋', 'sort_order' => 8, 'description' => 'Tablet untuk produktivitas dan hiburan'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // Brands
        $brands = [
            ['name' => 'Samsung', 'slug' => 'samsung'],
            ['name' => 'Apple', 'slug' => 'apple'],
            ['name' => 'Xiaomi', 'slug' => 'xiaomi'],
            ['name' => 'OPPO', 'slug' => 'oppo'],
            ['name' => 'Vivo', 'slug' => 'vivo'],
            ['name' => 'ASUS', 'slug' => 'asus'],
            ['name' => 'Lenovo', 'slug' => 'lenovo'],
            ['name' => 'Acer', 'slug' => 'acer'],
            ['name' => 'Sony', 'slug' => 'sony'],
            ['name' => 'JBL', 'slug' => 'jbl'],
            ['name' => 'LG', 'slug' => 'lg'],
            ['name' => 'HP', 'slug' => 'hp-brand'],
            ['name' => 'Realme', 'slug' => 'realme'],
            ['name' => 'Infinix', 'slug' => 'infinix'],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }

        // Products
        $products = [
            [
                'name' => 'Samsung Galaxy S24 Ultra',
                'category' => 'handphone',
                'brand' => 'samsung',
                'price' => 19999000,
                'sale_price' => 18499000,
                'stock' => 15,
                'short_description' => 'Flagship Samsung dengan S Pen dan kamera 200MP',
                'description' => 'Samsung Galaxy S24 Ultra menghadirkan pengalaman smartphone premium dengan prosesor Snapdragon 8 Gen 3, layar Dynamic AMOLED 6.8 inci, dan kamera 200MP yang menghasilkan foto menakjubkan.',
                'condition' => 'new',
                'is_featured' => true,
                'sku' => 'SAM-S24U-256',
                'specs' => [
                    'Prosesor' => 'Snapdragon 8 Gen 3',
                    'RAM' => '12 GB',
                    'Storage' => '256 GB',
                    'Layar' => '6.8" Dynamic AMOLED 2X',
                    'Kamera Utama' => '200MP + 50MP + 12MP + 10MP',
                    'Baterai' => '5000 mAh',
                    'OS' => 'Android 14, One UI 6.1',
                ],
                'warranties' => [
                    ['type' => 'store', 'duration_days' => 7, 'duration_label' => '7 Hari Garansi Toko'],
                    ['type' => 'official', 'duration_days' => 365, 'duration_label' => '1 Tahun Garansi Resmi Samsung'],
                ],
            ],
            [
                'name' => 'iPhone 15 Pro Max',
                'category' => 'handphone',
                'brand' => 'apple',
                'price' => 21999000,
                'sale_price' => null,
                'stock' => 10,
                'short_description' => 'iPhone terkuat dengan chip A17 Pro dan titanium design',
                'description' => 'iPhone 15 Pro Max hadir dengan desain titanium yang ringan namun kuat, chip A17 Pro, dan sistem kamera pro paling canggih. Mendukung USB-C dan Action Button.',
                'condition' => 'new',
                'is_featured' => true,
                'sku' => 'APL-15PM-256',
                'specs' => [
                    'Prosesor' => 'Apple A17 Pro',
                    'RAM' => '8 GB',
                    'Storage' => '256 GB',
                    'Layar' => '6.7" Super Retina XDR OLED',
                    'Kamera Utama' => '48MP + 12MP + 12MP',
                    'Baterai' => '4441 mAh',
                    'OS' => 'iOS 17',
                ],
                'warranties' => [
                    ['type' => 'store', 'duration_days' => 7, 'duration_label' => '7 Hari Garansi Toko'],
                    ['type' => 'official', 'duration_days' => 365, 'duration_label' => '1 Tahun Garansi Resmi Apple'],
                ],
            ],
            [
                'name' => 'ASUS ROG Zephyrus G14',
                'category' => 'laptop',
                'brand' => 'asus',
                'price' => 24999000,
                'sale_price' => 22999000,
                'stock' => 8,
                'short_description' => 'Laptop gaming ultra-tipis dengan RTX 4060',
                'description' => 'ASUS ROG Zephyrus G14 menggabungkan performa gaming kelas atas dalam desain ultra-tipis. Dilengkapi AMD Ryzen 9 dan NVIDIA RTX 4060.',
                'condition' => 'new',
                'is_featured' => true,
                'sku' => 'ASUS-ROG-G14',
                'specs' => [
                    'Prosesor' => 'AMD Ryzen 9 7940HS',
                    'RAM' => '16 GB DDR5',
                    'Storage' => '512 GB NVMe SSD',
                    'Layar' => '14" QHD+ 165Hz',
                    'GPU' => 'NVIDIA RTX 4060',
                    'Baterai' => '76Wh',
                    'OS' => 'Windows 11 Home',
                ],
                'warranties' => [
                    ['type' => 'store', 'duration_days' => 7, 'duration_label' => '7 Hari Garansi Toko'],
                    ['type' => 'official', 'duration_days' => 730, 'duration_label' => '2 Tahun Garansi Resmi ASUS'],
                ],
            ],
            [
                'name' => 'Xiaomi Redmi Note 13 Pro',
                'category' => 'handphone',
                'brand' => 'xiaomi',
                'price' => 3499000,
                'sale_price' => 2999000,
                'stock' => 30,
                'short_description' => 'Mid-range champion dengan kamera 200MP',
                'description' => 'Redmi Note 13 Pro menawarkan spesifikasi premium di harga terjangkau. Kamera 200MP, layar AMOLED 120Hz, dan baterai 5100mAh.',
                'condition' => 'new',
                'is_featured' => true,
                'sku' => 'XI-RN13P-128',
                'specs' => [
                    'Prosesor' => 'MediaTek Dimensity 7200 Ultra',
                    'RAM' => '8 GB',
                    'Storage' => '128 GB',
                    'Layar' => '6.67" AMOLED 120Hz',
                    'Kamera Utama' => '200MP + 8MP + 2MP',
                    'Baterai' => '5100 mAh',
                    'OS' => 'Android 13, MIUI 14',
                ],
                'warranties' => [
                    ['type' => 'store', 'duration_days' => 7, 'duration_label' => '7 Hari Garansi Toko'],
                    ['type' => 'official', 'duration_days' => 365, 'duration_label' => '1 Tahun Garansi Resmi Xiaomi'],
                ],
            ],
            [
                'name' => 'Sony WH-1000XM5',
                'category' => 'audio',
                'brand' => 'sony',
                'price' => 4999000,
                'sale_price' => 4499000,
                'stock' => 20,
                'short_description' => 'Headphone ANC terbaik di kelasnya',
                'description' => 'Sony WH-1000XM5 menawarkan noise cancelling terbaik di industri dengan kualitas suara Hi-Res Audio dan kenyamanan maksimal sepanjang hari.',
                'condition' => 'new',
                'is_featured' => true,
                'sku' => 'SONY-WH1K-XM5',
                'specs' => [
                    'Driver' => '30mm',
                    'Tipe' => 'Over-ear, Closed-back',
                    'Koneksi' => 'Bluetooth 5.2, 3.5mm',
                    'ANC' => 'Ya, Auto NC Optimizer',
                    'Baterai' => '30 jam',
                    'Berat' => '250g',
                    'Fitur' => 'LDAC, Multipoint, Speak-to-Chat',
                ],
                'warranties' => [
                    ['type' => 'store', 'duration_days' => 7, 'duration_label' => '7 Hari Garansi Toko'],
                    ['type' => 'official', 'duration_days' => 365, 'duration_label' => '1 Tahun Garansi Resmi Sony'],
                ],
            ],
            [
                'name' => 'Samsung 55" Crystal UHD TV',
                'category' => 'tv-monitor',
                'brand' => 'samsung',
                'price' => 7999000,
                'sale_price' => 6999000,
                'stock' => 5,
                'short_description' => 'Smart TV 4K Crystal UHD 55 inci',
                'description' => 'Samsung Crystal UHD TV 55 inci dengan resolusi 4K, Crystal Processor 4K, dan Smart TV Tizen OS. Nikmati konten favorit dengan kualitas gambar jernih.',
                'condition' => 'new',
                'is_featured' => false,
                'sku' => 'SAM-TV55-CU',
                'specs' => [
                    'Ukuran Layar' => '55 inci',
                    'Resolusi' => '4K UHD (3840x2160)',
                    'Panel' => 'Crystal UHD',
                    'Prosesor' => 'Crystal Processor 4K',
                    'HDR' => 'HDR10+',
                    'Smart TV' => 'Tizen OS',
                    'Koneksi' => 'HDMI x3, USB x1, Wi-Fi',
                ],
                'warranties' => [
                    ['type' => 'store', 'duration_days' => 7, 'duration_label' => '7 Hari Garansi Toko'],
                    ['type' => 'official', 'duration_days' => 365, 'duration_label' => '1 Tahun Garansi Resmi Samsung'],
                ],
            ],
            [
                'name' => 'JBL Flip 6',
                'category' => 'audio',
                'brand' => 'jbl',
                'price' => 1799000,
                'sale_price' => 1499000,
                'stock' => 25,
                'short_description' => 'Speaker portable waterproof dengan bass powerful',
                'description' => 'JBL Flip 6 adalah speaker Bluetooth portable dengan suara JBL Original Pro yang powerful, tahan air IP67, dan baterai tahan 12 jam.',
                'condition' => 'new',
                'is_featured' => false,
                'sku' => 'JBL-FLIP6',
                'specs' => [
                    'Output' => '30W',
                    'Bluetooth' => '5.1',
                    'Tahan Air' => 'IP67',
                    'Baterai' => '12 jam',
                    'Berat' => '550g',
                    'PartyBoost' => 'Ya',
                ],
                'warranties' => [
                    ['type' => 'store', 'duration_days' => 7, 'duration_label' => '7 Hari Garansi Toko'],
                    ['type' => 'official', 'duration_days' => 365, 'duration_label' => '1 Tahun Garansi Resmi JBL'],
                ],
            ],
            [
                'name' => 'Lenovo IdeaPad Slim 3',
                'category' => 'laptop',
                'brand' => 'lenovo',
                'price' => 8999000,
                'sale_price' => 7999000,
                'stock' => 12,
                'short_description' => 'Laptop everyday computing terjangkau',
                'description' => 'Lenovo IdeaPad Slim 3 cocok untuk pekerjaan sehari-hari dan belajar. Ringan, baterai awet, dan performa mumpuni.',
                'condition' => 'new',
                'is_featured' => false,
                'sku' => 'LEN-IPS3-R5',
                'specs' => [
                    'Prosesor' => 'AMD Ryzen 5 7520U',
                    'RAM' => '8 GB DDR5',
                    'Storage' => '512 GB SSD',
                    'Layar' => '14" FHD IPS',
                    'GPU' => 'AMD Radeon 610M',
                    'Baterai' => '47Wh',
                    'OS' => 'Windows 11 Home',
                ],
                'warranties' => [
                    ['type' => 'store', 'duration_days' => 7, 'duration_label' => '7 Hari Garansi Toko'],
                    ['type' => 'official', 'duration_days' => 365, 'duration_label' => '1 Tahun Garansi Resmi Lenovo'],
                ],
            ],
        ];

        foreach ($products as $pData) {
            $category = Category::where('slug', $pData['category'])->first();
            $brand = Brand::where('slug', $pData['brand'])->first();

            $product = Product::create([
                'name' => $pData['name'],
                'slug' => Str::slug($pData['name']),
                'category_id' => $category->id,
                'brand_id' => $brand->id,
                'price' => $pData['price'],
                'sale_price' => $pData['sale_price'],
                'stock' => $pData['stock'],
                'short_description' => $pData['short_description'],
                'description' => $pData['description'],
                'condition' => $pData['condition'],
                'is_featured' => $pData['is_featured'],
                'sku' => $pData['sku'],
                'status' => 'active',
            ]);

            // Specs
            $sortOrder = 0;
            foreach ($pData['specs'] as $key => $value) {
                ProductSpec::create([
                    'product_id' => $product->id,
                    'spec_key' => $key,
                    'spec_value' => $value,
                    'sort_order' => $sortOrder++,
                ]);
            }

            // Warranties
            foreach ($pData['warranties'] as $warranty) {
                Warranty::create([
                    'product_id' => $product->id,
                    'type' => $warranty['type'],
                    'duration_days' => $warranty['duration_days'],
                    'duration_label' => $warranty['duration_label'],
                ]);
            }
        }

        // Social Settings
        $socialSettings = [
            ['key' => 'whatsapp_number', 'value' => '628123456789', 'label' => 'Nomor WhatsApp', 'type' => 'text'],
            ['key' => 'instagram_url', 'value' => 'https://instagram.com/dewielektro', 'label' => 'URL Instagram', 'type' => 'url'],
            ['key' => 'instagram_username', 'value' => '@dewielektro', 'label' => 'Username Instagram', 'type' => 'text'],
            ['key' => 'store_name', 'value' => 'DewiElektro', 'label' => 'Nama Toko', 'type' => 'text'],
            ['key' => 'store_address', 'value' => 'Jl. Elektronik No. 88, Jakarta', 'label' => 'Alamat Toko', 'type' => 'textarea'],
            ['key' => 'store_email', 'value' => 'info@dewielektro.com', 'label' => 'Email Toko', 'type' => 'email'],
            ['key' => 'store_phone', 'value' => '021-12345678', 'label' => 'Telepon Toko', 'type' => 'text'],
            ['key' => 'bank_name', 'value' => 'Bank BCA', 'label' => 'Nama Bank', 'type' => 'text'],
            ['key' => 'bank_account_number', 'value' => '1234567890', 'label' => 'Nomor Rekening', 'type' => 'text'],
            ['key' => 'bank_account_name', 'value' => 'PT Dewi Elektronik', 'label' => 'Nama Pemilik Rekening', 'type' => 'text'],
        ];

        foreach ($socialSettings as $setting) {
            SocialSetting::create($setting);
        }
    }
}
