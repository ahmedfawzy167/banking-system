<?php

namespace App\Http\Controllers\Api;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Services\AccountService;
use App\Http\Controllers\Controller;
use App\Http\Resources\Accounts\AccountResource;
use App\Http\Resources\Accounts\AccountCollection;
use App\Http\Requests\Account\CreateAccountRequest;
use App\Traits\ApiResponder;

class AccountController extends Controller
{
    use ApiResponder;

    public function __construct(private AccountService $accountService) {}

    public function index()
    {
        $accounts = auth()->user()->accounts()->with('transactions')->get();

        return $this->success(
            new AccountCollection($accounts),
            'Accounts Retrieved Successfully'
        );
    }

    public function store(CreateAccountRequest $request)
    {
        $account = $this->accountService->createAccount([
            'user_id' => auth()->id(),
            'type' => $request->type,
            'currency' => $request->currency,
            'is_active' => 1,
        ]);

        return $this->created(
            new AccountResource($account),
            'Account Created Successfully'
        );
    }

    public function show(Account $account)
    {
        if (auth()->user()->cannot('view', $account)) {
            return $this->forbidden('You are Not Authorized to View This Account');
        }

        return $this->success(
            new AccountResource($account->load('transactions')),
            'Account Details Retrieved Successfully'
        );
    }

    public function getBalance(Account $account)
    {
        if (auth()->user()->cannot('view', $account)) {
            return $this->forbidden('You are not Authorized to View this Account Balance');
        }

        return $this->success([
            'balance' => number_format($this->accountService->getAccountBalance($account), 2, '.', ''),
            'currency' => $account->currency,
        ], 'Account Balance Retrieved Successfully');
    }
}
