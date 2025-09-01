@extends('layouts.app')

@section('content')
<div class="container">
    <h2>افزودن تصویر به گالری</h2>
    <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title">عنوان (اختیاری)</label>
            <input type="text" class="form-control" name="title" id="title">
        </div>
        <div class="mb-3">
            <label for="image">تصویر</label>
            <input type="file" class="form-control" name="image" id="image" required>
        </div>
        <button class="btn btn-success">آپلود</button>
    </form>
</div>
@endsection
