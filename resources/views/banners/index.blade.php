@extends('layout')
@section('main')

<div class="container text-end">
    <h2>جميع البانرات</h2>

    <!-- Success Message -->
    @if (Session::has('success'))
        <div class="alert alert-success" style="background:#28272f; color: white;">{{ Session::get('success') }}</div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
    @endif

    <!-- Add Banner Button -->
    <button class="btn btn-primary btn-rounded btn-fw" data-bs-toggle="modal" data-bs-target="#createBannerModal" style="margin: 10px">
        إضافة بانر جديد
    </button>

    <!-- Banners Table -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>الإجراءات</th>
                <th>الاسم</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($banners as $banner)
            <tr>
                <td>
                    <!-- Delete Button -->
                    <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد؟');" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-rounded btn-sm"><i class="fa fa-trash"></i></button>
                    </form>

                    <!-- Edit Button -->
                    <button class="btn btn-warning btn-rounded btn-sm" data-bs-toggle="modal" data-bs-target="#editBannerModal{{ $banner->id }}">
                        <i class="fa fa-edit"></i>
                    </button>

                    <!-- Show Button -->
                    <button class="btn btn-info btn-rounded btn-sm" data-bs-toggle="modal" data-bs-target="#showBannerModal{{ $banner->id }}">
                        <i class="fa fa-eye"></i>
                    </button>
                </td>
                <td>{{ $banner->name }}</td>
            
                <td>{{ $banner->id }}</td>
            </tr>

            <!-- Show Banner Modal -->
            <div class="modal fade text-end" id="showBannerModal{{ $banner->id }}" tabindex="-1" aria-labelledby="showBannerModalLabel{{ $banner->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="showBannerModalLabel{{ $banner->id }}">عرض البانر</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>الاسم:</strong> {{ $banner->name }}</p>
                            <p><strong>الصورة:</strong></p>
                            <img src="{{ asset('/images/banner/' . basename($banner->image)) }}" alt="Image" style="width: 200px;">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Banner Modal -->
            <div class="modal fade text-end" id="editBannerModal{{ $banner->id }}" tabindex="-1" aria-labelledby="editBannerModalLabel{{ $banner->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title" id="editBannerModalLabel{{ $banner->id }}">تعديل البانر</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Banner Name -->
                                <div class="mb-3">
                                    <label for="editBannerName{{ $banner->id }}" class="form-label">الاسم</label>
                                    <input type="text" name="name" class="form-control text-end" id="editBannerName{{ $banner->id }}" value="{{ $banner->name }}" required>
                                </div>
                                <!-- Banner Image -->
                                <div class="mb-3">
                                    <label for="editBannerImage{{ $banner->id }}" class="form-label">الصورة</label>
                                    <input type="file" name="image" class="form-control text-end" id="editBannerImage{{ $banner->id }}">
                                    <small class="text-muted">اترك الحقل فارغًا إذا كنت لا تريد تغيير الصورة.</small>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <tr>
                <td colspan="4" class="text-center">لا توجد بانرز متاحة.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Create Banner Modal -->
<div class="modal fade text-end" id="createBannerModal" tabindex="-1" aria-labelledby="createBannerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createBannerModalLabel">إضافة بانر جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Banner Name -->
                    <div class="mb-3">
                        <label for="bannerName" class="form-label">الاسم</label>
                        <input type="text" name="name" class="form-control text-end" id="bannerName" required>
                    </div>
                    <!-- Banner Image -->
                    <div class="mb-3">
                        <label for="bannerImage" class="form-label">الصورة</label>
                        <input type="file" name="image" class="form-control text-end" id="bannerImage" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">حفظ</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection