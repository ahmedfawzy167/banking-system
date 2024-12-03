<?php

namespace App\Http\Controllers\Api;

use App\Models\Account;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Events\TransactionOccured;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\TransactionService;
use App\Http\Requests\Transaction\TransferRequest;
use App\Http\Resources\Transactions\TransactionResource;
use App\Http\Resources\Transactions\TransactionCollection;

class TransactionController extends Controller
{
    use ApiResponder;

    public function __construct(private TransactionService $transactionService) {}


    public function deposit(Account $account, Request $request)
    {
        if (auth()->user()->cannot('update', $account)) {
            return $this->forbidden('You are not Authorized to make Deposits to this Account');
        }

        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'min:0.01'],
            'description' => ['nullable', 'string', 'max:255'],
        ]);

        DB::beginTransaction();
        try {
            $transaction = $this->transactionService->deposit(
                $account,
                $validated['amount'],
                $validated['description'] ?? null
            );

            $account->refresh();

            // Dispatch Transaction Event
            event(new TransactionOccured(
                $transaction,
                'deposit',
                "Deposit of {$validated['amount']} Completed Successfully to Account {$account->account_number}. New balance: {$account->balance}"
            ));

            DB::commit();
            return $this->created(
                new TransactionResource($transaction),
                'Deposit Completed Successfully'
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->serverError($e->getMessage());
        }
    }

    public function withdraw(Account $account, Request $request)
    {
        if (auth()->user()->cannot('update', $account)) {
            return $this->forbidden('You are not Authorized to make Withdrawals from this Account');
        }

        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'min:0.01'],
            'description' => ['nullable', 'string', 'max:255'],
        ]);

        DB::beginTransaction();

        try {
            $transaction = $this->transactionService->withdraw(
                $account,
                $validated['amount'],
                $validated['description'] ?? null
            );

            $account->refresh();
            // Dispatch transaction event
            event(new TransactionOccured(
                $transaction,
                'withdrawal',
                "Withdrawal of {$validated['amount']} Completed Successfully From Account {$account->account_number}. New balance: {$account->balance}"
            ));

            DB::commit();
            return $this->created(
                new TransactionResource($transaction),
                'Withdrawal Completed Successfully'
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->serverError('Failed to Process Withdrawal');
        }
    }

    public function transfer(Account $account, TransferRequest $request)
    {
        if (auth()->user()->cannot('update', $account)) {
            return $this->forbidden('You are not Authorized to Make Transfers from this Account');
        }

        DB::beginTransaction();
        try {
            $destinationAccount = Account::where('account_number', $request->destination_account_number)->firstOrFail();

            $transaction = $this->transactionService->transfer(
                $account,
                $destinationAccount,
                $request->amount,
                $request->description
            );

            $account->refresh();

            // Dispatch Transaction Event
            event(new TransactionOccured(
                $transaction,
                'transfer',
                "Transfer of {$request->amount} Completed Successfully From Account {$account->account_number} To {$destinationAccount->account_number}. New balance: {$account->balance}"
            ));

            DB::commit();
            return $this->created(
                new TransactionResource($transaction),
                'Transfer Completed Successfully'
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->serverError($e->getMessage());
        }
    }

    public function history(Account $account)
    {
        if (auth()->user()->cannot('view', $account)) {
            return $this->forbidden('You are not Authorized to View this Account\'s Transaction History');
        }

        $transactions = $account->transactions()
            ->with(['destinationAccount'])
            ->latest()
            ->paginate(5);

        return $this->success(
            new TransactionCollection($transactions),
            'Transaction History Retrieved Successfully'
        );
    }
}
