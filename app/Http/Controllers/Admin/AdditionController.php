<?php

namespace App\Http\Controllers\Admin;

use App\Models\Addition;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\Addition\StoreAdditionRequest;
use App\Http\Requests\admin\Addition\UpdateAdditionRequest;

class AdditionController extends Controller
{
    public function index()
    {
        $additions = Addition::paginate(15);
        $categories = Category::whereNull('parent_id')->get();
        return view('addition.index', compact('additions', 'categories'));
    }

    public function store(StoreAdditionRequest $request)
    {
        Addition::create($request->validated());
        return redirect()->back()->with('success', 'تم إنشاء الإضافة بنجاح.');
    }

    public function update(UpdateAdditionRequest $request, $id)
    {
        $addition = Addition::find($id);
        $addition->update($request->validated());
        return redirect()->back()->with('success', 'تم تحديث الإضافة بنجاح.');
    }

    public function destroy($id)
    {
        $addition = Addition::find($id);
        $addition->delete();
        return redirect()->back()->with('success', 'تم حذف الإضافة بنجاح.');
    }
}
