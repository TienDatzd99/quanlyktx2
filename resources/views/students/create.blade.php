@extends('layouts.admin')

@section('content')
    <div class="card-container">
        <h3 class="card-title">Thêm sinh viên</h3>
        <form method="POST" action="{{ route('students.store') }}">
            @csrf
            <div class="ant-form-item">
                <label class="ant-form-item-label">Họ và tên</label>
                <input type="text" name="name" class="ant-input" required>
            </div>
            <div class="ant-form-item">
                <label class="ant-form-item-label">Email</label>
                <input type="email" name="email" class="ant-input" required>
            </div>
            <div class="ant-form-item">
                <label class="ant-form-item-label">Phòng</label>
                <select name="room_id" class="ant-select" required>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}">{{ $room->room_number }}</option>
                    @endforeach
                </select>
                @error('room_id')
                    <div class="ant-form-item-explain-error">{{ $message }}</div>
                @enderror
            </div>
            <div class="ant-form-item">
                <button type="submit" class="ant-btn ant-btn-primary">Thêm</button>
                <a href="{{ route('students.index') }}" class="ant-btn">Hủy</a>
            </div>
        </form>
    </div>
@endsection