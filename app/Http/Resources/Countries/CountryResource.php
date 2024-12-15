<?php

namespace App\Http\Resources\Countries;

use Illuminate\Http\Request;
use App\Http\Resources\Cities\CityResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
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
            'code' => $this->code,
            'cities' => CityResource::collection($this->whenLoaded('cities')),
        ];
    }
}
