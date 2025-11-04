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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->decimal('total', 10, 2);
            $table->decimal('delivery_charge',10,2)->default(0);
            $table->decimal('coupon', 10, 2)->nullable();
            $table->decimal('paid', 10, 2)->nullable();
            $table->string('status')->default('pending');
            $table->string('payment_status')->default('pending');
            $table->string('payment_method')->nullable();
            $table->string('transaction_id')->nullable();
            $table->timestamp('payment_date')->nullable();
            $table->string('coupon_code')->nullable();
            $table->string('delivery_area')->nullable();
            $table->string('currency')->nullable();
            $table->string('notes')->nullable();
            
             // courier information
            $table->string('courier')->nullable(); // pathao, redx, steadfast
            $table->string('courier_status')->nullable(); // created, picked, in_transit, delivered
            $table->string('courier_tracking_id')->nullable();
            $table->json('courier_response')->nullable();

            // fraud and admin flags
            $table->boolean('is_fraud')->default(false);
            $table->boolean('is_blocked')->default(false); // admin blocked flag

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
