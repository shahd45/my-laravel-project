<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    { Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // اسم المنتج
        $table->text('description')->nullable(); // وصف المنتج (اختياري)
        $table->decimal('price', 10, 2); // سعر المنتج
        $table->integer('quantity')->default(0); // الكمية المتاحة
        $table->timestamps(); // تاريخ الإنشاء والتحديث
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
