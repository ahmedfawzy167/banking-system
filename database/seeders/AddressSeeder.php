<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\User;
use App\Models\Address;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $addresses = [];

        $users = User::pluck('id')->toArray();
        $cities = City::pluck('id')->toArray();

        for ($i = 0; $i < 50; $i++) {
            $addresses[] = [
                'street' => fake()->streetAddress(),
                'user_id' => fake()->randomElement($users),
                'city_id' => fake()->randomElement($cities),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Address::insert($addresses);
    }
}
