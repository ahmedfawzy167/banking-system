<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Users\UserResource;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\UpdatePasswordRequest;
use App\Http\Requests\Auth\UpdateProfileRequest;

class AuthController extends Controller
{
    use ApiResponder;

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Dispatch the UserRegistered Event
        event(new UserRegistered($user));

        return $this->created(new UserResource($user), "Registeration is Done");
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
        ], 'Login Successfully');
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
        return $this->success(new UserResource($user), "Logout Successfully");
    }

    public function profile(Request $request)
    {
        $user = $request->user();
        return $this->success(new UserResource($user), "Profile Retrieved Successfully");
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = request()->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return $this->success(new UserResource($user), "Profile Updated Successfully");
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = request()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return $this->error("Password Incorrect");
        }
        $user->password = Hash::make($request->new_password);
        $user->save();
        return $this->success(new UserResource($user), "Password Updated Successfully");
    }
}
