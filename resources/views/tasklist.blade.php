@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- عرض رسالة نجاح عند إضافة أو تعديل المهمة -->
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

                <!-- زر إضافة مهمة جديدة -->
                <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#addTaskModal">
                    <i class="fa fa-plus me-2"></i>إضافة مهمة جديدة
                </button>

                <!-- قائمة المهام الحالية -->
                <div class="card mt-4">
                    <div class="card-header">
                        المهام الحالية
                    </div>
                    <div class="card-body">
                        @if($tasks->count() > 0)
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>المهمة</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tasks as $task)
                                        <tr>
                                            <td>{{ $task->name }}</td>
                                            <td>
                                                <!-- زر تعديل -->
                                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editTaskModal{{ $task->id }}">
                                                    <i class="fa fa-edit"></i> تعديل
                                                </button>
                                                <!-- زر حذف -->
                                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من حذف هذه المهمة؟')">
                                                        <i class="fa fa-trash"></i> حذف
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- نافذة تعديل المهمة -->
                                        <div class="modal fade" id="editTaskModal{{ $task->id }}" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editTaskModalLabel">تعديل المهمة</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="task-name-{{ $task->id }}" class="form-label">اسم المهمة</label>
                                                                <input type="text" name="name" id="task-name-{{ $task->id }}" class="form-control" value="{{ $task->name }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                                                            <button type="submit" class="btn btn-primary">تحديث المهمة</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-center">لا توجد مهام حالياً.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- نافذة إضافة مهمة جديدة -->
    <div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTaskModalLabel">إضافة مهمة جديدة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="task-name" class="form-label">اسم المهمة</label>
                            <input type="text" name="name" id="task-name" class="form-control" value="" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-primary">إضافة المهمة</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection