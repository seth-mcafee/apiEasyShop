<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menClothesCategoryId = DB::table('categories')->where('name', 'Men Clothes')->first()->id;
        $laptopsCategoryId = DB::table('categories')->where('name', 'Laptops')->first()->id;
        $sellerId = DB::table('sellers')->where('name', 'Sharan')->first()->id;

        DB::table('products')->insert([
            /*First 5 products, smartphones */
            [
                'name' => 'SAMSUNG Galaxy Z Fold 5',
                'description' => 'Azul, 1 TB, 12 GB RAM, 7,6 ", Dynamic AMOLED 2X,Gorilla Glass Victus 2,120 Hz, Octa Core, 4400 mAh, Android',
                'price' => 2564.20,
                'quantity' => 5,
                'image_url' => 'SAMSUNG_GALAXY_Z_FOLD_5.webp',
                'seller_id'=> $sellerId,
                'category_id' => $menClothesCategoryId,
                'created_at' => now(),
                'updated_at' => now(),
            ], 
            [
                'name' => 'Apple iPhone 16 Pro Max',
                'description' => 'Titanio Desierto, 1 TB, 5G, 6.9 " OLED Super Retina XDR, Chip A18 Pro, iOS',
                'price' => 1969.00,
                'quantity' => 5,
                'image_url'=> 'APPLE_IPHONE_16_PRO_MAX.webp',
                'seller_id'=> $sellerId,
                'category_id' => $laptopsCategoryId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'HUAWEI Pura 70 Pro',
                'description' => 'Negro, 512 GB, 12 GB RAM, 6,8 ", Kirin 9010 (7 nm), EMUI',
                'price' => 1114.76,
                'quantity' => 5,
                'image_url'=> 'HUAWEI_PURA_70_PRO.webp',
                'seller_id'=> $sellerId,
                'category_id' => $laptopsCategoryId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Google Pixel 9 Pro XL',
                'description' => 'Obsidiana, 1 TB, 16 GB RAM, 6.8 " OLED LTPO, Google Tensor G4, 4700 mAh, Android 14',
                'price' => 1689.00,
                'quantity' => 5,
                'image_url'=> 'GOOGLE_PIXEL_9 PRO_XL.webp',
                'seller_id'=> $sellerId,
                'category_id' => $laptopsCategoryId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Xiaomi 14T Pro',
                'description' => 'Titanium Black, 1 TB, 12 GB RAM, 6.67" 1.5K, Mediateck Dimensity 9300+, 5000 mAh, Android-HyperOS',
                'price' => 1000.00,
                'quantity' => 5,
                'image_url'=> 'XIAOMI_14T_PRO.webp',
                'seller_id'=> $sellerId,
                'category_id' => $laptopsCategoryId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            /*Second row 5 products LAPTOPS */
            [
                'name' => 'Apple MacBook Pro (2024)',
                'description' => '16-inch² Liquid Retina XDR display
                Nanotextured screen
                Apple M4 Max chip with 16-core CPU, 40-core GPU, and 16-core Neural Engine
                128 GB of unified memory
                8TB SSD storage
                140W USB-C Power Adapter
                Three Thunderbolt 5 ports, HDMI port, SDXC card slot, headphone jack and MagSafe 3 port
                Backlit Magic Keyboard with Touch ID - Spanish
                Final Cut Pro
                Logic Pro',
                'price' => 9178.98,
                'quantity' => 5,
                'image_url'=> 'APPLE_MACBOOK_PRO.webp',
                'seller_id'=> $sellerId,
                'category_id' => $laptopsCategoryId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dell Precision 5000 5770',
                'description' => '17" Mobile Workstation, Full HD Plus, 1920 x 1200, 12th Gen Intel Core i7 i7-12800H, Tetradeca-core (14 cores) @ 2.40GHz, 32GB Total RAM, SSD',
                'price' => 2836.98,
                'quantity' => 5,
                'image_url'=> 'DELL_LAPTOP.webp',
                'seller_id'=> $sellerId,
                'category_id' => $laptopsCategoryId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lenovo Legion Pro 7 16IRX8H',
                'description' => '16" WQXGA, Intel® Core™ i9-13900HX, 32GB RAM, 1TB SSD, GeForce RTX™ 4080, Windows 11 Home',
                'price' => 3400.00,
                'quantity' => 5,
                'image_url'=> 'LENOVO_LEGION_PRO_7.webp',
                'seller_id'=> $sellerId,
                'category_id' => $laptopsCategoryId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ASUS ZenBook DUO OLED 2024',
                'description' => '14" WQXGA+ 120Hz (Intel Core Ultra 9 185H, 32GB RAM, 1TB SSD, ARC Graphics, Windows 11 Home) Gray Inkwell - Spanish QWERTY keyboard',
                'price' => 2299.00,
                'quantity' => 5,
                'image_url'=> 'ASUS_ZENBOOK_DUO_OLED.webp',
                'seller_id'=> $sellerId,
                'category_id' => $laptopsCategoryId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'HP 863J4ET',
                'description' => '16 " WQUXGA, Intel Core i9-13900H, 32 GB RAM, 1 TB SSD, GeForce RTX™ 4080, Windows 11 Pro (64 Bit)',
                'price' => 4218.10,
                'quantity' => 5,
                'image_url'=> 'HP_863J4ET.jpg',
                'seller_id'=> $sellerId,
                'category_id' => $laptopsCategoryId,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            /*Third row 5 products MINI PCs */
            [
                'name' => 'MAC MINI',
                'description' => 'Apple M4 Pro chip with 12-core CPU, 16-core GPU, and 16-core Neural Engine, 64 GB of unified memory, 8TB SSD storage, 10 Gigabit Ethernet, Three Thunderbolt 5 ports, one HDMI port, two USB-C ports, and headphone jack, Final Cut Pro, Logic Pro',
                'price' => 2399.00,
                'quantity' => 5,
                'image_url'=> 'MAC_MINI.jpeg',
                'seller_id'=> $sellerId,
                'category_id' => $laptopsCategoryId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'HP Victus TG02-0013ns',
                'description' => 'AMD Ryzen™ 7 5700G, 32GB RAM, 1TB SSD, Gráficos RTX™ 4060, Windows 11 H, Plata',
                'price' => 1399.00,
                'quantity' => 5,
                'image_url'=> 'HP_VICTUS.webp',
                'seller_id'=> $sellerId,
                'category_id' => $laptopsCategoryId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Acer Predator PO3-655',
                'description' => ' Intel® Core™ i7-14700F, 16GB RAM, 1TB SSD, GeForce RTX™ 4060, Windows 11 Home, Negro',
                'price' => 1349.00,
                'quantity' => 5,
                'image_url'=> 'ACER_PREDATOR.webp',
                'seller_id'=> $sellerId,
                'category_id' => $laptopsCategoryId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'HP OMEN GT14-2001ns',
                'description' => 'Intel® Core™ i7-14700F, 32GB RAM, 1TB SSD, RTX™ 4070, Windows 11 H, Black',
                'price' => 1349.00,
                'quantity' => 5,
                'image_url'=> 'HP_OMEN.webp',
                'seller_id'=> $sellerId,
                'category_id' => $laptopsCategoryId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'MSI MAG Infinite S3 14NUE7-1834ES',
                'description' => ' Intel® Core™ i7-14700F, 32GB RAM, 1TB SSD+2TB HDD, GeForce RTX™ 4070 Super™, Windows 11 Home Advanced',
                'price' => 1749.00,
                'quantity' => 5,
                'image_url'=> 'MSI_MAG.webp',
                'seller_id'=> $sellerId,
                'category_id' => $laptopsCategoryId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]
        );
    }
}
