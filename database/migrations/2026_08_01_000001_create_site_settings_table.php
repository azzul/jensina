<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Single-row "settings" table. Everything <head> needs (title suffix,
     * default meta description, OG image, JSON-LD org data, contact info,
     * company profile PDF path) is pulled from here so app.blade.php never
     * hardcodes copy that a client will inevitably ask to change.
     */
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();

            // Identity
            $table->string('site_name')->default('Jensina Group');
            $table->string('site_name_short')->default('Jensina Group');
            $table->string('tagline_id')->nullable();
            $table->string('tagline_en')->nullable();

            // Legal entities under the group (shown in footer / about / JSON-LD)
            $table->string('legal_entity_1')->default('CV Anugerah Jensina Sejahtera');
            $table->string('legal_entity_2')->default('PT Maju Jensina Jaya');

            // Default SEO
            $table->string('default_meta_title_id')->nullable();
            $table->string('default_meta_title_en')->nullable();
            $table->text('default_meta_description_id')->nullable();
            $table->text('default_meta_description_en')->nullable();
            $table->string('default_og_image')->nullable();
            $table->string('canonical_domain')->default('https://jensina.id');

            // Contact
            $table->string('phone')->default('081111130357');
            $table->string('whatsapp')->nullable();
            $table->string('email')->default('info@jensina.id');
            $table->text('address')->default('Ngledok, RT. 003 RW. 008, Kel. Sroyo, Kec. Jaten, Kab. Karanganyar, Jawa Tengah');
            $table->decimal('map_lat', 10, 7)->nullable();
            $table->decimal('map_lng', 10, 7)->nullable();

            // Branding
            $table->string('logo_path')->nullable();
            $table->string('logo_alt_path')->nullable(); // second brand mark (AJS)
            $table->string('favicon_path')->nullable();
            $table->string('primary_color')->default('#3EC6E0'); // light blue tone from logo

            // Assets clients ask for constantly
            $table->string('company_profile_pdf')->nullable();

            // Social
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('youtube')->nullable();
            $table->string('linkedin')->nullable();

            // Analytics / verification (kept out of blade files on purpose)
            $table->string('gtm_id')->nullable();
            $table->string('ga4_id')->nullable();
            $table->string('google_site_verification')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
