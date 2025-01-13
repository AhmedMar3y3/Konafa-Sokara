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
            <label for="sub_category_id" class="form-label">الفئة الفرعية</label>
            <select name="sub_category_id" class="form-select text-end" id="sub_category_id" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Has Discount Radio Buttons -->
        <div class="mb-3">
            <label class="form-label">هل يوجد خصم؟</label>
            <div>
                <label>
                    <input type="radio" name="has_discount" value="1" id="has_discount_yes"> نعم
                </label>
                <label>
                    <input type="radio" name="has_discount" value="0" id="has_discount_no" checked> لا
                </label>
            </div>
        </div>
        <!-- Discount Price Input (Hidden by Default) -->
        <div class="mb-3" id="discount_price_field" style="display: none;">
            <label for="discount_price" class="form-label">سعر الخصم</label>
            <input type="number" name="discount_price" class="form-control text-end" id="discount_price" disabled>
        </div>

        <!-- Can Apply Prize Radio Buttons -->
        <div class="mb-3">
            <label class="form-label">هل يمكن تطبيق الجوائز؟</label>
            <div>
                <label>
                    <input type="radio" name="can_apply_prize" value="1" id="can_apply_prize_yes"> نعم
                </label>
                <label>
                    <input type="radio" name="can_apply_prize" value="0" id="can_apply_prize_no" checked> لا
                </label>
            </div>
        </div>
        <!-- Points Input (Hidden by Default) -->
        <div class="mb-3" id="points_field" style="display: none;">
            <label for="points" class="form-label">النقاط</label>
            <input type="number" name="points" class="form-control text-end" id="points" disabled>
        </div>

        <button type="submit" class="btn btn-primary">حفظ</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">إلغاء</a>
    </form>
</div>

<!-- JavaScript to Toggle Visibility and Disable Fields -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const hasDiscountYes = document.getElementById('has_discount_yes');
        const hasDiscountNo = document.getElementById('has_discount_no');
        const discountPriceField = document.getElementById('discount_price_field');
        const discountPriceInput = document.getElementById('discount_price');

        hasDiscountYes.addEventListener('change', function () {
            discountPriceField.style.display = this.checked ? 'block' : 'none';
            discountPriceInput.disabled = !this.checked;
        });
        hasDiscountNo.addEventListener('change', function () {
            discountPriceField.style.display = this.checked ? 'none' : 'block';
            discountPriceInput.disabled = this.checked;
        });

        const canApplyPrizeYes = document.getElementById('can_apply_prize_yes');
        const canApplyPrizeNo = document.getElementById('can_apply_prize_no');
        const pointsField = document.getElementById('points_field');
        const pointsInput = document.getElementById('points');

        canApplyPrizeYes.addEventListener('change', function () {
            pointsField.style.display = this.checked ? 'block' : 'none';
            pointsInput.disabled = !this.checked;
        });
        canApplyPrizeNo.addEventListener('change', function () {
            pointsField.style.display = this.checked ? 'none' : 'block';
            pointsInput.disabled = this.checked;
        });
    });
</script>

@endsection