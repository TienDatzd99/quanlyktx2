<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with('users')->get();
        return view('rooms.index', compact('rooms'));
    }

    public function show(Room $room)
    {
        $room->load('items', 'reports'); // Tải quan hệ
        // Đặt tab mặc định là 'students'
        $activeTab = request()->input('tab', 'students'); // Lấy từ query string, mặc định 'students'
        return view('rooms.show', compact('room', 'activeTab'));
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('rooms.index')->with('success', 'Xóa phòng thành công!');
    }
}