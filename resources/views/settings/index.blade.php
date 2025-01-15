@extends('layout')

@section('main')
<div class="container text-end">
    <h2>الإعدادات</h2>

    <!-- Success Message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Settings Form -->
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="delivery_price" class="form-label text-end">سعر التوصيل</label>
            <input type="number" name="delivery_price" class="form-control text-end" id="delivery_price" value="{{ $deliveryPrice->value ?? '' }}" required>
        </div>

        <button type="submit" class="btn btn-primary">حفظ</button>
    </form>
</div>
@endsection