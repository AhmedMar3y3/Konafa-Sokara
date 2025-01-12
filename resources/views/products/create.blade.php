@extends('layout')
@section('main')

<div class="container text-end">
    <h2>إضافة منتج جديد</h2>
    <!-- Create Product Form -->
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
    <!-- Success Message -->
    @if (Session::has('success'))
        <div class="alert alert-success" style="background:#28272f; color: white;">{{ Session::get('success') }}</div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
    @endif


        <div class="mb-3">
            <label for="name" class="form-label">اسم المنتج</label>
            <input type="text" name="name" class="form-control text-end" id="name" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">صورة المنتج</label>
            <input type="file" name="image" class="form-control text-end" style="" id="image" required>
        </div>
        
        <div class="mb-3">
            <label for="description" class="form-label">وصف المنتج</label>
            <textarea name="description" class="form-control text-end" id="description"></textarea>
        </div>
        <div class="mb-3">
            <label for="recipe" class="form-label">الوصفة</label>
            <textarea name="recipe" class="form-control text-end" id="recipe"></textarea>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">الكمية</label>
            <input type="number" name="quantity" class="form-control text-end" id="quantity" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">السعر</label>
            <input type="number" name="price" class="form-control text-end" id="price" required>
        </div>
        <div class="mb-3">
            <label for="has_discount" class="form-label">هل يوجد خصم؟</label>
            <select name="has_discount" class="form-select text-end" id="has_discount" required>
                <option value="0">لا</option>
                <option value="1">نعم</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="discount_price" class="form-label">سعر الخصم</label>
            <input type="number" name="discount_price" class="form-control text-end" id="discount_price">
        </div>
        <div class="mb-3">
            <label for="can_apply_prize" class="form-label">هل يمكن تطبيق الجوائز؟</label>
            <select name="can_apply_prize" class="form-select text-end" id="can_apply_prize" required>
                <option value="0">لا</option>
                <option value="1">نعم</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="points" class="form-label">النقاط</label>
            <input type="number" name="points" class="form-control text-end" id="points" >
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">الفئة</label>
            <select name="category_id" class="form-select text-end" id="category_id" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="sub_category_id" class="form-label">الفئة الفرعية</label>
            <select name="sub_category_id" class="form-select text-end" id="sub_category_id" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">حفظ</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">إلغاء</a>
    </form>
</div>

@endsection