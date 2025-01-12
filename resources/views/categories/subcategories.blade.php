@extends('layout')
@section('main')

<div class="container text-end">
    <h2>{{ $category->name }}</h2>

    <!-- Success Message -->
    @if (Session::has('success'))
        <div class="alert alert-success" style="background:#28272f; color: white;">{{ Session::get('success') }}</div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
    @endif

    <!-- Add Subcategory Button -->
    <button class="btn btn-primary btn-rounded btn-fw" data-bs-toggle="modal" data-bs-target="#createSubCategoryModal" style="margin: 10px">
        إضافة فئة فرعية جديدة
    </button>

    <!-- Subcategory Table -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>الإجراءات</th>
                <th>الاسم</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($subCategories as $subcategory)
            <tr>
                <td>
                    <form action="{{ route('admin.categories.destroy', $subcategory->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-rounded btn-sm"><i class="fa fa-trash"></i></button>
                    </form>
                    <button class="btn btn-warning btn-rounded btn-sm" data-bs-toggle="modal" data-bs-target="#editSubCategoryModal{{ $subcategory->id }}">
                        <i class="fa fa-edit"></i>
                    </button>
                </td>
                <td>{{ $subcategory->name }}</td>
                <td>{{ $subcategory->id }}</td>
            </tr>

            <!-- Edit Subcategory Modal -->
            <div class="modal fade text-end" id="editSubCategoryModal{{ $subcategory->id }}" tabindex="-1" aria-labelledby="editSubCategoryModalLabel{{ $subcategory->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('admin.categories.update', $subcategory->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title" id="editSubCategoryModalLabel{{ $subcategory->id }}">تعديل الفئة الفرعية</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Subcategory Name -->
                                <div class="mb-3">
                                    <label for="editSubCategoryName{{ $subcategory->id }}" class="form-label">اسم الفئة الفرعية</label>
                                    <input type="text" name="name" class="form-control text-end" id="editSubCategoryName{{ $subcategory->id }}" value="{{ $subcategory->name }}" required>
                                </div>
                                <!-- Subcategory Image -->
                                <div class="mb-3">
                                    <label for="editSubCategoryImage{{ $subcategory->id }}" class="form-label">صورة الفئة الفرعية</label>
                                    <input type="file" name="image" class="form-control text-end" id="editSubCategoryImage{{ $subcategory->id }}">
                                    @if ($subcategory->image)
                                        <img src="{{ $subcategory->image }}" alt="Subcategory Image" width="100" class="mt-2">
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
                <td colspan="3" class="text-center">لا توجد فئات فرعية متاحة.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Create Subcategory Modal -->
<div class="modal fade text-end" id="createSubCategoryModal" tabindex="-1" aria-labelledby="createSubCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.categories.storeSubCategory', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createSubCategoryModalLabel">إضافة فئة فرعية جديدة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Subcategory Name -->
                    <div class="mb-3">
                        <label for="subCategoryName" class="form-label">اسم الفئة الفرعية</label>
                        <input type="text" name="name" class="form-control text-end" id="subCategoryName" required>
                    </div>
                    <!-- Subcategory Image -->
                    <div class="mb-3">
                        <label for="subCategoryImage" class="form-label">صورة الفئة الفرعية</label>
                        <input type="file" name="image" class="form-control text-end" id="subCategoryImage">
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