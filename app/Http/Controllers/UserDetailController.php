<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Room;

class UserDetailController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $roomDetails = null;
        $roomItems = [];
        $hasNoPayment = false;

        if ($user->room_id) {
            $roomDetails = Room::with('users', 'items')->find($user->room_id);
            $roomItems = $roomDetails->items ?? [];
            
            // Kiểm tra xem không có bản ghi thanh toán nào cho người dùng
            $hasNoPayment = !$user->payments()->exists();
        }

        return view('user-detail.index', compact('user', 'roomDetails', 'roomItems', 'hasNoPayment'));
    }
}