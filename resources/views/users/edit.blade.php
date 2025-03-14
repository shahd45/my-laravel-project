@extends('layouts.app')

@section('content')
    <h1>تعديل بيانات المستخدم</h1>

    <!-- Form to edit the user -->
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- This is important to indicate that this is an update request -->

        <div class="form-group">
            <label for="name">الاسم</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="form-group">
            <label for="email">البريد الإلكتروني</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">تحديث البيانات</button>
    </form>

    <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">رجوع إلى قائمة المستخدمين</a>
@endsection
