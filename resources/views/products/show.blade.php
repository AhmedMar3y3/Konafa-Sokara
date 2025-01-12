@extends('layout')
@section('main')

<div class="container text-end">
    <h2>تفاصيل المنتج</h2>

    <!-- Product Details -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $product->name }}</h5>
            <p class="card-text"><strong>الوصف:</strong> {{ $product->description }}</p>
            <p class="card-text"><strong>الوصفة:</strong> {{ $product->recipe }}</p>
            <p class="card-text"><strong>الكمية:</strong> {{ $product->quantity }}</p>
            <p class="card-text"><strong>السعر:</strong> {{ $product->price }}</p>
            <p class="card-text"><strong>سعر الخصم:</strong> {{ $product->discount_price }}</p>
            <p class="card-text"><strong>النقاط:</strong> {{ $product->points }}</p>
            <p class="card-text"><strong>الفئة:</strong> {{ $product->category->name }}</p>
            <p class="card-text"><strong>الفئة الفرعية:</strong> {{ $product->category->name }}</p>
            @if ($product->image)
                <img src="{{ $product->image }}" alt="Product Image" width="200" class="mt-2">
            @endif
        </div>
    </div>

    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary mt-3">العودة إلى القائمة</a>
</div>

@endsection