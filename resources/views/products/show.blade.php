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
            @if($product->discount_price)
            <p class="card-text"><strong>سعر الخصم:</strong> {{ $product->discount_price }}</p>
            @endif
            @if($product->points)
                <p class="card-text"><strong>النقاط:</strong> {{ $product->points }}</p>
            @endif
            <p class="card-text"><strong>الفئة :</strong> {{ $product->category->name }}</p>
            <div class="mb-3">
                @if($product->image)
                    <p><strong>الصورة</strong></p>
                    <img src="{{ asset('/images/product/' . basename($product->image)) }}" alt="Image" style="width: 200px;">
                @else
                    <p>No image available.</p>
                @endif
            </div>
        </div>
    </div>

    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary mt-3">العودة إلى القائمة</a>
</div>

@endsection