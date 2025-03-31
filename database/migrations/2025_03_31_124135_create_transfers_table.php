<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('seized_vehicle_id')->constrained()->cascadeOnDelete();
            $table->string('recipient_name');
            $table->string('recipient_identity_number');
            $table->foreignId('to_directorate_id')->constrained('directorates')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // من قام بالمناقلة
            $table->date('transfer_date');

            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('transfers');
    }
};
