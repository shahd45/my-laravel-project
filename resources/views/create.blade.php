@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create New Task</h2>

        <!-- تحقق من وجود الرسائل -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- نموذج إضافة المهمة -->
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="task-name" class="form-label">Task Name</label>
                <input type="text" name="name" id="task-name" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Add Task</button>
        </form>
    </div>
@endsection
