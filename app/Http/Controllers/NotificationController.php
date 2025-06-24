<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\StudentNotification;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    public function create()
    {
        $students = User::where('role', 'student')->get();
        return view('notifications.create', compact('students'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        $user = User::find($request->user_id);
        Notification::send($user, new StudentNotification($request->message));

        return redirect()->route('students.index')->with('success', 'Gửi thông báo thành công!');
    }
}