<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('legal_articles', function (Blueprint $table) {
            $table->id();
            $table->string('article_number')->unique(); // مثل المادة 14 من قانون كذا
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('legal_articles');
    }
};
