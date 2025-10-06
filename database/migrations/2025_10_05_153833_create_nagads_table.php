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
        Schema::create('nagads', function (Blueprint $table) {
            $table->id();
            $table->string('nagad_app_key')->nullable();
            $table->string('nagad_secret_key')->nullable();
            $table->string('nagad_username')->nullable();
            $table->string('nagad_password')->nullable();
            $table->string('status')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nagads');
    }
};
