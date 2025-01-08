<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdditionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

    DB::table('additions')->insert([
        // Additions for "حلوي شرقي"
        ['name' => 'شوكولاتة إضافية', 'price' => 5.00, 'category_id' => 5, 'created_at' => $now, 'updated_at' => $now],
        ['name' => 'مكسرات إضافية', 'price' => 4.00, 'category_id' => 5, 'created_at' => $now, 'updated_at' => $now],
        ['name' => 'كريمة إضافية', 'price' => 3.50, 'category_id' => 6, 'created_at' => $now, 'updated_at' => $now],
        ['name' => 'فاكهة إضافية', 'price' => 4.50, 'category_id' => 7, 'created_at' => $now, 'updated_at' => $now],
        ['name' => 'مربى إضافي', 'price' => 2.50, 'category_id' => 8, 'created_at' => $now, 'updated_at' => $now],
        ['name' => 'سكر إضافي', 'price' => 2.00, 'category_id' => 8, 'created_at' => $now, 'updated_at' => $now],
        
        // Additions for "كيك"
        ['name' => 'شوكولاتة إضافية', 'price' => 6.00, 'category_id' => 9, 'created_at' => $now, 'updated_at' => $now],
        ['name' => 'كريمة فانيليا', 'price' => 3.00, 'category_id' => 9, 'created_at' => $now, 'updated_at' => $now],
        ['name' => 'فاكهة إضافية', 'price' => 4.50, 'category_id' => 10, 'created_at' => $now, 'updated_at' => $now],
        ['name' => 'كريمة جبن', 'price' => 5.00, 'category_id' => 12, 'created_at' => $now, 'updated_at' => $now],
        
        // Additions for "كحك و بسكويت"
        ['name' => 'سكر إضافي', 'price' => 2.00, 'category_id' => 13, 'created_at' => $now, 'updated_at' => $now],
        ['name' => 'مربى ملون', 'price' => 2.50, 'category_id' => 14, 'created_at' => $now, 'updated_at' => $now],
        ['name' => 'عجوة إضافية', 'price' => 3.00, 'category_id' => 15, 'created_at' => $now, 'updated_at' => $now],
        ['name' => 'سمسم إضافي', 'price' => 1.50, 'category_id' => 16, 'created_at' => $now, 'updated_at' => $now],
        
        // Additions for "مخبوزات"
        ['name' => 'زيتون', 'price' => 2.00, 'category_id' => 17, 'created_at' => $now, 'updated_at' => $now],
        ['name' => 'جبن', 'price' => 3.00, 'category_id' => 18, 'created_at' => $now, 'updated_at' => $now],
        ['name' => 'ثوم وزعتر', 'price' => 1.80, 'category_id' => 19, 'created_at' => $now, 'updated_at' => $now],
        ['name' => 'لبنة', 'price' => 2.50, 'category_id' => 20, 'created_at' => $now, 'updated_at' => $now],
    ]);
    }
}
