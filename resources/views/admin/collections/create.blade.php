@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">افزودن کالکشن جدید</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('admin.collections.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">عنوان</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">توضیحات</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">آپلود تصویر</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">ذخیره</button>
        <a href="{{ route('admin.collections.index') }}" class="btn btn-secondary">بازگشت</a>
    </form>
</div>
@endsection
