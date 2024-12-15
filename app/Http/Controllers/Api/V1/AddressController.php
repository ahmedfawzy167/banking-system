<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Addresses\StoreAddressRequest;
use App\Http\Requests\Addresses\UpdateeAddressRequest;
use App\Http\Resources\Addresses\AddressResource;
use App\Traits\ApiResponder;

class AddressController extends Controller
{
    use ApiResponder;

    public function index()
    {
        $addresses = Address::with(['city', 'city.country'])->where('user_id', auth()->user()->id)->get();
        return $this->success(AddressResource::collection($addresses), __('admin.retrieved'));
    }

    public function store(StoreAddressRequest $request)
    {
        $address = new Address();
        $address->street = $request->street;
        $address->city_id = $request->city_id;
        $address->user_id = auth()->user()->id;
        $address->save();
        return $this->created(new AddressResource($address), __('admin.created'));
    }


    public function update(UpdateeAddressRequest $request, Address $address)
    {
        if (auth()->user()->cannot('update', $address)) {
            return $this->forbidden("Access Forbidden");
        }
        $address->street = $request->street;
        $address->city_id = $request->city_id;
        $address->user_id = auth()->user()->id;
        $address->update();
        return $this->success(new AddressResource($address), __('admin.updated'));
    }

    public function destroy(Address $address)
    {
        if (auth()->user()->cannot('delete', $address)) {
            return $this->forbidden("Access Forbidden");
        }
        $address->delete();
        return $this->success(new AddressResource($address), __('admin.deleted'));
    }
}
