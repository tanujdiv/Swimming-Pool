<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('booking_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('membership_purchase_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('razorpay_order_id')->nullable();

            $table->string('razorpay_payment_id')->nullable();

            $table->string('razorpay_signature')->nullable();

            $table->decimal('amount', 10, 2);

            $table->string('payment_for');

            $table->string('status')->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
