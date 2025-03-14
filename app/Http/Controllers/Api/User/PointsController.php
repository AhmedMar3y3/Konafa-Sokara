<?php

namespace App\Http\Controllers\Api\User;

use App\Models\Setting;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;

class PointsController extends Controller
{
    use HttpResponses;
    public function settingPoints()
    {
        $settings = Setting::get(['key', 'value']);
        return $this->successWithDataResponse($settings);
    }

    public function userPoints()
    {
        $user = auth()->user();
        return $this->successWithDataResponse(['points' => $user->points]);
    }

    public function rateApp()
    {
        $user = auth()->user();
        if (!$user->rated_app) {
            $user->update([
                'rated_app' => true,
                'points' => $user->points + Setting::where('key', 'points_per_app_rating')->value('value')
            ]);
            return $this->successResponse('تم تقييم التطبيق بنجاح');
        }
        return $this->failureResponse('لقد قمت بتقييم التطبيق مسبقا');
    }
}
