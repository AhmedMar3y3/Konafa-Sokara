<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'delivery_price',
                'value' => 50,
            ],
            [
                'key' => 'points_per_sar',
                'value' => 2,
            ],
            [
                'key' => 'points_per_friend_invitation',
                'value' => 10,
            ],
            [
                'key' => 'points_per_app_rating',
                'value' => 10,
            ],
        ];

        DB::table('settings')->insert($settings);
    }
}
