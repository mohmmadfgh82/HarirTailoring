@extends('layouts.app') {{-- فرض بر اینه که layout کلی داری --}}

@section('content')
<div class="container">
    <h2 class="mb-4">لیست کالکشن‌ها</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.collections.create') }}" class="btn btn-primary mb-3">افزودن کالکشن جدید</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>عنوان</th>
                <th>توضیحات</th>
                <th>تصویر</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($collections as $collection)
                <tr>
                    <td>{{ $collection->title }}</td>
                    <td>{{ $collection->description }}</td>
                    <td>
                        @if ($collection->image)
                            <img src="{{ $collection->image }}" width="100">
                        @else
                            <span>ندارد</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.collections.edit', $collection->id) }}" class="btn btn-sm btn-warning">ویرایش</a>
                        <form action="{{ route('admin.collections.destroy', $collection->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('مطمئنی؟')">حذف</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">هیچ کالکشنی ثبت نشده است.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
