@extends('layouts.app')

@section('content')
<div class="container">
    <h2>گالری تصاویر</h2>
    <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary mb-3">افزودن تصویر</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @foreach ($galleries as $gallery)
            <div class="col-md-3 mb-3">
                <div class="card">
                    <img src="{{ $gallery->image }}" class="card-img-top" alt="{{ $gallery->title }}">
                    <div class="card-body text-center">
                        <form action="{{ route('admin.gallery.destroy', $gallery->id) }}" method="POST" onsubmit="return confirm('حذف شود؟')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">حذف</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
