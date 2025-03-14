<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // عرض جميع المستخدمين
    public function index()
    {
        $users = User::all(); // جلب جميع المستخدمين
        return view('users.index', compact('users')); // عرض صفحة index
    }

    // إضافة مستخدم جديد
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
        ]);

        User::create($request->all()); // إضافة المستخدم

        return redirect()->route('users.index')->with('success', 'تم إضافة المستخدم بنجاح');
    }

    // تعديل مستخدم
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($request->all()); // تحديث بيانات المستخدم

        return redirect()->route('users.index')->with('success', 'تم تحديث المستخدم بنجاح');
    }

    // حذف مستخدم
    public function destroy(User $user)
    {
        $user->delete(); // حذف المستخدم

        return redirect()->route('users.index')->with('success', 'تم حذف المستخدم بنجاح');
    }
}
