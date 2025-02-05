<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\FAQ\StoreFaqRequest;
use App\Http\Requests\admin\FAQ\UpdateFaqRequest;

class FAQController extends Controller
{
    public function index()
    {
        $faqs = Faq::all();
        return view('faq.index', compact('faqs'));
    }

    public function show($id)
    {
        $faq = Faq::findOrFail($id);
        return response()->json($faq);
    }

    public function store(StoreFaqRequest $request)
    {
        Faq::create($request->validated());
        return redirect()->route('admin.faqs.index')->with('success', 'تمت الاضافة بنجاح');
    }

    public function update(UpdateFaqRequest $request, $id)
    {
        Faq::findOrFail($id)->update($request->validated());
        return redirect()->route('admin.faqs.index')->with('success', 'تم التعديل بنجاح');
    }

    public function destroy($id)
    {
        Faq::findOrFail($id)->delete();
        return redirect()->route('admin.faqs.index')->with('success', 'تم الحذف بنجاح');
    }
}
