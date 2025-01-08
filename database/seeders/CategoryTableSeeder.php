<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        DB::table('categories')->insert([
            [//1
                'name'                            => 'حلوي شرقي',
                'created_at'                      => $now,
                'parent_id'                       => null,
            ], [//2
                'name'                            => 'كيك',
                'created_at'                      => $now,
                'parent_id'                       => null,
            ],[//3
                'name'                            => 'كحك و بسكويت',
                'created_at'                      => $now,
                'parent_id'                       => null,
            ], [//4
                'name'                            => 'مخبوزات',
                'created_at'                      => $now,
                'parent_id'                       => null,
            ],
        ]);

        // الأقسام الفرعية
        DB::table('categories')->insert([
            ['name' => 'البقلاوة','parent_id' => 1,'created_at' => $now],
            ['name' => 'الكنافة','parent_id' => 1,'created_at' => $now],
            ['name' => 'القطايف','parent_id' => 1,'created_at' => $now],
            ['name' => 'الهريسة (البسبوسة)','parent_id' => 1,'created_at' => $now],
            ['name' => 'المشبك','parent_id' => 1,'created_at' => $now],
            ['name' => 'الزلابية','parent_id' => 1,'created_at' => $now],
        ]);

        // الأقسام الفرعية للكيك
        DB::table('categories')->insert([
            ['name' => 'كيك الشوكولاتة','parent_id' => 2,'created_at' => $now],
            ['name' => 'كيك الفانيليا','parent_id' => 2,'created_at' => $now],
            ['name' => 'كيك الفواكه','parent_id' => 2,'created_at' => $now],
            ['name' => 'كيك الجبن (تشيز كيك)','parent_id' => 2,'created_at' => $now],
            ['name' => 'كب كيك','parent_id' => 2,'created_at' => $now],
            ['name' => 'كيك القهوة','parent_id' => 2,'created_at' => $now],
            ['name' => 'كيك الكراميل','parent_id' => 2,'created_at' => $now],
        ]);

        // الأقسام الفرعية للكحك
        DB::table('categories')->insert([
            ['name' => 'كحك السادة', 'parent_id' => 3, 'created_at' => $now],
            ['name' => 'كحك بالملبن', 'parent_id' => 3, 'created_at' => $now],
            ['name' => 'كحك بالعجوة', 'parent_id' => 3, 'created_at' => $now],
            ['name' => 'كحك بالسمسم', 'parent_id' => 3, 'created_at' => $now],
        ]);

        // الأقسام الفرعية للمخبوزات
        DB::table('categories')->insert([
            ['name' => 'الخبز الأبيض', 'parent_id' => 4, 'created_at' => $now],
            ['name' => 'الخبز الأسمر', 'parent_id' => 4, 'created_at' => $now],
            ['name' => 'خبز الباجيت', 'parent_id' => 4, 'created_at' => $now],
            ['name' => 'خبز الصاج', 'parent_id' => 4, 'created_at' => $now],
            ['name' => 'الكرواسون', 'parent_id' => 4, 'created_at' => $now],
            ['name' => 'الفطائر المحلاة', 'parent_id' => 4, 'created_at' => $now],
            ['name' => 'فطائر الجبن', 'parent_id' => 4, 'created_at' => $now],
            ['name' => 'البيتزا الصغيرة', 'parent_id' => 4, 'created_at' => $now],
        ]);

    }
}
