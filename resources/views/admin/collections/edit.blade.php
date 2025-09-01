@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">ویرایش کالکشن</h2>

    <form action="{{ route('admin.collections.update', $collection->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">عنوان</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $collection->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">توضیحات</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description', $collection->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">تصویر فعلی</label><br>
            @if($collection->image)
                <img src="{{ $collection->image }}" width="120">
            @else
                <span>تصویری وجود ندارد</span>
            @endif
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">تصویر جدید (اختیاری)</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">به‌روزرسانی</button>
            <a href="{{ route('admin.collections.index') }}" class="btn btn-secondary">بازگشت</a>
        </div>
    </form>
</div>
@endsection
