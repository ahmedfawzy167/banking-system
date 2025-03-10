<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Events\UserRegistered;
use App\Services\WhatsAppService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Users\UserResource;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\UpdateProfileRequest;
use App\Http\Requests\Auth\UpdatePasswordRequest;

class AuthController extends Controller
{
    use ApiResponder;

    public function register(RegisterRequest $request, WhatsAppService $whatsappService)
    {
        $otp = rand(100000, 999999); 

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'otp' => Hash::make($otp),
        ]);

        // Send OTP via WhatsApp
        $response = $whatsappService->sendWhatsAppOTP($user->phone_number, $otp);

       if ($response['status'] !== 'success') {
        return $this->serverError('Failed to Send OTP');
       }
        
        // Fire the Event
        event(new UserRegistered($user));

        return $this->created(new UserResource($user), __('admin.register'));
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->unauthorized('Invalid credentials');
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->success([
            'user' => new UserResource($user),
            'token' => $token,
        ], __('admin.login'));
    }

    public function logout(Request $request)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return $this->notFound("Token Not Found");
        }

        $user = $request->user();

        if ($user->currentAccessToken()) {
            $user->currentAccessToken()->delete();
        }
        return $this->success(new UserResource($user), __('admin.logout'));
    }

    public function profile(Request $request)
    {
        $user = $request->user();
        return $this->success(new UserResource($user), __('admin.profile'));
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = request()->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return $this->success(new UserResource($user), __('admin.update_profile'));
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = request()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return $this->error("Password Incorrect");
        }
        $user->password = Hash::make($request->new_password);
        $user->save();
        return $this->success(new UserResource($user), __('update_password'));
    }
}
