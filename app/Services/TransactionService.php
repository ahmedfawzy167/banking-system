<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use App\Exceptions\InsufficientFundsException;
use Illuminate\Support\Str;


class TransactionService
{
    public function __construct(private AccountService $accountService) {}

    public function deposit(Account $account, float $amount, string $description = null): Transaction
    {
        return DB::transaction(function () use ($account, $amount, $description) {
            $newBalance = $account->balance + $amount;
            $this->accountService->updateBalance($account, $newBalance);

            return Transaction::create([
                'account_id' => $account->id,
                'type' => 'deposit',
                'amount' => $amount,
                'balance_after' => $newBalance,
                'reference_number' => $this->generateReferenceNumber(),
                'status' => 'completed',
                'description' => $description,
            ]);
        });
    }

    public function withdraw(Account $account, float $amount, string $description = null): Transaction
    {
        return DB::transaction(function () use ($account, $amount, $description) {
            if ($account->balance < $amount) {
                throw new InsufficientFundsException();
            }

            $newBalance = $account->balance - $amount;
            $this->accountService->updateBalance($account, $newBalance);

            return Transaction::create([
                'account_id' => $account->id,
                'type' => 'withdrawal',
                'amount' => $amount,
                'balance_after' => $newBalance,
                'reference_number' => $this->generateReferenceNumber(),
                'status' => 'completed',
                'description' => $description,
            ]);
        });
    }

    public function transfer(Account $fromAccount, Account $toAccount, float $amount, string $description = null): Transaction
    {
        return DB::transaction(function () use ($fromAccount, $toAccount, $amount, $description) {
            if ($fromAccount->balance < $amount) {
                throw new InsufficientFundsException();
            }

            // Deduct from source account
            $fromNewBalance = $fromAccount->balance - $amount;
            $this->accountService->updateBalance($fromAccount, $fromNewBalance);

            // Add to destination account
            $toNewBalance = $toAccount->balance + $amount;
            $this->accountService->updateBalance($toAccount, $toNewBalance);

            return Transaction::create([
                'account_id' => $fromAccount->id,
                'type' => 'transfer',
                'amount' => $amount,
                'balance_after' => $fromNewBalance,
                'destination_account_id' => $toAccount->id,
                'reference_number' => $this->generateReferenceNumber(),
                'status' => 'completed',
                'description' => $description,
            ]);
        });
    }

    private function generateReferenceNumber(): string
    {
        do {
            $reference = 'TXN-' . strtoupper(Str::random(10));
        } while (Transaction::where('reference_number', $reference)->exists());

        return $reference;
    }
}
