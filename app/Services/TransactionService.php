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

            // Create Debit Transaction for Sender
            $debitTransaction = Transaction::create([
                'account_id' => $fromAccount->id,
                'type' => 'transfer',
                'amount' => -$amount,
                'balance_after' => $fromNewBalance,
                'destination_account_id' => $toAccount->id,
                'status' => 'completed',
                'description' => $description,
            ]);

            // Add to Destination Account
            $toNewBalance = $toAccount->balance + $amount;
            $this->accountService->updateBalance($toAccount, $toNewBalance);

            // Create credit transaction for receiver
            Transaction::create([
                'account_id' => $toAccount->id,
                'type' => 'transfer',
                'amount' => $amount,
                'balance_after' => $toNewBalance,
                'source_account_id' => $fromAccount->id,
                'status' => 'completed',
                'description' => $description,
            ]);

            return $debitTransaction;
        });
    }
}
