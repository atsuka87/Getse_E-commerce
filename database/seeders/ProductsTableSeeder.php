<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('products')->delete();
        
        \DB::table('products')->insert(array (
            0 => 
            array (
                'id' => 5,
                'category_id' => 4,
                'brand_id' => 9,
                'name' => 'Sony WH-1000XM5',
                'slug' => 'sony-wh-1000xm5',
                'short_description' => 'Headphone ANC terbaik di kelasnya',
                'description' => 'Sony WH-1000XM5 menawarkan noise cancelling terbaik di industri dengan kualitas suara Hi-Res Audio dan kenyamanan maksimal sepanjang hari.',
                'price' => '4999000.00',
                'sale_price' => '4499000.00',
                'stock' => 20,
                'low_stock_threshold' => 5,
                'sku' => 'SONY-WH1K-XM5',
                'weight' => NULL,
                'status' => 'active',
                'condition' => 'new',
                'instagram_url' => NULL,
                'views' => 2,
                'is_featured' => 1,
                'created_at' => '2026-05-25 14:48:06',
                'updated_at' => '2026-06-25 03:37:02',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 6,
                'category_id' => 3,
                'brand_id' => NULL,
                'name' => 'Samsung 55" Crystal UHD TV',
                'slug' => 'samsung-55-crystal-uhd-tv',
                'short_description' => 'Smart TV 4K Crystal UHD 55 inci',
                'description' => 'Samsung Crystal UHD TV 55 inci dengan resolusi 4K, Crystal Processor 4K, dan Smart TV Tizen OS. Nikmati konten favorit dengan kualitas gambar jernih.',
                'price' => '7999000.00',
                'sale_price' => '6999000.00',
                'stock' => 5,
                'low_stock_threshold' => 5,
                'sku' => 'SAM-TV55-CU',
                'weight' => NULL,
                'status' => 'active',
                'condition' => 'new',
                'instagram_url' => NULL,
                'views' => 0,
                'is_featured' => 0,
                'created_at' => '2026-05-25 14:48:06',
                'updated_at' => '2026-07-05 14:00:40',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 7,
                'category_id' => 4,
                'brand_id' => 10,
                'name' => 'JBL Flip 6',
                'slug' => 'jbl-flip-6',
                'short_description' => 'Speaker portable waterproof dengan bass powerful',
                'description' => 'JBL Flip 6 adalah speaker Bluetooth portable dengan suara JBL Original Pro yang powerful, tahan air IP67, dan baterai tahan 12 jam.',
                'price' => '1799000.00',
                'sale_price' => '1499000.00',
                'stock' => 25,
                'low_stock_threshold' => 5,
                'sku' => 'JBL-FLIP6',
                'weight' => NULL,
                'status' => 'active',
                'condition' => 'new',
                'instagram_url' => NULL,
                'views' => 0,
                'is_featured' => 0,
                'created_at' => '2026-05-25 14:48:07',
                'updated_at' => '2026-07-05 14:00:40',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 9,
                'category_id' => 9,
                'brand_id' => 11,
                'name' => 'Kulkas 2 Pintu LG  GNB 195',
                'slug' => 'kulkas-2-pintu-lg-gnb-195',
                'short_description' => NULL,
            'description' => 'FITUR : -Smart Inverter Compressor -Ice Tray, & Pull Out Tray -Big Veggie Box, Kapasitas box buah dan sayuran yang lebih besar -Moist Balance Crisper™ -Adjustable Door Shelf -TEMPERED GLASS RAK -Multi Air Flow -LED Lighting SPESIFIKASI : Kapasitas (L) : 187 Liter Ukuran (PxLxT) (mm) :555 x 585 x 1400 mm Daya (W) : 125 Watt Tegangan : 220V / 1P Berat (Kg) : 40 kg Garansi Produk : 1 Tahun spareparts 10 Tahun kompresor',
                'price' => '5000000.00',
                'sale_price' => NULL,
                'stock' => 5,
                'low_stock_threshold' => 5,
                'sku' => NULL,
                'weight' => '40000.00',
                'status' => 'active',
                'condition' => 'new',
                'instagram_url' => NULL,
                'views' => 0,
                'is_featured' => 1,
                'created_at' => '2026-05-30 19:19:56',
                'updated_at' => '2026-07-05 14:00:40',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 11,
                'category_id' => 9,
                'brand_id' => 11,
                'name' => 'Kulkas 2 Pintu LG  GNB 194',
                'slug' => 'kulkas-2-pintu-lg-gnb-194',
                'short_description' => NULL,
                'description' => NULL,
                'price' => '5000000.00',
                'sale_price' => NULL,
                'stock' => 0,
                'low_stock_threshold' => 5,
                'sku' => NULL,
                'weight' => '40000.00',
                'status' => 'active',
                'condition' => 'new',
                'instagram_url' => NULL,
                'views' => 0,
                'is_featured' => 0,
                'created_at' => '2026-05-31 16:55:33',
                'updated_at' => '2026-07-05 14:00:40',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 12,
                'category_id' => 9,
                'brand_id' => 11,
                'name' => 'Kulkas 2 Pintu Polytron PRW 25MO',
                'slug' => 'kulkas-2-pintu-polytron-prw-25mo',
                'short_description' => NULL,
            'description' => 'Type : DoubleDoor • Finishing Door : Tempered Glass • Capacity : 240 liter • Handle : Recess Handle • Available Color : MOW (white orchid) MOB (blue orchid) MTR (trumpet) • Power Input : 140 Watt • Voltage Input : 220v/50hz • Refrigerant : R134a • Nett Dimension (WxDxH) : 587 x 576 x 1509 mm • Gross Dimension (WxDxH) : 627 x 649 x 1579 mm • Weight : 45 Kg (Nett) • Warranty Compressor : 5 Years • Tempered Glass Door • Borderless Round Edge Door • Jumbo Cabinet • Deodorizer • LED Lamp • Portable Ice Twist Tray • Bigger Bottle Pocket • Adjustable Tempered Glass Rack • Automatic Defrost System • Warranty Compressor : 5 Year',
                'price' => '4499999.00',
                'sale_price' => NULL,
                'stock' => 4,
                'low_stock_threshold' => 5,
                'sku' => NULL,
                'weight' => '400000.00',
                'status' => 'active',
                'condition' => 'new',
                'instagram_url' => NULL,
                'views' => 2,
                'is_featured' => 1,
                'created_at' => '2026-05-31 17:00:18',
                'updated_at' => '2026-07-05 14:00:40',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 13,
                'category_id' => 9,
                'brand_id' => 11,
                'name' => 'Kulkas 1pintu POLYTRON PRB189',
                'slug' => 'kulkas-1pintu-polytron-prb189',
                'short_description' => NULL,
            'description' => 'FITUR : - Rak Tempered Glass Kaca -Single Door FLOWER DESIGN -4D Quick Freezing -Ice Tray -Freezer BOX -Vegetable Box -Temperes Glass Tray rack -Low Watt -LED Lighting -Direct Cooling System -Full Insulation SPESIFIKASI : - Kapasitas (L) :180 liter - Ukuran (WxDxH) (mm) :513x542x1217 mm - Daya (W) : 80 Watt - Tegangan : 220V / 1P - Berat (Kg) : 31.8 Kg - Garansi Produk : 1 Tahun spareparts 3 Tahun kompresor',
                'price' => '2999999.00',
                'sale_price' => NULL,
                'stock' => 5,
                'low_stock_threshold' => 5,
                'sku' => NULL,
                'weight' => NULL,
                'status' => 'active',
                'condition' => 'new',
                'instagram_url' => NULL,
                'views' => 0,
                'is_featured' => 0,
                'created_at' => '2026-05-31 17:03:59',
                'updated_at' => '2026-07-05 14:00:40',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 14,
                'category_id' => 10,
                'brand_id' => 15,
                'name' => 'Mesin cuci 7kg SHARP EST-70MW',
                'slug' => 'mesin-cuci-7kg-sharp-est-70mw',
                'short_description' => NULL,
                'description' => 'SHARP Mesin Cuci ES-T70 MW adalah mesin cuci yang memiliki desain yang elegan. Dengan pulsator yang besar mampu menghasilkan pusaran air yang kuat sehingga hasil cucian lebih bersih. Sehingga memudahkan proses perendaman pakaian sehingga menghasilkan pakaian yang lebih bersih.

Detail:
- Single Pulsator
- Silvermagic Protection on Pulsator
- Easy Function
- Wash Capacity 7 KG
- Dry Capacity : 3 KG
- Wash : 320 Watt, Spin : 99 Watt
- Dimension : 783 xx 437 x 934 mm',
                'price' => '2499999.00',
                'sale_price' => NULL,
                'stock' => 0,
                'low_stock_threshold' => 5,
                'sku' => NULL,
                'weight' => '70000.00',
                'status' => 'out_of_stock',
                'condition' => 'new',
                'instagram_url' => NULL,
                'views' => 2,
                'is_featured' => 1,
                'created_at' => '2026-05-31 17:07:21',
                'updated_at' => '2026-07-05 14:00:40',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 15,
                'category_id' => 10,
                'brand_id' => 15,
                'name' => 'Mesin cuci SHARP ES-T1290WA "12kg"',
                'slug' => 'mesin-cuci-sharp-es-t1290wa-12kg',
                'short_description' => 'Model : ES-T1290WA BL/PK',
                'description' => 'Fitur :
- Sharp Mesin Cuci 2 Tabung
- 12 Kg Aquamagic
- Dolphinwave Series

Spesifikasi :
- Capacity 12 Kg
- W-Screw Pulsator
- Double Anti Bacteria
- Super Aquamagic Filter
- Spin Air Dry
- Low Voltage
- Body Durable And Corrotion
- Free Plastic Cabinet
- Color White Color Blue
- And Pink Top Lid Color
- Tube Type Plastic
- Standard Water Volume
- Level - 81 / Level 2-72/Level 3
- 61 L
- Wash Programme
- Normal & Berat ( Heavy)
- Power Consumption : Wash 360 Watt & Spin 180 Watt
- Power Source 220v/50hz
- Dimensi (WxHxD) : 921 x 1065 x 551 Mm',
                    'price' => '200000.00',
                    'sale_price' => NULL,
                    'stock' => 0,
                    'low_stock_threshold' => 5,
                    'sku' => NULL,
                    'weight' => '4000.00',
                    'status' => 'active',
                    'condition' => 'new',
                    'instagram_url' => NULL,
                    'views' => 0,
                    'is_featured' => 0,
                    'created_at' => '2026-05-31 19:41:01',
                    'updated_at' => '2026-07-05 14:00:40',
                    'deleted_at' => NULL,
                ),
                9 => 
                array (
                    'id' => 16,
                    'category_id' => 10,
                    'brand_id' => 15,
                    'name' => 'Mesin cuci SHARP ES-T96CR  9kg',
                    'slug' => 'mesin-cuci-sharp-es-t96cr-9kg',
                    'short_description' => NULL,
                    'description' => 'FITUR :
-Aquamagic FILTER, Menyaring kotoran / Pasir yg keluar dr kran air agar lebih bersih
-Big pulsator, Dilengkapi dengan pulsator yang besar membuat putaran saat pencucian sangat kuat, sehingga hasil pencucian akan lebih bersih dan sempurna.
-Water Inlet, Mesin cuci ini memiliki water inlet. Sehingga memudahkan untuk pengguna dalam memasukan air kedalam mesin cuci pada saat process pencucian
-Anti Rust, Bodi dan dasar mesin cuci terbuat dari bahan plastik yang kokoh, anti karat dan bebas korosi
-Double Pulsator, Mencuci berbagai jenis pakaian tanpa khawatir
-Soakmagic
-Silvermagic (Ag+ ion) Protection on Pulsator

SPESIFIKASI :
KAPASITAS :9,5 kg
Voltage/Frequency 220 V/ 50 Hz
KONSUMSI DAYA (W) : 265 Watt
BERAT : 27 KG
DIMENSION (WXDXH) : 855 x 495 x 995 mm
Garansi Resmi motor 1 tahun Spare Part',
                    'price' => '2500000.00',
                    'sale_price' => NULL,
                    'stock' => 7,
                    'low_stock_threshold' => 5,
                    'sku' => NULL,
                    'weight' => '2000.00',
                    'status' => 'active',
                    'condition' => 'new',
                    'instagram_url' => NULL,
                    'views' => 0,
                    'is_featured' => 0,
                    'created_at' => '2026-05-31 19:43:40',
                    'updated_at' => '2026-07-05 14:16:37',
                    'deleted_at' => NULL,
                ),
                10 => 
                array (
                    'id' => 17,
                    'category_id' => 3,
                    'brand_id' => 16,
                    'name' => 'Tv LED 32" POLYTRON PLD-32TV1855',
                    'slug' => 'tv-led-32-polytron-pld-32tv1855',
                    'short_description' => NULL,
                    'description' => 'LED TV Polytron Cinemax 32"
TIpe 32TV1855
Khusus Tipe ini Polytron Berikan 5 tahun garansi panel
Garansi resmi 1 tahun

Spesifikasi :
1. Ukuran layar LED 32 inch
2. warna Hitam
3. Garansi resmi 1 tahun
4. USB Movie input
5. HDMI input
6. RCA input
7. Antena input
8. HD Ready
9. DVB T2 Siaran Digital 
10. Sepasang speaker Tower Model terbaru
11. Garansi Panel 5 tahun',
                    'price' => '400000.00',
                    'sale_price' => NULL,
                    'stock' => 5,
                    'low_stock_threshold' => 5,
                    'sku' => NULL,
                    'weight' => '1000.00',
                    'status' => 'active',
                    'condition' => 'new',
                    'instagram_url' => NULL,
                    'views' => 0,
                    'is_featured' => 0,
                    'created_at' => '2026-05-31 19:46:28',
                    'updated_at' => '2026-07-05 14:00:40',
                    'deleted_at' => NULL,
                ),
                11 => 
                array (
                    'id' => 18,
                    'category_id' => 3,
                    'brand_id' => 16,
                    'name' => 'Tv LED 32" POLYTRON PLD-32TV1854',
                    'slug' => 'tv-led-32-polytron-pld-32tv1854',
                    'short_description' => NULL,
                    'description' => 'LED TV Polytron Cinemax 32"
TIpe 32TV1855
Khusus Tipe ini Polytron Berikan 5 tahun garansi panel
Garansi resmi 1 tahun

Spesifikasi :
1. Ukuran layar LED 32 inch
2. warna Hitam
3. Garansi resmi 1 tahun
4. USB Movie input
5. HDMI input
6. RCA input
7. Antena input
8. HD Ready
9. DVB T2 Siaran Digital 
10. Sepasang speaker Tower Model terbaru
11. Garansi Panel 5 tahun',
                    'price' => '400000.00',
                    'sale_price' => NULL,
                    'stock' => 0,
                    'low_stock_threshold' => 5,
                    'sku' => NULL,
                    'weight' => '999.99',
                    'status' => 'active',
                    'condition' => 'new',
                    'instagram_url' => NULL,
                    'views' => 0,
                    'is_featured' => 0,
                    'created_at' => '2026-05-31 19:48:59',
                    'updated_at' => '2026-07-05 14:00:40',
                    'deleted_at' => NULL,
                ),
                12 => 
                array (
                    'id' => 19,
                    'category_id' => 3,
                    'brand_id' => 11,
                    'name' => 'TV SMART 43" LG 43LM57',
                    'slug' => 'tv-smart-43-lg-43lm57',
                    'short_description' => NULL,
                    'description' => 'Fitur :
- TV Full HD Dengan Tingkatan Baru
- Dynamic Color Enhancer
- Prosesor Quad Core Awal Tercipta Gambar Yang Hidup
- Active HDR untuk Detail Luar Biasa
- Virtual Surround Plus Memenuhi Ruangan
 
Spesifikasi :
- Ukuran Size : 43 Inch
- Quad Core Processor : Ya
 
- Active HDR : Ya
- Dynamic Color : Ya
- HDR Dynamic Tone Mapping : Ya
- USB Movie : Ya
- Resolution Upscaler : Ya
- HDMI : Ya
- Support Magic Remote (tidak include magic remote)
- LG ThinQ AI : Ya
- Intelligent Edit : Ya
- AI Recommendation : Ya
- Home Dashboard : Ya
- Mobile Connection : Ya
- Quick Access : Ya
- Sound : 2.0 Ch. / 10W
- Virtual Surround Plus : Ya
- Clear Voice : Ya
- Dolby Audio : Ya',
                    'price' => '500000.00',
                    'sale_price' => NULL,
                    'stock' => 4,
                    'low_stock_threshold' => 5,
                    'sku' => NULL,
                    'weight' => '1000.02',
                    'status' => 'active',
                    'condition' => 'new',
                    'instagram_url' => NULL,
                    'views' => 0,
                    'is_featured' => 0,
                    'created_at' => '2026-05-31 19:50:57',
                    'updated_at' => '2026-07-05 14:00:40',
                    'deleted_at' => NULL,
                ),
                13 => 
                array (
                    'id' => 20,
                    'category_id' => 4,
                    'brand_id' => 16,
                    'name' => 'Speaker Bluetooth POLYTRON PTS 12KF15',
                    'slug' => 'speaker-bluetooth-polytron-pts-12kf15',
                    'short_description' => NULL,
                    'description' => 'Polytron Speaker Portable PTS 12KF15

Rasakan dahsyatnya suara dari Polytron Portable Speaker Audio yang dilengkapi teknologi Super Bass. Merupakan bluetooth speaker dengan dukungan Dual Power: AC & Built-in Battery, serta handle dan roda, cocok digunakan untuk berbagai aktivitas indoor maupun outdoor. Makin lengkap dengan Mic Input with Echo Control dan 2 Wireless Mic untuk karaoke bersama teman atau keluarga.

Dual Power (AC & Battery)
Battery Life up to 4 Hours
Handle & Wheels
3-Way Speaker System
Woofer 12 inch
Super Bass
Top Panel Control
LED Display
5-Band User Equalizer
Preset Equalizer
Ambient Light
Bluetooth Connection v5
Supported with Polytron Audio Connect App
USB, SD Card/MMC, Aux, Line Input
FM Radio
Band Input (Keyboard & Guitar)
2 Wireless Mic Included
1 Mic Input with Echo Control
Mic Priority
Music & Mic Recording (NEW FEATURE)
Reverb Level (NEW FEATURE)
Remote Control
Power Output: 70 WRMS
Garansi Resmi 1 tahun',
                    'price' => '800000.00',
                    'sale_price' => NULL,
                    'stock' => 0,
                    'low_stock_threshold' => 5,
                    'sku' => NULL,
                    'weight' => NULL,
                    'status' => 'active',
                    'condition' => 'new',
                    'instagram_url' => NULL,
                    'views' => 0,
                    'is_featured' => 0,
                    'created_at' => '2026-05-31 19:53:27',
                    'updated_at' => '2026-07-05 14:00:40',
                    'deleted_at' => NULL,
                ),
                14 => 
                array (
                    'id' => 21,
                    'category_id' => 11,
                    'brand_id' => 18,
                    'name' => 'Blender COSMOS CB-281 P',
                    'slug' => 'blender-cosmos-cb-281-p',
                    'short_description' => NULL,
                'description' => 'Pelumat bahan makanan dengan Thermostat Overheat Protection berfungsi sebagai pengaman panas berlebih yang dapat memutuskan arus listrik dan mencegah kerusakan motor. Dilengkapi 2 tombol kecepatan (low & high) dan tombol off, goblet/gelas plastik kapasitas 2 liter, Dual Shape Blade yang berfungsi untuk melumatkan bahan makanan lebih halus, wadah penggilin bumbu kering & basah, serta anti slip agar tidak goyang/berpindah pada saat dioperasikan. Safety Lock System sebagai pengaman, dimana motor tidak akan bekerja jika pelumat tidak terpasang dengan baik dan benar untuk mencegah terlepasnya goblet/mata pisau mencederai pengguna.',
                    'price' => '500000.00',
                    'sale_price' => NULL,
                    'stock' => 11,
                    'low_stock_threshold' => 5,
                    'sku' => NULL,
                    'weight' => '799.99',
                    'status' => 'active',
                    'condition' => 'new',
                    'instagram_url' => NULL,
                    'views' => 0,
                    'is_featured' => 0,
                    'created_at' => '2026-06-01 07:38:16',
                    'updated_at' => '2026-07-05 14:02:19',
                    'deleted_at' => NULL,
                ),
                15 => 
                array (
                    'id' => 22,
                    'category_id' => 11,
                    'brand_id' => 17,
                    'name' => 'Blender NATIONAL VITARA 2in1',
                    'slug' => 'blender-national-vitara-2in1',
                    'short_description' => NULL,
                'description' => 'Blender 2 IN 1 National VITARA SN 106 / VTR-106 ( Sama Saja hanya penamaan tipe )

Note : Untuk Harga sudah termasuk packaging aman luar dan dalam dikarenakan bahan kaca dan rentan, sebelum pengiriman kami QC terlebih dahulu semua
Untuk Komplain Wajib melampirkan bukti video unboxing dari awal dan terlihat jelas label resi kiriman dari toko kami, jika tanpa unboxing maka komplain akan kami anggap tidak valid.

Spesifikasi :
- Tingkat Kecepatan : 2 Speed + 1 Pulse
- Kapasitas : 1 Liter
- Menghaluskan bahan kering,dan bahan basah
- Daya :220 Watt , 220 Volt
- Mesin tidak berisik karna ada peredam
- Dioperasikan dengan tombol pilihan
- Bongkar pasang mudah dibersihkan
- Gelas mudah dibersihkan
- Pisau tajam dari bahan stainless steel
- Makanan bisa lebih lembut dan halus untuk bayi
- Mengaduk dengan rata
- 6 stainless steel blades, dapat menghancurkan es batu',
                'price' => '850000.00',
                'sale_price' => NULL,
                'stock' => 4,
                'low_stock_threshold' => 5,
                'sku' => NULL,
                'weight' => '799.99',
                'status' => 'active',
                'condition' => 'new',
                'instagram_url' => NULL,
                'views' => 0,
                'is_featured' => 0,
                'created_at' => '2026-06-01 07:40:44',
                'updated_at' => '2026-07-05 14:00:40',
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 23,
                'category_id' => 11,
                'brand_id' => 18,
            'name' => 'Food Processor COSMOS FP-313 (pelumat)',
                'slug' => 'food-processor-cosmos-fp-313-pelumat',
                'short_description' => NULL,
                'description' => 'Food Processor with Turbo Knob 1,2 liter merupakan alat penggiling atau penghalus makanan/daging yang terdiri dari 4 bilah pisau yang dapat digunakan dan dibersihkan dengan mudah. kecepatan penggilingan dapat di sesuaikan dengan tekanan yang anda berikan, food processor memiliki mangkok kaca yang lebih kuat dan 4 bilah pisau yang dapat menghaluskan makanan dengan cepat

Cosmos FP-313 - Food Processor with Turbo Knob 1.2 Liter merupakan alat penggiling atau penghalus bahan baku makanan hanya dengan menekan tombol pada bagian atas kemasan. Kecepatan penggilingan dapat anda sesuaikan dengan besarkan tekanan yang anda berikan pada bagian atas kemasan Cosmos FP313 - Food Processor with Turbo Knob 1.2 Liter. Mudah dibersihkan dan mudah digunakan.

Spesifikasi :
Bahan material : Gelas Kaca
Daya Listrik : 350 watt
Kapasitas : 1.2 Liter
Warna : Merah
Panjang Kabel : 1 meter
Dimensi : 23 cm x 10 cm x 10 cm
Terdapat Tombol Turbo
Garansi resmi COSMOS 1 Tahun',
                'price' => '500000.00',
                'sale_price' => NULL,
                'stock' => 0,
                'low_stock_threshold' => 5,
                'sku' => NULL,
                'weight' => '499.99',
                'status' => 'out_of_stock',
                'condition' => 'new',
                'instagram_url' => NULL,
                'views' => 0,
                'is_featured' => 0,
                'created_at' => '2026-06-01 07:43:02',
                'updated_at' => '2026-07-05 14:00:40',
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 24,
                'category_id' => 14,
                'brand_id' => 19,
                'name' => 'Setrika kering PHILIPS DIVA GC-122',
                'slug' => 'setrika-kering-philips-diva-gc-122',
                'short_description' => NULL,
                'description' => 'Philips Dry Iron - Amethyst Purple Mudah digunakan dan Tahan lama - Diva adalah setrika kering baru dari Philips dengan ujung alas setrika ramping, yang mampu mencapai bagian sulit dengan mudah. Pegangan yang nyaman dengan tekstur dan kontrol suhu yang gampang dan besar menjadikan setrika mudah digunakan. Lapisan tapak setrika anti-lengket Tapak setrika Philips dilapisi dengan lapisan khusus anti-lengket agar licin di atas semua kain. Tapak setrika berujung ramping memudahkan untuk menjangkau bagian yang sulit Ujung ramping dari tapak setrika memungkinkan untuk menjangkau bagian tersulit, seperti di antara kancing, saat membuat lipatan, dan di sudut-sudut. Alur kancing mempercepat penyetrikaan di sepanjang kancing dan lipatan Detail: - Tapak setrika non-lengket - 350W - Panjang kabel 1,6 m',
                'price' => '300000.00',
                'sale_price' => NULL,
                'stock' => 7,
                'low_stock_threshold' => 5,
                'sku' => NULL,
                'weight' => '199.99',
                'status' => 'active',
                'condition' => 'new',
                'instagram_url' => NULL,
                'views' => 0,
                'is_featured' => 0,
                'created_at' => '2026-06-01 07:46:46',
                'updated_at' => '2026-07-05 14:00:40',
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 25,
                'category_id' => 14,
                'brand_id' => 18,
                'name' => 'Setrika COSMOS CL-3110C',
                'slug' => 'setrika-cosmos-cl-3110c',
                'short_description' => NULL,
                'description' => 'Setrika dengan tapak lebih luas berbahan keramik, pakaian menjadi lebih cepat licin saat disetrika. Terdapat kontrol temperatur otomatis, serta kabel yang lentur & lebih panjang sehingga memudahkan dalam menyetrika.

Features
- Setrika dengan Tapak Keramik Lebih Luas, panas lebih merata
- Kontrol Temperatur Otomatis
- Swivel Cord Lebih Fleksibel
- Kabel Lentur & Lebih Panjang
- Lampu Indikator
- Daya Masukan : 400 WattSetrika dengan tapak lebih luas berbahan keramik, pakaian menjadi lebih cepat licin saat disetrika. Terdapat kontrol temperatur otomatis, serta kabel yang lentur & lebih panjang sehingga memudahkan dalam menyetrika.

Features
- Setrika dengan Tapak Keramik Lebih Luas, panas lebih merata
- Kontrol Temperatur Otomatis
- Swivel Cord Lebih Fleksibel
- Kabel Lentur & Lebih Panjang
- Lampu Indikator
- Daya Masukan : 400 Watt',
                'price' => '300000.00',
                'sale_price' => NULL,
                'stock' => 6,
                'low_stock_threshold' => 5,
                'sku' => NULL,
                'weight' => '199.99',
                'status' => 'active',
                'condition' => 'new',
                'instagram_url' => NULL,
                'views' => 0,
                'is_featured' => 0,
                'created_at' => '2026-06-01 07:48:59',
                'updated_at' => '2026-07-05 14:00:40',
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'id' => 26,
                'category_id' => 14,
                'brand_id' => NULL,
                'name' => 'Setrika COSMOS CL-3120 N',
                'slug' => 'setrika-cosmos-cl-3120-n',
                'short_description' => NULL,
                'description' => 'Cosmos CI3120N Setrika 400 Watt Suhu Otomatis Hitam dengan handle yang nyaman dan body plat full stainless steel membuat Cosmos Setrika CIS 3120N, menjadi lebih terdepan dibanding setrika yang lainnya. Memiliki daya yang powerfull denga suhu otomatis sehingga tidak menyebabkan terjadinya konsleting listrik saat anda menggunakannya dalam waktu yang lama. Memiliki temperatur suhu yang mudah untuk diatur sehingga anda dapat dengan mudah mengatur suhu pada jenis pakaian yang berbeda beda. Plat yang anti lengket pada Cosmos Setrika CIS 3120N membuat pakaian anda menjadi lebih mudah untuk disetrika.


Spesifikasi
Nama Produk Cosmos Setrika
Tipe CIS 3120N
Panjang Kabel 1 Meter
Bahan Material
Full Stainless Steel
Daya 400 Watt
Tegangan 220 Volt 50 Hz
Dimensi (P x L x T) 11 cm x 24.5 cm x 11.5 cm
Anti Lengket Ya
Berat 2 Kg
Warna Hitam
Lampu Indikator Ya',
                'price' => '400000.00',
                'sale_price' => NULL,
                'stock' => 5,
                'low_stock_threshold' => 5,
                'sku' => NULL,
                'weight' => '200.00',
                'status' => 'active',
                'condition' => 'new',
                'instagram_url' => NULL,
                'views' => 0,
                'is_featured' => 0,
                'created_at' => '2026-06-01 07:50:32',
                'updated_at' => '2026-07-05 14:00:40',
                'deleted_at' => NULL,
            ),
            20 => 
            array (
                'id' => 27,
                'category_id' => 12,
                'brand_id' => 18,
                'name' => 'Dispenser COSMOS CWD-5603',
                'slug' => 'dispenser-cosmos-cwd-5603',
                'short_description' => NULL,
                'description' => 'Dispenser K-Style Hot, Cold, &amp; Fresh, dilengkapi Rak Serbaguna untuk Menyimpan Gelas/ Botol
- Dengan Chip Pendingin
- Knockdown : Bisa di Meja&amp; Bisa Berdiri, Tangki Stainless Steel (Anti Karat &amp; Higienis)
- Kapasitas Tangki Besar yaitu 1 liter : Bisa untuk Membuat Minuman hingga 5 Cangkir Sekaligus, Extra Hot 96 C Pas untuk Kopi Tubruk
- Sistem Anti Bocor
- Daya Air Panas : 385 Watt
- Daya Air Dingin : 75 Watt',
                'price' => '450000.00',
                'sale_price' => NULL,
                'stock' => 4,
                'low_stock_threshold' => 5,
                'sku' => NULL,
                'weight' => '800.00',
                'status' => 'active',
                'condition' => 'new',
                'instagram_url' => NULL,
                'views' => 0,
                'is_featured' => 0,
                'created_at' => '2026-06-01 07:52:44',
                'updated_at' => '2026-07-05 14:26:01',
                'deleted_at' => NULL,
            ),
            21 => 
            array (
                'id' => 28,
                'category_id' => 12,
                'brand_id' => 18,
                'name' => 'Dispenser COSMOS CWD-7601',
                'slug' => 'dispenser-cosmos-cwd-7601',
                'short_description' => NULL,
                'description' => 'Spesifikasi :
- Hot, Fresh, Cold Water
- Dispenser Galon Bawah
- Pelampung Pengaman Ganda
- Cadangan Air 1.7 Liter
- Child Lock
- Lampu Indikator : Air Panas, Air Dingin, Air Habis
- Tombol kran : 3
- Kapasitas Panas : 4 L / jam
- Kapasitas Dingin : 0.55 L / jam
- Daya : 385 Watt
- Garansi : 1 tahun',
                'price' => '550000.00',
                'sale_price' => NULL,
                'stock' => 5,
                'low_stock_threshold' => 5,
                'sku' => NULL,
                'weight' => '800.00',
                'status' => 'active',
                'condition' => 'new',
                'instagram_url' => NULL,
                'views' => 4,
                'is_featured' => 0,
                'created_at' => '2026-06-01 07:54:30',
                'updated_at' => '2026-07-05 14:26:01',
                'deleted_at' => NULL,
            ),
            22 => 
            array (
                'id' => 29,
                'category_id' => 13,
                'brand_id' => 19,
                'name' => 'Magic com PHILIPS  2 lt',
                'slug' => 'magic-com-philips-2-lt',
                'short_description' => NULL,
                'description' => 'Philips Rice Cooker 2L - Premium Plus Silver

ProCeramic Pot with a big handle
Smart 3D heating
48hr keep warm
Big capacity of 2L

Panci bagian dalam dengan gagang anti-panas untuk memudahkan akses
Fungsi tetap hangat otomatis selama 48 jam
Logam paduan ekstra tebal memastikan tiap butir nasi dimasak sempurna
Sistem pemanasan 3D cerdas memasak nasi secara merata
Tutup bagian dalam lepas-pasang yang mudah dibersihkan
Kapasitas ekstra besar 2,0 liter cukup untuk 14 orang
Bodi stainless steel yang awet untuk kinerja tahan lama
Lapisan Bakuhanseki yang canggih 6x lebih',
                'price' => '400000.00',
                'sale_price' => NULL,
                'stock' => 7,
                'low_stock_threshold' => 5,
                'sku' => NULL,
                'weight' => '299.99',
                'status' => 'active',
                'condition' => 'new',
                'instagram_url' => NULL,
                'views' => 0,
                'is_featured' => 0,
                'created_at' => '2026-06-01 07:56:28',
                'updated_at' => '2026-07-05 14:00:40',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}