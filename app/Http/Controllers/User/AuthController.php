<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\location;
use App\Http\Requests\user\register;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\HttpResponses;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    use HttpResponses;

    // Register user
    public function register(register $request)
{
    $validatedData = $request->validated();

    $validatedData['code'] = '123456';
    $validatedData['code_expire'] = now()->addMinutes(1);
    $validatedData['owned_referral_code'] = User::generateReferralCode();

    $user = User::create($validatedData);

    return $this->successResponse(new UserResource($user), 'User registered successfully', 201);
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
        return $this->failureResponse('User not found', 404);
    }

    if ($user->code !== $request->code || $user->isCodeExpired()) {
        return $this->failureResponse('Invalid or expired code', 400);
    }

    $user->markAsVerified();

    return $this->successResponse(new UserResource($user), 'Email verified successfully');
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

    $user->resendVerificationCode();

    return $this->successResponse(null, 'Code resent successfully');
}

public function setLocation(location $request)
{
    $user = Auth::user();
    $user->updateLocation($request->lat, $request->lng, $request->map_desc);
    return $this->successResponse(new UserResource($user), 'Location updated successfully');
}

// public function verifyEmail(Request $request)

// {
//     $request->validate([
//         'phone' => 'required|string',
//         'code' => 'required|string',
//     ]);

//     $user = User::where('phone', $request->phone)->first();

//     if (!$user) {
//         return $this->failureResponse('User not found', 404);
//     }

//     if ($user->code !== $request->code) {
//         return $this->failureResponse('Invalid code', 400);
//     }

//     if ($user->code_expire < now()) {
//         return $this->failureResponse('Code expired', 400);
//     }

//     $user->update([
//         'is_active' => true,
//         'is_verified' => true,
//         'code' => null,
//         'code_expire' => null,
//     ]);

//     return $this->successResponse(new UserResource($user), 'Email verified successfully');
// }

// public function resendCode(Request $request)
// {
//     $request->validate([
//         'phone' => 'required|string',
//     ]);

//     $user = User::where('phone', $request->phone)->first();

//     if (!$user) {
//         return $this->failureResponse('User not found', 404);
//     }

//     if ($user->code_expire && $user->code_expire > now()) {
//         return $this->failureResponse('Code is still valid', 400);
//     }

//     $user->update([
//         'code' => '123456',
//         'code_expire' => now()->addMinutes(1),
//     ]);

//     return $this->successResponse(null, 'Code resent successfully');
// }

// public function setLocation(location $request)
// {
//     $request->validated();
//     $user = Auth::user();
//     $user->update([
//         'lat' => $request->lat,
//         'lng' => $request->lng,
//         'map_desc' => $request->map_desc,
//         'completed_info' => true,
//         'owned_referral_code' => Str::random(8),
//     ]);
//     return $this->successResponse(new UserResource($user), 'Location updated successfully');
// }

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

    if (!$user->is_active) {
        return $this->failureResponse('Account is not active', 401);
    }

    if (!$user->completed_info) {
        return $this->failureResponse('Please complete your info', 401);
    }

    $token = $user->createToken('user-token')->plainTextToken;

    return $this->successResponse([
        'user' => new UserResource($user),
        'token' => $token,
    ], 'Login successful');
}
}
