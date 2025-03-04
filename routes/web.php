<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    $name = 'Shahd';
    $departments = [
        '1' => 'Technical',
        '2' => 'Financial',
        '3' => 'Sales',
    ];
    return view('about', compact('name', 'departments'));
});

Route::post('/about', function () {
    $name = request('name');
    $departmentId = request('department'); // أخذ قسم الموظف من النموذج

    // الأقسام
    $departments = [
        '1' => 'Technical',
        '2' => 'Financial',
        '3' => 'Sales',
    ];

    // الحصول على اسم القسم بناءً على الـ ID الذي تم اختياره
    $selectedDepartment = $departments[$departmentId] ?? 'Unknown';

    return view('about', compact('name', 'selectedDepartment', 'departments'));
})->name('about');
?>
