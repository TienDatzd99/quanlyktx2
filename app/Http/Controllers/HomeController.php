<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application; // Giả định model để lưu đơn đăng ký

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function registerApplication(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        // Lưu đơn đăng ký (giả định có bảng applications)
        Application::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'user_id' => auth()->id(), // Liên kết với người dùng đăng nhập
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('home')->with('success', 'Đăng ký thành công!');
    }
}