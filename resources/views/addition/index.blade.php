@extends('layout')
@section('main')

<div class="container text-end">
    <h2>جميع الإضافات</h2>

    <!-- Success Message -->
    @if (Session::has('success'))
        <div class="alert alert-success" style="background:#28272f; color: white;">{{ Session::get('success') }}</div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
    @endif

    <!-- Add Addition Button -->
    <button class="btn btn-primary btn-rounded btn-fw" data-bs-toggle="modal" data-bs-target="#createAdditionModal" style="margin: 10px">
        إضافة جديدة
    </button>

    <!-- Additions Table -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>الإجراءات</th>
                <th>الفئة</th>
                <th>السعر</th>
                <th>الاسم</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($additions as $addition)
            <tr>
                <td>
                    <form action="{{ route('admin.additions.destroy', $addition->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد؟');" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-rounded btn-sm"><i class="fa fa-trash"></i></button>
                    </form>
                    <button class="btn btn-warning btn-rounded btn-sm" data-bs-toggle="modal" data-bs-target="#editAdditionModal{{ $addition->id }}">
                        <i class="fa fa-edit"></i>
                    </button>
                  
                </td>
                <td>{{ $addition->category->name }}</td>
                <td>{{ $addition->price }}</td>
                <td>{{ $addition->name }}</td>
                <td>{{ $addition->id }}</td>
            </tr>

            <!-- Edit Addition Modal -->
            <div class="modal fade text-end" id="editAdditionModal{{ $addition->id }}" tabindex="-1" aria-labelledby="editAdditionModalLabel{{ $addition->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('admin.additions.update', $addition->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title" id="editAdditionModalLabel{{ $addition->id }}">تعديل الإضافة</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Addition Name -->
                                <div class="mb-3">
                                    <label for="editAdditionName{{ $addition->id }}" class="form-label">اسم الإضافة</label>
                                    <input type="text" name="name" class="form-control text-end" id="editAdditionName{{ $addition->id }}" value="{{ $addition->name }}" required>
                                </div>
                                <!-- Addition Price -->
                                <div class="mb-3">
                                    <label for="editAdditionPrice{{ $addition->id }}" class="form-label">السعر</label>
                                    <input type="number" name="price" class="form-control text-end" id="editAdditionPrice{{ $addition->id }}" value="{{ $addition->price }}" required>
                                </div>
                                <!-- Addition Category -->
                                <div class="mb-3">
                                    <label for="editAdditionCategory{{ $addition->id }}" class="form-label">الفئة</label>
                                    <select name="category_id" class="form-select text-end" id="editAdditionCategory{{ $addition->id }}" required>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $category->id == $addition->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
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
                <td colspan="5" class="text-center">لا توجد إضافات متاحة.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
         <!-- Pagination Buttons -->
         <div class="d-flex justify-content-between mt-4">
            <!-- Previous Page Button -->
            @if($additions->onFirstPage())
            <span class="btn btn-secondary btn-rounded disabled">السابق</span>
            @else
            <a href="{{ $additions->previousPageUrl() }}" class="btn btn-primary btn-rounded">السابق</a>
            @endif
    
            <!-- Next Page Button -->
            @if($additions->hasMorePages())
            <a href="{{ $additions->nextPageUrl() }}" class="btn btn-primary btn-rounded">التالي</a>
            @else
            <span class="btn btn-secondary btn-rounded disabled">التالي</span>
            @endif
        </div>
</div>

<!-- Create Addition Modal -->
<div class="modal fade text-end" id="createAdditionModal" tabindex="-1" aria-labelledby="createAdditionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.additions.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createAdditionModalLabel">إضافة إضافة جديدة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Addition Name -->
                    <div class="mb-3">
                        <label for="additionName" class="form-label">اسم الإضافة</label>
                        <input type="text" name="name" class="form-control text-end" id="additionName" required>
                    </div>
                    <!-- Addition Price -->
                    <div class="mb-3">
                        <label for="additionPrice" class="form-label">السعر</label>
                        <input type="number" name="price" class="form-control text-end" id="additionPrice" required>
                    </div>
                    <!-- Addition Category -->
                    <div class="mb-3">
                        <label for="additionCategory" class="form-label">الفئة</label>
                        <select name="category_id" class="form-select text-end" id="additionCategory" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
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