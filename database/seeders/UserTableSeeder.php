<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('AR_SA');
        $data = [];
        for ($i = 10; $i < 40 ; $i++) {
            $data[$i] = [
                'first_name'            => $faker->firstName(),
                'last_name'             => $faker->lastName(),
                'phone'                 => "51111111$i",
                'email'                 => $faker->unique()->email,
                'password'              => bcrypt('123456789'),
                'owned_referral_code'   => $faker->unique()->randomNumber(6),
                'birth_date'            => $faker->date(),
            ];
        }
        User::insert($data);
    }
}
