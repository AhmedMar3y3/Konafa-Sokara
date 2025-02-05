<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\UpdateSettingRequest;

class SettingController extends Controller
{
    public function index()
    {
        $deliveryPrice = Setting::where('key', 'delivery_price')->first();
        $pointsPerSar = Setting::where('key', 'points_per_sar')->first();
        $pointsPerFriendInvitation = Setting::where('key', 'points_per_friend_invitation')->first();
        $pointsPerAppRating = Setting::where('key', 'points_per_app_rating')->first();

        return view('settings.index', compact('deliveryPrice','pointsPerSar','pointsPerFriendInvitation','pointsPerAppRating'));
    }

    public function update(UpdateSettingRequest $request)
    {
        foreach ($request->validated() as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                    ['value' => $value]
            );
        }
        return redirect()->route('admin.settings.index')->with('success', 'تم تحديث الإعدادات بنجاح.');
    }
}
