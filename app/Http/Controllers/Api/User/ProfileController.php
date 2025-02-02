<?php

namespace App\Http\Controllers\Api\User;

use App\Models\Faq;
use App\Traits\HttpResponses;
use App\Helpers\ImageUploadHelper;
use App\Http\Resources\FaqResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Api\User\\ProfileResource;
use App\Http\Requests\Api\User\Profile\DeleteAccountRequest;
use App\Http\Requests\Api\User\Profile\UpdateProfileRequest;


use App\Http\Requests\Api\User\Profile\ChangePasswordRequest;

class ProfileController extends Controller
{
    // I added image to users table
    use HttpResponses;
    public function getProfile()
    {
        $user = auth()->user();
        return $this->successWithDataResponse(new ProfileResource($user));
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = Auth::user();

        if ($request->hasFile('image')) {
            $imageUrl = ImageUploadHelper::uploadImage($request->file('image'), 'users');
            $user->image = $imageUrl;
        }

        $user->update($request->except('image'));

        return $this->successWithDataResponse(new ProfileResource($user));
    }

    // public function myOrders()
    // {
    //     $orders = auth()->user()->orders;
    //     return $this->successWithDataResponse(new OrderResource($orders));
    // }

    public function deleteAccount(DeleteAccountRequest $request)
    {
        $user = Auth::user();
        if (!$user->verifyPassword($request->password)) {
            return $this->failureResponse('كلمة المرور غير صحيحة');
        }

        if ($user->hasNoOrdersOrCompletedOrders()) {
            $user->delete();
            return $this->successResponse('تم حذف الحساب بنجاح');
        }

        return $this->failureResponse('لديك طلبات لم يتم توصيلها بعد لا يمكن حذف الحساب');
    }
    public function changePassword(ChangePasswordRequest $request)
    {
        $user = Auth::user();

        if (!$user->verifyPassword($request->old_password)) {
            return $this->failureResponse('كلمة المرور القديمة غير صحيحة');
        }
        $user->changePassword($request->password);

        return $this->successResponse('تم تغيير كلمة المرور بنجاح');
    }

    public function faqs()
    {
        $faqs = Faq::get(['id', 'question', 'answer']);
        return $this->successWithDataResponse(FaqResource::collection($faqs));
    }
}
