<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('defect_government_vehicle', function (Blueprint $table) {
            $table->id();
            $table->foreignId('defect_id')->constrained()->onDelete('cascade');
            $table->foreignId('government_vehicle_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('defect_government_vehicle');
    }
};
