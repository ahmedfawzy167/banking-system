<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Settings\SettingResource;
use App\Models\Setting;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use ApiResponder;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::all();
        return $this->success(SettingResource::collection($settings), "Setting Retrieved Successfully");
    }
}
