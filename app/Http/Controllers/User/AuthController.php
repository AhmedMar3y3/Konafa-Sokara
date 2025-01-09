<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\Auth\RegisterRequest;
use App\Http\Requests\user\location;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\HttpResponses;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponses;

    // Register user
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());

        $user->sendVerificationCode();

        return $this->successWithDataResponse(new UserResource($user));
    }

    // Verify email
    public function verifyEmail(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'code' => 'required|string',
        ]);

        $user = User::where('phone', $request->phone)->first();

        if (!$user) {
            return $this->failureResponse('User not found');
        }

        if ($user->code !== $request->code) {
            return $this->failureResponse('Invalid code');
        }

        if ($user->isCodeExpired()) {
            return $this->failureResponse('The code is expired');
        }

        $user->markAsVerified();
        $token = $user->createToken('user-token')->plainTextToken;

        return $this->successWithDataResponse(UserResource::make($user)->setToken($token));
    }


    // Resend verification code
    public function resendCode(Request $request)
    {
        $request->validate(['phone' => 'required|string']);
        $user = User::where('phone', $request->phone)->first();

        if (!$user) {
            return $this->failureResponse('User not found', 404);
        }

        if (!$user->isCodeExpired()) {
            return $this->failureResponse('Code is still valid', 400);
        }

        $user->sendVerificationCode();

        return $this->successResponse(null, 'Code resent successfully');
    }



    //Login User
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return $this->failureResponse('User not found', 404);
        }

        if (!Hash::check($request->password, $user->password)) {
            return $this->failureResponse('Invalid credentials', 401);
        }

        $token = $user->createToken('user-token')->plainTextToken;

        if (!$user->is_active) {
            return $this->successResponse([
                'user' => new UserResource($user),
            ], 'Account is not active', 200, 'ActivationNeeded');
        }

        if (!$user->completed_info) {
            return $this->successResponse([
                'user' => new UserResource($user),
                'token' => $token,
            ], 'Please complete your information', 200, 'CompletionNeeded');
        }

        return $this->successResponse([
            'user' => new UserResource($user),
            'token' => $token,
        ], 'Login successful', 200);
    }

    public function setLocation(location $request)
    {
        $user = auth()->user();
        $user->updateLocation($request->lat, $request->lng, $request->map_desc);
        return $this->successResponse(new UserResource($user), 'Location updated successfully');
    }

    //Logout User
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->successResponse('null', "You've Logged out successfully", 200);
    }
}
