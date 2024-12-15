<?php

namespace App\Http\Resources\Addresses;

use Illuminate\Http\Request;
use App\Http\Resources\Cities\CityResource;
use App\Http\Resources\Users\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'street' => $this->street,
            'user' => new UserResource($this->whenLoaded('user')),
            'city' => new CityResource($this->whenLoaded('city')),
        ];
    }
}
