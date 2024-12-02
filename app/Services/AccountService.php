<?php

namespace App\Services;

use App\Models\Account;
use Illuminate\Support\Str;

class AccountService
{
    public function createAccount(array $data): Account
    {
        $data['account_number'] = $this->generateAccountNumber();
        return Account::create($data);
    }

    public function getAccountBalance(Account $account): float
    {
        return $account->balance;
    }

    public function updateBalance(Account $account, float $newBalance): void
    {
        $account->update(['balance' => $newBalance]);
    }

    private function generateAccountNumber(): string
    {
        do {
            $number = date('Y') . str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        } while (Account::where('account_number', $number)->exists());

        return $number;
    }
}
