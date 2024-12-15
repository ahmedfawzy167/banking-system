<?php

namespace App\Http\Resources\Cities;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Addresses\AddressResource;
use App\Http\Resources\Countries\CountryResource;

class CityResource extends JsonResource
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
            'name' => $this->{'name_' . request()->header('lang')},
            'country_id' => $this->country_id,
            'country' => new CountryResource($this->whenLoaded('country')),
            'addresses' => AddressResource::collection($this->whenLoaded('addresses')),
        ];
    }
}
