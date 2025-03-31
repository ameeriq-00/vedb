<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('government_vehicles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('directorate_id')->constrained()->cascadeOnDelete();
            $table->string('vehicle_name');
            $table->string('vehicle_number');
            $table->string('model');
            $table->string('chassis_number')->unique();
            $table->string('governorate');
            $table->string('color');
            $table->enum('condition', ['صالحة', 'عاطلة'])->default('صالحة');

            $table->text('accessories')->nullable(); // قائمة نصية أو مرتبطة لاحقًا
            $table->text('defects')->nullable();     // نفس الفكرة

            $table->string('source_document_number')->nullable(); // عدد الوارد
            $table->date('source_document_date')->nullable();     // تاريخ الوارد

            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete(); // من أدخلها

            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('government_vehicles');
    }
};
