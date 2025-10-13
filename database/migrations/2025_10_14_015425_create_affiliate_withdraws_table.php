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
        Schema::create('affiliate_withdraws', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('affiliate_id')->nullable();
            $table->decimal('amount',10,2)->nullable();
            $table->string('payment_method')->nullable();
            $table->longText('payment_info')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affiliate_withdraws');
    }
};
