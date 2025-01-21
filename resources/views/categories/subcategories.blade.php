@extends('layout')
@section('styles')
<style>
    .image-upload-square {
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        width: 250px; 
        height: 250px;
        border-radius: 15px;
    }

    .image-upload-square img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        position: absolute;
        top: 0;
        left: 0;
    }

    .image-upload-square:hover {
        background-color: #9fa0a0;
    }
</style>
@endsection
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
                <th>الصورة</th>
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
                <td class="p-0">  <img src="{{ $subcategory->image}}" alt="Image" style="border-radius: 0%; height: 55px; width: 55px;" ></td>
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
                                <div class="text-center">
                                    <label for="">{{__('admin.image')}}</label>
                                    <div class="mb-3 d-flex justify-content-center align-items-center">
                                        <div id="imageContainer{{ $subcategory->id }}" class="image-upload-square border">
                                            <img id="previewImage{{ $subcategory->id }}" src="{{ $subcategory->image }}" 
                                                    alt="Image Preview" 
                                                    style="max-width: 100%; max-height: 100%; border-radius: 5px;" />
                        
                                            <button id="removeImage{{ $subcategory->id }}" type="button" 
                                                    class="btn btn-danger btn-sm" 
                                                    style="position: absolute; top: 5px; right: 5px;">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <input type="file" id="image{{ $subcategory->id }}" name="image" class="form-control d-none" accept="image/*">
                                </div>
                            </div> <!-- Closing tag for modal-body -->
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
                <td colspan="12" class="text-center">لا توجد فئات فرعية متاحة.</td>
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
                    <div class="text-center">
                        <label for="">{{__('admin.image')}}</label>
                        <div class="mb-3 d-flex justify-content-center align-items-center">
                            <div id="imageContainerCreate" class="image-upload-square border">
                            </div>
                        </div>
                        <input type="file" id="imageCreate" name="image" class="form-control d-none" accept="image/*">
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Handle image upload and removal for all modals
        document.querySelectorAll('.modal').forEach(modal => {
            const imageInput = modal.querySelector('input[type="file"]');
            const imageContainer = modal.querySelector('.image-upload-square');

            if (imageContainer && imageInput) {
                // Handle clicking on the container to open file dialog
                imageContainer.addEventListener('click', function () {
                    imageInput.click();
                });

                // Handle file input change
                imageInput.addEventListener('change', function () {
                    const file = imageInput.files[0];

                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            // Update container HTML with image and remove button
                            imageContainer.innerHTML = `
                                <img src="${e.target.result}" 
                                     alt="Image Preview" 
                                     style="max-width: 100%; max-height: 100%; border-radius: 5px;" />
                                <button type="button" 
                                        class="btn btn-danger btn-sm" 
                                        style="position: absolute; top: 5px; right: 5px;">
                                    <i class="fas fa-trash"></i>
                                </button>
                            `;

                            // Add event listener to the remove button
                            const removeButton = imageContainer.querySelector('button');
                            removeButton.addEventListener('click', function (e) {
                                e.stopPropagation(); // Prevent file input click from being triggered
                                imageInput.value = '';
                                imageContainer.innerHTML = ''; // Remove image and button
                            });
                        };

                        reader.readAsDataURL(file); // Read the file as a data URL
                    }
                });
            }
        });
    });
</script>
@endsection