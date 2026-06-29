<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            $table->decimal('adult_price', 8, 2)->default(200);
            $table->decimal('child_price', 8, 2)->default(120);
            $table->decimal('full_pool_price', 8, 2)->default(8000);

            $table->decimal('min_duration', 3, 1)->default(1);
            $table->decimal('max_duration', 3, 1)->default(4);

            $table->integer('step_minutes')->default(30);

            $table->boolean('children_enabled')->default(true);
            $table->boolean('full_pool_enabled')->default(true);
            $table->boolean('booking_enabled')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
