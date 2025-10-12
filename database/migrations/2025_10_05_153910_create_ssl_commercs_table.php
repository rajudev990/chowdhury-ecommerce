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
        Schema::create('ssl_commercs', function (Blueprint $table) {
            $table->id();
            $table->string('sslcz_store_id')->nullable();
            $table->string('sslcz_store_password')->nullable();
            $table->string('sslcommerz_sandbox')->nullable();
            $table->string('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ssl_commercs');
    }
};
