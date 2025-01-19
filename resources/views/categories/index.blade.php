@extends('layout')
@section('main')

<div class="container text-end">
    <h2>جميع الفئات</h2>

    <!-- Success Message -->
    @if (Session::has('success'))
        <div class="alert alert-success" style="background:#28272f; color: white;">{{ Session::get('success') }}</div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
    @endif

    <!-- Add Category Button -->
    <button class="btn btn-primary btn-rounded btn-fw" data-bs-toggle="modal" data-bs-target="#createCategoryModal" style="margin: 10px">
        إضافة فئة جديدة
    </button>

    <!-- Category Table -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>الإجراءات</th>
                <th>الاسم</th>
                <th>الصورة</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
            <tr>
                <td>
                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-rounded btn-sm"><i class="fa fa-trash"></i></button>
                    </form>
                    <button class="btn btn-warning btn-rounded btn-sm" data-bs-toggle="modal" data-bs-target="#editCategoryModal{{ $category->id }}">
                        <i class="fa fa-edit"></i>
                    </button>
                    <a href="{{ route('admin.categories.show', $category->id) }}" class="btn btn-info btn-rounded btn-sm" style="display:inline-block;">
                        <i class="fa fa-eye"></i>
                    </a>
                </td>
                <td>{{ $category->name }}</td>
                <td>  <img src="{{ $category->image}}" alt="Image" style="width: auto;"></td>
                <td>{{ $category->id }}</td>
            </tr>

            <!-- Edit Category Modal -->
            <div class="modal fade text-end" id="editCategoryModal{{ $category->id }}" tabindex="-1" aria-labelledby="editCategoryModalLabel{{ $category->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title" id="editCategoryModalLabel{{ $category->id }}">تعديل الفئة</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Category Name -->
                                <div class="mb-3">
                                    <label for="editCategoryName{{ $category->id }}" class="form-label">اسم الفئة</label>
                                    <input type="text" name="name" class="form-control text-end" id="editCategoryName{{ $category->id }}" value="{{ $category->name }}" required>
                                </div>
                                <!-- Category Image -->
                                <div class="mb-3">
                                    <label for="editCategoryImage{{ $category->id }}" class="form-label">صورة الفئة</label>
                                    <input type="file" name="image" class="form-control text-end" id="editCategoryImage{{ $category->id }}">
                                    @if ($category->image)
                                        <img src="{{ $category->image }}" alt="Category Image" width="100" class="mt-2">
                                    @endif
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
                <td colspan="12" class="text-center">لا توجد فئات متاحة.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Create Category Modal -->
<div class="modal fade text-end" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createCategoryModalLabel">إضافة فئة جديدة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Category Name -->
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">اسم الفئة</label>
                        <input type="text" name="name" class="form-control text-end" id="categoryName" required>
                    </div>
                    <!-- Category Image -->
                    <div class="mb-3">
                        <label for="categoryImage" class="form-label">صورة الفئة</label>
                        <input type="file" name="image" class="form-control text-end" id="categoryImage">
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