<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\Auth\ResendCodeRequest;
use App\Http\Requests\user\Auth\LoginUserRequest;
use App\Http\Requests\user\Auth\RegisterRequest;
use App\Http\Requests\user\Auth\VerifyUserRequest;
use App\Http\Requests\user\Auth\LocationRequest;
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
    public function verifyEmail(VerifyUserRequest $request)
    {
        $request->validated();

        $user = User::where('phone', $request->phone)->first();

        if (!$user) {
            return $this->failureResponse('المستخدم غير موجود');
        }

        if ($user->code !== $request->code) {
            return $this->failureResponse('كود غير صحيح');
        }

        if ($user->isCodeExpired()) {
            return $this->failureResponse('كود منتهي الصلاحية');
        }

        $user->markAsVerified();
        $token = $user->login();
        return $this->successWithDataResponse(UserResource::make($user)->setToken($token));
    }


    // Resend verification code
    public function resendCode(ResendCodeRequest $request)
    {
        $request->validated();
        $user = User::where('phone', $request->phone)->first();

        if (!$user) {
            return $this->failureResponse('المستخدم غير موجود');
        }

        if (!$user->isCodeExpired()) {
            return $this->failureResponse('لم تمر دقيقة بعد');
        }

        $user->sendVerificationCode();
        return $this->successWithDataResponse('');
    }

    //Login User
    public function login(LoginUserRequest $request)
    {
        $request->validated();
        $user = User::where('phone', $request->phone)->first();

        if (!$user || !Hash::check($request->input('password'), $user->password)) {
            return $this->failureResponse('بيانات الدخول غير صحيحة');
        }

        $token = $user->login();

        if (!$user->is_active) {
            return $this->inactiveUserResponse(UserResource::make($user)->setToken($token));
        }

        if (!$user->completed_info) {
            return $this->incompletedUserResponse(UserResource::make($user)->setToken($token));
        }

        return $this->successWithDataResponse(UserResource::make($user)->setToken($token));
    }

    public function setLocation(LocationRequest $request)
    {
        $user = auth()->user();
        $user->updateLocation($request->lat, $request->lng, $request->map_desc);
        $token = $user->login();
        return $this->successWithDataResponse(UserResource::make($user)->setToken($token));
    }

    //Logout User
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->successWithMessageResponse('تم تسجيل الخروج بنجاح');
    }
}
