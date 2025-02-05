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

        <!-- Delivery Price Setting -->
        <div class="mb-3">
            <label for="delivery_price" class="form-label text-end" style="color: black">{{ __('admin.delivery_price') }}</label>
            <input type="number" name="delivery_price" class="form-control text-end" id="delivery_price" 
                   value="{{ $deliveryPrice->value ?? '' }}" required>
        </div>

        <!-- Points per 1 SAR -->
        <div class="mb-3">
            <label for="points_per_sar" class="form-label text-end" style="color: black">{{ __('admin.points_per_SAR') }}</label>
            <input type="number" name="points_per_sar" class="form-control text-end" id="points_per_sar" 
                   value="{{ $pointsPerSar->value ?? '' }}" required>
        </div>

        <!-- Points per Friend Invitation -->
        <div class="mb-3">
            <label for="points_per_friend_invitation" class="form-label text-end" style="color: black">{{ __('admin.points_per_invitation') }}</label>
            <input type="number" name="points_per_friend_invitation" class="form-control text-end" id="points_per_friend_invitation" 
                   value="{{ $pointsPerFriendInvitation->value ?? '' }}" required>
        </div>

        <!-- Points per Application Rating -->
        <div class="mb-3">
            <label for="points_per_app_rating" class="form-label text-end" style="color: black">{{ __('admin.points_per_app_rating') }}</label>
            <input type="number" name="points_per_app_rating" class="form-control text-end" id="points_per_app_rating" 
                   value="{{ $pointsPerAppRating->value ?? '' }}" required>
        </div>

        <button type="submit" class="btn btn-primary">حفظ</button>
    </form>
</div>
@endsection
