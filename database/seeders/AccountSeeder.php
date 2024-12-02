<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Account;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            Account::create([
                'user_id' => $user->id,
                'account_number' => date('Y') . str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT),
                'type' => 'savings',
                'balance' => 1000.00,
                'currency' => 'USD',
            ]);

            Account::create([
                'user_id' => $user->id,
                'account_number' => date('Y') . str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT),
                'type' => 'checking',
                'balance' => 500.00,
                'currency' => 'USD',
            ]);
        }
    }
}
