<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            $table->string('customer_name');
            $table->string('phone');
            $table->string('email')->nullable();

            $table->integer('adults')->default(1);
            $table->integer('children')->default(0);
            $table->integer('total_people');

            $table->date('booking_date');
            $table->time('start_time');
            $table->time('end_time');

            $table->decimal('duration_hours', 3, 1);

            $table->decimal('total_price', 10, 2);

            $table->boolean('full_pool')->default(false);

            $table->enum('status', [
                'pending',
                'checked_in',
                'completed',
                'cancelled'
            ])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};