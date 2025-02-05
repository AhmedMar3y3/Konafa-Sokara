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
        return view('settings.index', compact('deliveryPrice'));
    }

    public function update(UpdateSettingRequest $request)
    {
        Setting::updateOrCreate(
            ['key' => 'delivery_price'],
            ['value' => $request->input('delivery_price')]
        );
        return redirect()->route('admin.settings.index')->with('success', 'تم تحديث الإعدادات بنجاح.');
    }
}
