<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\Banner\StoreBannerRequest;
use App\Http\Requests\admin\Banner\UpdateBannerRequest;
use App\Models\Banner;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('banners.index', compact('banners'));
    }

    public function show($id)
    {
        $banner = Banner::findOrFail($id);
        return response()->json($banner);
    }

    public function store(StoreBannerRequest $request)
    {
        Banner::create($request->validated());
        return redirect()->route('admin.banners.index')->with('success', 'تمت الاضافة بنجاح');
    }

    public function update(UpdateBannerRequest $request,$id)
    {
        Banner::findOrFail($id)->update($request->validated());
        return redirect()->route('admin.banners.index')->with('success', 'تم التعديل بنجاح');
    }

    public function destroy($id)
    {
        Banner::findOrFail($id)->delete();
        return redirect()->route('admin.banners.index')->with('success', 'تم الحذف بنجاح');
    }
}