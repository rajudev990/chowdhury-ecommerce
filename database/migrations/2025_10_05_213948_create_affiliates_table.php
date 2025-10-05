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
        Schema::create('affiliates', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('lname');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('website_url')->nullable();
            $table->string('social_media_link')->nullable();
            $table->string('promotion_method')->nullable();
            $table->string('referal_name_id')->nullable();
            $table->string('image')->nullable();
            $table->enum('status', ['pending', 'active', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affiliates');
    }
};
