<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {

            $table->string('payment_method')
                ->default('offline')
                ->after('total_price');

            $table->string('payment_status')
                ->default('pending')
                ->after('payment_method');

            $table->string('payment_id')
                ->nullable()
                ->after('payment_status');

            $table->string('razorpay_order_id')
                ->nullable()
                ->after('payment_id');

            $table->string('razorpay_signature')
                ->nullable()
                ->after('razorpay_order_id');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {

            $table->dropColumn([

                'payment_method',

                'payment_status',

                'payment_id',

                'razorpay_order_id',

                'razorpay_signature'

            ]);
        });
    }
};
