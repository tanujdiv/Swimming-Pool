<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::latest()->get();

        return view(
            'admin.notifications',
            compact('notifications')
        );
    }

    public function markAllRead()
    {
        Notification::where('is_read', false)
            ->update([
                'is_read' => true
            ]);

        return back()
            ->with('success', 'All notifications marked as read.');
    }

    public function destroy(Notification $notification)
    {
        $notification->delete();

        return back()
            ->with('success', 'Notification deleted successfully.');
    }
}
