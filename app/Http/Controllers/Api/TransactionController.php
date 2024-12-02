<?php

namespace App\Http\Controllers\Api;

use App\Models\Account;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\TransactionService;
use App\Exceptions\InsufficientFundsException;
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

        try {
            $transaction = $this->transactionService->deposit(
                $account,
                $validated['amount'],
                $validated['description'] ?? null
            );

            return $this->success(
                new TransactionResource($transaction),
                'Deposit Completed Successfully'
            );
        } catch (\Exception $e) {
            return $this->serverError('Failed to Process Deposit');
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

        try {
            $transaction = $this->transactionService->withdraw(
                $account,
                $validated['amount'],
                $validated['description'] ?? null
            );

            return $this->success(
                new TransactionResource($transaction),
                'Withdrawal Completed Successfully'
            );
        } catch (InsufficientFundsException $e) {
            return $this->error('Insufficient funds for this Withdrawal', 422);
        } catch (\Exception $e) {
            return $this->serverError('Failed to Process Withdrawal');
        }
    }

    public function transfer(Account $account, TransferRequest $request)
    {
        if (auth()->user()->cannot('update', $account)) {
            return $this->forbidden('You are not Authorized to Make Transfers from this Account');
        }

        try {
            $destinationAccount = Account::where('account_number', $request->destination_account_number)->firstOrFail();

            $transaction = $this->transactionService->transfer(
                $account,
                $destinationAccount,
                $request->amount,
                $request->description
            );

            return $this->success(
                new TransactionResource($transaction),
                'Transfer Completed Successfully'
            );
        } catch (InsufficientFundsException $e) {
            return $this->error('Insufficient Funds for this Transfer', 422);
        } catch (\Exception $e) {
            return $this->serverError('Failed to Process Transfer');
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
