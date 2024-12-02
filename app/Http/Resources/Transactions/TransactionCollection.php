<?php

namespace App\Http\Resources\Transactions;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TransactionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'transactions' => $this->collection,
            'meta' => [
                'total_transactions' => $this->collection->count(),
                'total_amount' => number_format($this->collection->sum('amount'), 2, '.', ''),
            ],
        ];
    }
}
