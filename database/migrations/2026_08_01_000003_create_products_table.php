<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->string('slug')->unique();

            // Bilingual content
            $table->string('name_id');
            $table->string('name_en');
            $table->string('excerpt_id')->nullable();
            $table->string('excerpt_en')->nullable();
            $table->longText('description_id')->nullable();
            $table->longText('description_en')->nullable();

            // Media
            $table->string('thumbnail')->nullable();
            $table->json('gallery')->nullable(); // array of image paths

            // Specs (kept flexible instead of a rigid spec table)
            $table->json('specifications')->nullable(); // [{label_id, label_en, value}]

            // SEO
            $table->string('meta_title_id')->nullable();
            $table->string('meta_title_en')->nullable();
            $table->text('meta_description_id')->nullable();
            $table->text('meta_description_en')->nullable();

            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index(['is_active', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
