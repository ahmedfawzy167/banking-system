<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\City;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Cities\CityResource;

class CityController extends Controller
{
    use ApiResponder;

    public function index()
    {
        $cities = City::with('country')->get();
        return $this->success(CityResource::collection($cities), __('admin.list_city'));
    }

    public function show(City $city)
    {
        return $this->success(new CityResource($city->load('country')), __('admin.view_city'));
    }
}
