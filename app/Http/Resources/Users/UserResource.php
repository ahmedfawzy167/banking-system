<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Request;
use App\Http\Resources\Accounts\AccountResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'accounts' => AccountResource::collection($this->whenLoaded('accounts')),
        ];
    }
}
