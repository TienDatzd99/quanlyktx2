@extends('layouts.admin')

@section('content')
    <div class="ant-card">
        <div class="ant-card-head">
            <h3 class="ant-card-head-title">Sửa thông tin sinh viên</h3>
        </div>
        <div class="ant-card-body">
            <form method="POST" action="{{ route('students.update', $student) }}">
                @csrf
                @method('PUT')
                <div class="ant-form-item">
                    <label class="ant-form-item-label">Họ và tên</label>
                    <input type="text" name="name" class="ant-input" value="{{ old('name', $student->name) }}" required>
                    @error('name')
                        <div class="ant-form-item-explain-error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="ant-form-item">
                    <label class="ant-form-item-label">Email</label>
                    <input type="email" name="email" class="ant-input" value="{{ old('email', $student->email) }}" required>
                    @error('email')
                        <div class="ant-form-item-explain-error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="ant-form-item">
                    <label class="ant-form-item-label">Phòng</label>
                    <select name="room_id" class="ant-select" required>
                        <option value="">Chọn phòng</option>
                        @foreach ($rooms as $room)
                            <option value="{{ $room->id }}" {{ $student->room_id == $room->id ? 'selected' : '' }}>
                                {{ $room->room_number }} - {{ $room->status }} ({{ $room->users->count() }}/{{ $room->capacity }})
                            </option>
                        @endforeach
                    </select>
                    @error('room_id')
                        <div class="ant-form-item-explain-error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="ant-form-item">
                    <button type="submit" class="ant-btn ant-btn-primary">Lưu thay đổi</button>
                    <a href="{{ route('students.index') }}" class="ant-btn">Hủy</a>
                </div>
            </form>
        </div>
    </div>
@endsection