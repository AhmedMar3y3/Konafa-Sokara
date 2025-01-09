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
use App\Notifications\sendVerifyCode;



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

        $user->notify(new sendVerifyCode($user->code));
        return $this->successResponse(new UserResource($user), 'Successfully registered, Please Verify Your email', 201);
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

        if ($user->code !== $request->code) {
            return $this->failureResponse('Invalid code', 400);
        }

        if ($user->isCodeExpired()) {
            return $this->failureResponse('The code is expired', 400);
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
    
        // If the user is active and has completed their info
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
        return $this->successResponse( null,"You've Logged out successfully", 200);
    }
}
