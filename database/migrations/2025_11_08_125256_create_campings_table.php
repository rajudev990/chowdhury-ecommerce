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
        Schema::create('campings', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->string('logo')->nullable();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->longText('camping_description')->nullable();
            $table->string('video_type')->nullable();
            $table->string('video')->nullable();
            $table->string('bannar')->nullable();
            $table->string('bannar_1')->nullable();
            $table->string('bannar_2')->nullable();
            $table->string('bannar_3')->nullable();
            $table->string('bannar_4')->nullable();
            $table->string('bannar_5')->nullable();
            $table->string('bannar_6')->nullable();
            $table->string('bannar_7')->nullable();
            $table->string('bannar_8')->nullable();
            $table->string('bannar_9')->nullable();
            $table->string('bannar_10')->nullable();
            $table->string('image_1')->nullable();
            $table->string('image_2')->nullable();
            $table->string('image_3')->nullable();
            $table->string('why_buy_title')->nullable();
            $table->longText('why_buy_description')->nullable();
            $table->string('why_buy_image')->nullable();
            $table->string('about_title')->nullable();
            $table->longText('about_description')->nullable();
            $table->string('about_image')->nullable();
            $table->string('product_id')->nullable();
            $table->string('product_title')->nullable();
            $table->string('product_name')->nullable();
            $table->longText('product_description')->nullable();
            $table->string('status')->default('deactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campings');
    }
};
