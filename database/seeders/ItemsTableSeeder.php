<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\Room;

class ItemsTableSeeder extends Seeder
{
    public function run()
    {
        Item::truncate();
        $rooms = Room::all()->pluck('id')->toArray();
        $itemTemplates = [
            ['name' => 'Bàn học', 'status' => 'active'],
            ['name' => 'Ghế', 'status' => 'active'],
            ['name' => 'Giường', 'status' => 'active'],
            ['name' => 'Đèn', 'status' => 'active'],
            ['name' => 'Quạt', 'status' => 'active'],
            ['name' => 'Tủ quần áo', 'status' => 'active'],
            ['name' => 'Kệ sách', 'status' => 'active'],
            ['name' => 'Điều hòa', 'status' => 'active'],
        ];

        foreach ($rooms as $room_id) {
            foreach ($itemTemplates as $itemTemplate) {
                Item::create([
                    'room_id' => $room_id,
                    'name' => $itemTemplate['name'],
                    'status' => $itemTemplate['status'],
                ]);
            }
        }
    }
}