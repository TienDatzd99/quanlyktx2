<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;
use App\Models\User;
use App\Models\Room;

class PaymentsTableSeeder extends Seeder
{
    public function run()
    {
        Payment::truncate();
        $users = User::where('role', 'student')->get()->pluck('id')->toArray();
        $rooms = Room::all()->pluck('id')->toArray();

        $payments = [];
        foreach ($users as $index => $userId) {
            $status = $index < 2 ? 'pending' : 'paid'; // 2 sinh viên chưa thanh toán
            $payment_date = $status === 'paid' ? now()->subDays(rand(1, 30)) : null;

            $payments[] = [
                'user_id' => $userId,
                'room_id' => $rooms[array_rand($rooms)],
                'amount' => 1000000,
                'type' => 'monthly',
                'status' => $status,
                'payment_date' => $payment_date,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        foreach ($payments as $payment) {
            Payment::create($payment);
        }
    }
}