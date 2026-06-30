<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use App\Models\Notification;
use Carbon\Carbon;

class CheckExpiredBookings extends Command
{
    protected $signature = 'bookings:check-expired';

    protected $description = 'Check expired bookings';

    public function handle()
    {
        $expired = Booking::where('status', 'checked_in')
            ->where('end_at', '<=', Carbon::now())
            ->get();

        foreach ($expired as $booking) {

            Notification::create([
                'title' => 'Booking Expired',
                'message' => $booking->customer_name . ' session completed'
            ]);

            $booking->status = 'completed';
            $booking->save();
        }
    }
}
