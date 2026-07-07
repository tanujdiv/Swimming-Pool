<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {

            $table->boolean('pay_online')
                ->default(true)
                ->after('children_enabled');

            $table->boolean('pay_on_pool')
                ->default(true)
                ->after('pay_online');

            $table->decimal('offline_charge', 10, 2)
                ->default(0)
                ->after('pay_on_pool');

            $table->decimal('gateway_charge', 10, 2)
                ->default(0)
                ->after('offline_charge');

            $table->decimal('gst_percentage', 5, 2)
                ->default(0)
                ->after('gateway_charge');
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {

            $table->dropColumn([
                'pay_online',
                'pay_on_pool',
                'offline_charge',
                'gateway_charge',
                'gst_percentage'
            ]);
        });
    }
};
