<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function index()
    {
        $students = User::where('role', 'student')
            ->with('room')
            ->get();
        $rooms = Room::all();
        return view('students.index', compact('students', 'rooms'));
    }

    public function create()
    {
        $rooms = Room::all();
        return view('students.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'room_id' => 'nullable|exists:rooms,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'student',
            'room_id' => $request->room_id,
        ]);

        return redirect()->route('students.index')->with('success', 'Thêm sinh viên thành công!');
    }

    public function edit(User $student)
    {
        $rooms = Room::all();
        return view('students.edit', compact('student', 'rooms'));
    }

    public function update(Request $request, User $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $student->id,
            'room_id' => 'nullable|exists:rooms,id',
        ]);

        $student->update($request->only(['name', 'email', 'room_id']));
        return redirect()->route('students.index')->with('success', 'Cập nhật sinh viên thành công!');
    }

    public function destroy(User $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Xóa sinh viên thành công!');
    }
}