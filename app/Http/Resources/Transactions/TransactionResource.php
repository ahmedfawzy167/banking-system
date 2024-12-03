<?php

namespace App\Http\Resources\Transactions;

use Illuminate\Http\Request;
use App\Http\Resources\Accounts\AccountResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'amount' => number_format($this->amount, 2, '.', ''),
            'balance_after' => number_format($this->balance_after, 2, '.', ''),
            'status' => $this->status,
            'description' => $this->description,
            'account' => new AccountResource($this->whenLoaded('account')),
            'destination_account' => new AccountResource($this->whenLoaded('destinationAccount')),
            'created' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
