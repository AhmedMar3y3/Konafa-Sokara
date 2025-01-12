<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\Product\StoreProductRequest;
use App\Http\Requests\admin\Product\UpdateProductRequest;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // index all products
    public function index(Request $request)
    {
        $search = $request->query('search');
        $products = Product::with('category')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->paginate(15);

        return view('products.index', compact('products', 'search'));
    }

    // Show a specific product details
    public function show(Product $product,$id)
    {
        $product = Product::with('category')->find($id);
        return view('products.show', compact('product'));
    }

    // Show the form to create a new product
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    // Store a new product
    public function store(StoreProductRequest $request)
    {
        $product = new Product($request->validated());

        if ($request->hasFile('image')) {
            $product->uploadImage($request->file('image'));
        }

        $product->save();
        return redirect()->route('admin.products.index')->with('success', 'تم إنشاء المنتج بنجاح.');
    }

    // Show the form to edit a product
    public function edit(Product $product,$id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    // Update a product
    public function update(UpdateProductRequest $request,$id)
    {

        $product = Product::find($id);
        $product->uploadImage($request->file('image'));
        $product->save();
        return redirect()->route('admin.products.index')->with('success', 'تم تحديث المنتج بنجاح.');
    }

    // Delete a product

    //TODO check if the product has orders
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'تم حذف المنتج بنجاح.');
    }
}