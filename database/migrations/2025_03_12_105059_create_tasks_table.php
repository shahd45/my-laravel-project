<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id(); // إضافة عمود id تلقائي
            $table->string('name'); // إضافة عمود 'name' لتخزين اسم المهمة
            $table->timestamps(); // إضافة عمودين لتخزين الوقت (created_at, updated_at)
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks'); // لحذف الجدول في حالة الرجوع عن التغييرات
    }
}
