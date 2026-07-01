<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('membership_purchases', function (Blueprint $table) {
            $table->id();

            $table->string('customer_name');
            $table->string('phone');
            $table->string('email')->nullable();

            $table->foreignId('membership_id')->constrained()->onDelete('cascade');

            $table->decimal('price', 10, 2);
            $table->date('start_date');
            $table->date('end_date');

            $table->string('status')->default('active');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('membership_purchases');
    }
};
