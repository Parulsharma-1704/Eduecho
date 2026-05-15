<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Broadcast a notification to all users, a role, or a specific user.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'             => 'required|string|max:255',
            'message'           => 'required|string|max:1000',
            'notification_type' => 'required|string|in:announcement,alert,reminder,info',
            'target'            => 'required|in:all,student,special_educator,therapist',
        ]);

        $target = $validated['target'];

        if ($target === 'all') {
            $users = User::all();
        } else {
            $users = User::role($target)->get();
        }

        foreach ($users as $user) {
            Notification::create([
                'user_id'           => $user->id,
                'title'             => $validated['title'],
                'message'           => $validated['message'],
                'notification_type' => $validated['notification_type'],
                'is_read'           => false,
            ]);
        }

        return redirect()->back()->with('success', "Notification sent to {$users->count()} user(s) successfully.");
    }

    /**
     * Mark a notification as read.
     */
    public function markRead(Notification $notification)
    {
        $notification->update(['is_read' => true, 'read_at' => now()]);
        return redirect()->back()->with('success', 'Notification marked as read.');
    }

    /**
     * Delete a notification.
     */
    public function destroy(Notification $notification)
    {
        $notification->delete();
        return redirect()->back()->with('success', 'Notification deleted.');
    }
}
