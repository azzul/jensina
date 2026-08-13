<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Generic CMS-style page. about-us, privacy-policy, terms-condition and
     * any number of "custom-content" SEO landing pages are all rows here,
     * rendered by the same PageController@show + pages/show.blade.php view.
     * `type` just lets the view pick a slightly different layout partial
     * (e.g. about-us shows the org structure block, custom pages don't).
     */
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->enum('type', ['about', 'privacy', 'terms', 'custom'])->default('custom');

            $table->string('title_id');
            $table->string('title_en');
            $table->longText('content_id')->nullable();
            $table->longText('content_en')->nullable();

            $table->string('hero_image')->nullable();

            $table->string('meta_title_id')->nullable();
            $table->string('meta_title_en')->nullable();
            $table->text('meta_description_id')->nullable();
            $table->text('meta_description_en')->nullable();

            $table->boolean('show_in_menu')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
