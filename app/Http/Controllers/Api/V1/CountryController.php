<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Countries\CountryResource;
use App\Traits\ApiResponder;

class CountryController extends Controller
{
    use ApiResponder;

    public function index()
    {
        $countries = Country::all();
        return $this->success(CountryResource::collection($countries), __('admin.list_country'));
    }

    public function show(Country $country)
    {
        return $this->success(new CountryResource($country), __('admin.view_country'));
    }
}
