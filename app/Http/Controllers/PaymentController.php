<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();

        // Dữ liệu giả lập cho thanh toán (có thể lấy từ form hoặc database)
        $paymentData = [
            'user_id' => $user->id,
            'room_id' => $user->room_id,
            'amount' => 1000000.00, // Giả lập số tiền
            'type' => 'monthly',
            'status' => 'paid',
            'payment_date' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Tạo bản ghi mới trong bảng payments
        Payment::create($paymentData);

        return response()->json(['message' => 'Thanh toán thành công!'], 200);
    }
}