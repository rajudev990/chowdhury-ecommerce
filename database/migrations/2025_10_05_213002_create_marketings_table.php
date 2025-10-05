<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('marketings', function (Blueprint $table) {
            $table->id();
            $table->longText('facebook_pixel_code')->nullable();
            $table->longText('facebook_domain_verification')->nullable();
            $table->longText('google_analytics_header')->nullable();
            $table->longText('google_domain_verification')->nullable();
            $table->longText('google_body_tag')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marketings');
    }
};
