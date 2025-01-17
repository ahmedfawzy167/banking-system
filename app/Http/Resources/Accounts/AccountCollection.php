<?php

namespace App\Http\Resources\Accounts;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AccountCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'accounts' => $this->collection,
            'meta' => [
                'total_accounts' => $this->collection->count(),
                'total_balance' => number_format($this->collection->sum('balance'), 2, '.', ''),
            ],
        ];
    }
}
