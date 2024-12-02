<?php

namespace App\Http\Resources\Accounts;

use Illuminate\Http\Request;
use App\Http\Resources\Users\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Transactions\TransactionResource;

class AccountResource extends JsonResource
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
            'account_number' => $this->account_number,
            'type' => $this->type,
            'balance' => number_format($this->balance, 2, '.', ''),
            'currency' => $this->currency,
            'is_active' => $this->is_active,
            'created' => $this->created_at->format('Y-m-d H:i:s'),
            'updated' => $this->updated_at->format('Y-m-d H:i:s'),
            'user' => new UserResource($this->whenLoaded('user')),
            'transactions' => TransactionResource::collection($this->whenLoaded('transactions')),
        ];
    }
}
