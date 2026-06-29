<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pool_infos', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->string('type')->nullable();

            $table->string('length')->nullable();
            $table->string('width')->nullable();

            $table->string('min_depth')->nullable();
            $table->string('max_depth')->nullable();

            $table->integer('capacity')->default(50);

            $table->text('description')->nullable();
            $table->text('rules')->nullable();

            $table->string('address')->nullable();
            $table->string('google_map')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pool_infos');
    }
};
