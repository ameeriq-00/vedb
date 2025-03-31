<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('seized_vehicles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('directorate_id')->constrained()->cascadeOnDelete();
            $table->foreignId('legal_article_id')->nullable()->constrained()->nullOnDelete();

            $table->string('accused_name');
            $table->string('vehicle_name');
            $table->string('vehicle_number');
            $table->string('governorate');
            $table->string('color');
            $table->string('model');
            $table->string('chassis_number')->unique();

            $table->enum('condition', ['صالحة', 'عاطلة'])->default('صالحة');

            $table->enum('status', [
                'محجوزة',
                'مصادرة',
                'مكتسبة',
                'مثمنة',
                'مصادق عليها',
                'مهداة',
                'مرقمة'
            ])->default('محجوزة');

            $table->boolean('is_released')->default(false); // إذا تم الإفراج عنها

            $table->boolean('is_external')->default(false); // إذا أحيلت إلى جهة خارجية

            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('seized_vehicles');
    }
};
