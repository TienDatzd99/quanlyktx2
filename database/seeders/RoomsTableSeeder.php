<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomsTableSeeder extends Seeder
{
    public function run()
    {
        Room::truncate();
        $rooms = [
            ['room_number' => 'A101', 'floor' => 1, 'capacity' => 4, 'status' => 'Đang sử dụng'],
            ['room_number' => 'A102', 'floor' => 1, 'capacity' => 4, 'status' => 'Đang sử dụng'],
            ['room_number' => 'B201', 'floor' => 2, 'capacity' => 2, 'status' => 'Đang sử dụng'],
            ['room_number' => 'B202', 'floor' => 2, 'capacity' => 2, 'status' => 'Trống'],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}