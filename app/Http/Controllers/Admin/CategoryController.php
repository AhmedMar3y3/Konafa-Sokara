<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\Category\StoreCategoryRequest;
use App\Http\Requests\admin\Category\UpdateCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    // View all categories
    public function index()
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('categories.index', compact('categories'));
    }

    // Store a new category
    public function store(StoreCategoryRequest $request)
    {
        Category::create($request->validated());
        return redirect()->back()->with('success', 'تم إنشاء الفئة بنجاح.');
    }

    // Show subcategories of a category
    public function showSubCategories($id)
    {
        $category = Category::find($id);
        $subCategories = $category->children;
        return view('categories.subcategories', compact('subCategories', 'category'));
    }

    // Store a new subcategory
    public function storeSubCategory(StoreCategoryRequest $request, $parentId)
    {
        Category::create($request->validated() + ['parent_id'=>$parentId]);
        return redirect()->back()->with('success', 'تم إنشاء الفئة الفرعية بنجاح.');
    }

    // Edit a category
    public function edit($id)
    {
        $category = Category::find($id);
        $categories = Category::whereNull('parent_id')->get();
        return view('categories.edit', compact('category', 'categories'));
    }

    // Update a category
    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = Category::find($id);
        $category->uploadImage($request->file('image'));
        $category->save();
        return redirect()->back()->with('success', 'تم تحديث الفئة بنجاح.');
    }

    // Delete a category
    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category->hasProducts()) {
            return redirect()->back()->with('error', 'لا يمكن حذف الفئة لأنها تحتوي على منتجات.');
        }
        $category->delete();
        return redirect()->back()->with('success', 'تم حذف الفئة بنجاح.');
    }
}

