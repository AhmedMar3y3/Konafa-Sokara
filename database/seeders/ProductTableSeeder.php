<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        DB::table('products')->insert([
            // Product 1
            [
                'image'           => 'default.png',
                'name'            => 'بقلاوة بالفستق',
                'description'     => 'حلويات شرقية لذيذة مع طبقة من الفستق',
                'recipe'          => 'دقيق، سكر، فستق، زبدة، ماء ورد',
                'quantity'        => 50,
                'price'           => 15.50,
                'has_discount'    => true,
                'discount_price'  => 12.00,
                'avg_rate'        => 4.5,
                'can_apply_prize'     => true,
                'points'          => '20',
                'category_id'     => 1, // حلوي شرقي
                'sub_category_id' => 5, // البقلاوة
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
        
            // Product 2
            [
                'image'           => 'default.png',
                'name'            => 'كعكة شوكولاتة',
                'description'     => 'كعكة شوكولاتة لذيذة مع صوص شوكولاتة غنية',
                'recipe'          => 'دقيق، سكر، شوكولاتة، زبدة، بيض',
                'quantity'        => 30,
                'price'           => 25.00,
                'has_discount'    => false,
                'discount_price'  => null,
                'avg_rate'        => 4.0,
                'can_apply_prize'     => true,
                'points'          => '50',
                'category_id'     => 2, // كيك
                'sub_category_id' => 11, // كيك الشوكولاتة
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
        
            // Product 3
            [
                'image'           => 'default.png',
                'name'            => 'كحك السادة',
                'description'     => 'كحك سادة محشو بالعجوة',
                'recipe'          => 'دقيق، سكر، سمن، عجوة',
                'quantity'        => 40,
                'price'           => 18.00,
                'has_discount'    => true,
                'discount_price'  => 15.00,
                'avg_rate'        => 4.2,
                'can_apply_prize'     => false,
                'points'          => null,
                'category_id'     => 3, // كحك و بسكويت
                'sub_category_id' => 18, // كحك السادة
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
        
            // Product 4
            [
                'image'           => 'default.png',
                'name'            => 'خبز باجيت',
                'description'     => 'خبز باجيت طازج وذو قشرة مقرمشة',
                'recipe'          => 'دقيق، ماء، ملح، خميرة',
                'quantity'        => 100,
                'price'           => 8.00,
                'has_discount'    => false,
                'discount_price'  => null,
                'avg_rate'        => 4.7,
                'can_apply_prize'     => false,
                'points'          => null,
                'category_id'     => 4, // مخبوزات
                'sub_category_id' => 24, // خبز الباجيت
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
            // Product 5
            [
                'image'           => 'default.png',
                'name'            => 'كعك الفانيليا',
                'description'     => 'كعك فانيليا لذيذ مع طعم غني',
                'recipe'          => 'دقيق، سكر، زبدة، بيض، فانيليا',
                'quantity'        => 70,
                'price'           => 12.00,
                'has_discount'    => true,
                'discount_price'  => 10.00,
                'avg_rate'        => 4.3,
                'can_apply_prize'     => true,
                'points'          => '15',
                'category_id'     => 2, // كيك
                'sub_category_id' => 12, // كيك الفانيليا
                'created_at'      => $now,
                'updated_at'      => $now,
            ],

            // Product 6
            [
                'image'           => 'default.png',
                'name'            => 'كيك الفواكه',
                'description'     => 'كيك مغطى بالفواكه الطازجة',
                'recipe'          => 'دقيق، سكر، فواكه، بيض، زبدة',
                'quantity'        => 35,
                'price'           => 22.00,
                'has_discount'    => false,
                'discount_price'  => null,
                'avg_rate'        => 4.6,
                'can_apply_prize'     => false,
                'points'          => null,
                'category_id'     => 2, // كيك
                'sub_category_id' => 13, // كيك الفواكه
                'created_at'      => $now,
                'updated_at'      => $now,
            ],

            // Product 7
            [
                'image'           => 'default.png',
                'name'            => 'كرواسون بالشوكولاتة',
                'description'     => 'كرواسون هش مع حشوة شوكولاتة غنية',
                'recipe'          =>'دقيق، زبدة، شوكولاتة، سكر',
                'quantity'        => 60,
                'price'           => 18.50,
                'has_discount'    => true,
                'discount_price'  => 15.50,
                'avg_rate'        => 4.8,
                'can_apply_prize'     => true,
                'points'          => '20',
                'category_id'     => 4, // مخبوزات
                'sub_category_id' => 26, // الكرواسون
                'created_at'      => $now,
                'updated_at'      => $now,
            ],

            // Product 8
            [
                'image'           => 'default.png',
                'name'            => 'فطائر الجبن',
                'description'     => 'فطائر محشوة بالجبن اللذيذ',
                'recipe'          => 'دقيق، جبن، زبدة، ملح',
                'quantity'        => 80,
                'price'           => 10.00,
                'has_discount'    => false,
                'discount_price'  => null,
                'avg_rate'        => 4.4,
                'can_apply_prize'     => false,
                'points'          => null,
                'category_id'     => 4, // مخبوزات
                'sub_category_id' => 28, // فطائر الجبن
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
        ]);
    }
}
