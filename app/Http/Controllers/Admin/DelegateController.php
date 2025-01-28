<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Delegate;

class DelegateController extends Controller
{
    public function index()
    {
        $delegates = Delegate::where('is_active', 1)->get();
        return view('delegates.index', compact('delegates'));
    }
    
    public function show($id)
    {
        $delegate = Delegate::find($id);
        return response()->json($delegate);
    }

    public function destroy($id)
    {
        $delegate = Delegate::find($id);
        if ($delegate->orders()->where('status', 'الشحن')->count() > 0) {
            return redirect()->route('admin.delegates.index')->with('error', 'لا يمكن حذف مندوب لديه طلبات في حالة الشحن');
        }
        $delegate->delete();
        return redirect()->route('admin.delegates.index')->with('success', 'تم الحذف بنجاح');
    }
}
