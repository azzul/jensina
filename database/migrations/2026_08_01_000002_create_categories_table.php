<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name_id');
            $table->string('name_en');
            $table->text('description_id')->nullable();
            $table->text('description_en')->nullable();
            $table->string('icon')->nullable(); // e.g. 'crane', 'truck' for UI
            $table->string('image')->nullable(); // photo shown on the "Layanan Kami" cards
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
