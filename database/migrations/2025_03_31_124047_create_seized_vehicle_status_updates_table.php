<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('seized_vehicle_status_updates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seized_vehicle_id')->constrained()->cascadeOnDelete();
            $table->enum('status', [
                'محجوزة',
                'مصادرة',
                'مكتسبة',
                'مثمنة',
                'مصادق عليها',
                'مهداة',
                'مرقمة'
            ]);
            $table->string('decision_number')->nullable();
            $table->date('decision_date')->nullable();
            $table->string('attachment_path')->nullable(); // الملف المرفق (قرار رسمي)
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // من قام بالتحديث
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('seized_vehicle_status_updates');
    }
};
