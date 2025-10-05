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
        Schema::create('bkashes', function (Blueprint $table) {
            $table->id();
            $table->string('bkash_app_key')->nullable();
            $table->string('bkash_secret_key')->nullable();
            $table->string('bkash_username')->nullable();
            $table->string('bkash_password')->nullable();
            $table->string('status')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bkashes');
    }
};
