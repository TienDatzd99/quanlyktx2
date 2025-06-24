@extends('layouts.admin')

@section('content')
    <div class="ant-card">
        <div class="ant-card-head">
            <h3 class="ant-card-head-title">Gửi Thông Báo</h3>
        </div>
        <div class="ant-card-body">
            @if ($errors->any())
                <div class="ant-message-error" style="color: #ff4d4f; margin-bottom: 1rem;">
                    {{ $errors->first() }}
                </div>
            @endif
            @if (session('success'))
                <div class="ant-message-success" style="color: #52c41a; margin-bottom: 1rem;">
                    {{ session('success') }}
                </div>
            @endif
            <form method="POST" action="{{ route('notifications.store') }}">
                @csrf
                <div class="ant-form-item">
                    <label class="ant-form-item-label">Chọn sinh viên</label>
                    <select name="user_id" class="ant-select" required>
                        <option value="">Chọn sinh viên</option>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}">{{ $student->name }} ({{ $student->email }})</option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <div class="ant-form-item-explain-error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="ant-form-item">
                    <label class="ant-form-item-label">Nội dung thông báo</label>
                    <textarea name="message" class="ant-input" rows="4" required>{{ old('message') }}</textarea>
                    @error('message')
                        <div class="ant-form-item-explain-error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="ant-form-item">
                    <button type="submit" class="ant-btn ant-btn-primary">Gửi thông báo</button>
                    <a href="{{ route('students.index') }}" class="ant-btn">Hủy</a>
                </div>
            </form>
        </div>
    </div>
@endsection