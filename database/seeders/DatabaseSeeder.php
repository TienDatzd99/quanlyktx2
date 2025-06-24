<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Room;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Xóa dữ liệu cũ
        User::where('role', 'student')->delete();

        $rooms = Room::all()->pluck('id')->toArray();
        $lastNames = ['Nguyễn', 'Trần', 'Lê', 'Phạm', 'Hoàng', 'Huỳnh', 'Võ', 'Đặng', 'Bùi', 'Đỗ'];
        $firstNames = ['Anh', 'Bình', 'Cường', 'Dũng', 'Duy', 'Hà', 'Hải', 'Hạnh', 'Hòa', 'Hùng'];

        $students = [];
        for ($i = 1; $i <= 20; $i++) {
            $lastName = $lastNames[array_rand($lastNames)];
            $firstName = $firstNames[array_rand($firstNames)];
            $middleName = rand(0, 1) ? $firstNames[array_rand($firstNames)] : '';
            $fullName = trim("$lastName $middleName $firstName");

            $students[] = [
                'name' => $fullName,
                'email' => "student$i@example.com",
                'password' => Hash::make('password123'),
                'role' => 'student',
                'room_id' => $rooms[array_rand($rooms)],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        User::insert($students);

        // Thêm một admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);
    }
}