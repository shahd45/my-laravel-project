<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\TaskController;
use Illuminate\View\View;




// عرض صفحة الترحيب
Route::get('/', function () {
    return view('welcome');
});

// عرض صفحة إضافة مهمة جديدة
Route::get('/tasks/create', function () {
    return view('create-task');
})->name('tasks.create');

// تخزين المهمة في قاعدة البيانات باستخدام Eloquent
Route::post('/tasks', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    Task::create([
        'name' => $request->name,
    ]);

    return redirect()->route('tasks.list')->with('success', 'Task added successfully!');
})->name('tasks.store');

// عرض قائمة المهام باستخدام Eloquent
Route::get('/tasklist', function () {
    $tasks = Task::all();
    return view('tasklist', compact('tasks'));
})->name('tasks.list');

// حذف المهمة باستخدام 
Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.delete');

// استرجاع المهام باستخدام Query Builder
Route::get('/tasks', function () {
    $tasks = DB::table('tasks')->get(); // استرجاع جميع المهام
    return view('tasklist', compact('tasks'));
});


Route::resource('tasks', TaskController::class);
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');

// مسار لتحديث المهمة
Route::put('/tasks/{id}/update', [TaskController::class, 'updateTask'])->name('tasks.update');

// مسار لحذف المهمة
Route::post('/tasks/{id}/delete', [TaskController::class, 'destroy'])->name('tasks.delete');

Route::resource('tasks', TaskController::class);
use App\Http\Controllers\UserController;

////////////////////////////////////////////////////////////////
// عرض جميع المستخدمين
Route::get('/users', [UserController::class, 'index'])->name('users.index');

// إضافة مستخدم جديد
Route::post('/users', [UserController::class, 'store'])->name('users.store');

// تعديل مستخدم
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

// حذف مستخدم
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
// /////
// Route::post('/app', function ():View {
//     return .view(view:layout.app);
//         ]);

Route::get('/app', function (): View {
    return view('layouts.app');
});


// Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
