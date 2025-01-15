<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\FAQ\StoreFaqRequest;
use App\Http\Requests\admin\FAQ\UpdateFaqRequest;
use App\Models\FAQ;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function index()
    {
        $faqs = FAQ::all();
        return view('faq.index', compact('faqs'));
    }

    public function show($id)
    {
        $faq = FAQ::findOrFail($id);
        return response()->json($faq);
    }

    public function store(StoreFaqRequest $request)
    {
        FAQ::create($request->validated());
        return redirect()->route('admin.faqs.index')->with('success', 'تمت الاضافة بنجاح');
    }

    public function update(UpdateFaqRequest $request,$id)
    {
        FAQ::findOrFail($id)->update($request->validated());
        return redirect()->route('admin.faqs.index')->with('success', 'تم التعديل بنجاح');
    }

    public function destroy($id)
    {
        FAQ::findOrFail($id)->delete();
        return redirect()->route('admin.faqs.index')->with('success', 'تم الحذف بنجاح');
    }
}
