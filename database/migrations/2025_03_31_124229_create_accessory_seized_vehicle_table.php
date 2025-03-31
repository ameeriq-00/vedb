<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('accessory_seized_vehicle', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seized_vehicle_id')->constrained()->cascadeOnDelete();
            $table->foreignId('accessory_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('accessory_seized_vehicle');
    }
};
