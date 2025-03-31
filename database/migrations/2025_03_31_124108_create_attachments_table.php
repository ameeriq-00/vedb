<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seized_vehicle_id')->constrained()->cascadeOnDelete();
            $table->string('file_path');
            $table->string('type')->nullable(); // وصف أو نوع الملف
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // من قام بالرفع
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('attachments');
    }
};
