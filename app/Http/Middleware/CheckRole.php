<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để tiếp tục.');
        }

        if ($request->user()->role !== $role) {
            return redirect()->route('home')->with('error', 'Bạn không có quyền truy cập chức năng này.');
        }

        return $next($request);
    }
}