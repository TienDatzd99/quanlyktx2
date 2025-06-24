<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Room;
use App\Models\Item;
use App\Models\Payment;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Thêm admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Thêm sinh viên
        $student = User::create([
            'name' => 'Student 1',
            'email' => 'student1@example.com',
            'password' => bcrypt('password123'),
            'role' => 'student',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Thêm phòng
        $room = Room::create([
            'room_number' => '101',
            'type' => 'Tiêu chuẩn',
            'capacity' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Gán phòng cho sinh viên
        $student->update(['room_id' => $room->id]);

        // Thêm đồ dùng
        Item::create([
            'name' => 'Ghế',
            'room_id' => $room->id,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Item::create([
            'name' => 'Bàn',
            'room_id' => $room->id,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Thêm thanh toán (mặc định paid)
        Payment::create([
            'user_id' => $student->id,
            'room_id' => $room->id,
            'amount' => 1000000.00,
            'type' => 'monthly',
            'status' => 'paid',
            'payment_date' => now()->subMonth(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}