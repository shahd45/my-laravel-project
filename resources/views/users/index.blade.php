@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>إدارة المستخدمين</title>

    <!-- الخطوط -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel="stylesheet">

    <!-- الأنماط -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Lato', sans-serif;
        }

        .container {
            margin-top: 20px;
        }

        .modal-header {
            background-color: #007bff;
            color: #fff;
        }

        .modal-footer {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">إدارة المستخدمين</a>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- عرض رسالة نجاح عند إضافة أو تعديل المستخدم -->
                @if(session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- عرض الأخطاء -->
                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- زر إضافة مستخدم جديد -->
                <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="fa fa-plus me-2"></i>إضافة مستخدم جديد
                </button>

                <!-- قائمة المستخدمين الحالية -->
                <div class="card mt-4">
                    <div class="card-header">
                        المستخدمين الحاليين
                    </div>
                    <div class="card-body">
                        @if($users->count() > 0)
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>الاسم</th>
                                        <th>البريد الإلكتروني</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <!-- زر تعديل -->
                                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}">
                                                    <i class="fa fa-edit"></i> تعديل
                                                </button>
                                                <!-- زر حذف -->
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من حذف هذا المستخدم؟')">
                                                        <i class="fa fa-trash"></i> حذف
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- نافذة تعديل المستخدم -->
                                        <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editUserModalLabel">تعديل المستخدم</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="user-name-{{ $user->id }}" class="form-label">اسم المستخدم</label>
                                                                <input type="text" name="name" id="user-name-{{ $user->id }}" class="form-control" value="{{ $user->name }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="user-email-{{ $user->id }}" class="form-label">البريد الإلكتروني</label>
                                                                <input type="email" name="email" id="user-email-{{ $user->id }}" class="form-control" value="{{ $user->email }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="user-password-{{ $user->id }}" class="form-label">كلمة المرور</label>
                                                                <input type="password" name="password" id="user-password-{{ $user->id }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">إلغاء</button>
                                                            <button type="submit" class="btn btn-primary">تحديث</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>لا يوجد مستخدمين حاليا.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- نافذة إضافة مستخدم جديد -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">إضافة مستخدم جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="user-name" class="form-label">اسم المستخدم</label>
                            <input type="text" name="name" id="user-name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="user-email" class="form-label">البريد الإلكتروني</label>
                            <input type="email" name="email" id="user-email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="user-password" class="form-label">كلمة المرور</label>
                            <input type="password" name="password" id="user-password" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">إلغاء</button>
                        <button type="submit" class="btn btn-primary">إضافة</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection