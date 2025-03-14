<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

    
    class TaskController extends Controller
    {
       
            // عرض قائمة المهام
            public function index()
            {
                $tasks = Task::all();  // استرجاع جميع المهام من قاعدة البيانات
                return view('tasklist', compact('tasks'));  // عرض المهام في صفحة tasklist
            }
        
            // إضافة مهمة جديدة
            public function store(Request $request)
            {
                // التحقق من المدخلات
                $request->validate([
                    'name' => 'required|string|max:255',
                ]);
        
                // إنشاء مهمة جديدة
                Task::create([
                    'name' => $request->name,
                ]);
        
                // إعادة التوجيه إلى صفحة tasklist مع رسالة نجاح
                return redirect()->route('tasks.index')->with('success', 'تم إضافة المهمة بنجاح!');
            }
        
            // تحديث مهمة
            public function updateTask(Request $request, $id)
            {
                // التحقق من المدخلات
                $request->validate([
                    'name' => 'required|string|max:255',
                ]);
        
                // العثور على المهمة حسب الـ id وتحديثها
                $task = Task::findOrFail($id);
                $task->name = $request->name;
                $task->save();
        
                // إعادة التوجيه إلى صفحة tasklist مع رسالة نجاح
                return redirect()->route('tasks.index')->with('success', 'تم تحديث المهمة بنجاح!');
            }
        
            // حذف مهمة
            public function destroy($id)
            {
                $task = Task::findOrFail($id);
                $task->delete();
        
                // إعادة التوجيه إلى صفحة tasklist مع رسالة نجاح
                return redirect()->route('tasks.index')->with('success', 'تم حذف المهمة بنجاح!');
            }

            
        }
    