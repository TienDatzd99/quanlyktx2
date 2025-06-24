@extends('layouts.admin')

@section('content')
    <style>
        .card-container {
            background: #ffffff;
            border-radius: 12px;
            padding: 30px;
            margin-top: 30px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease-in-out;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .card-title {
            font-size: 22px;
            font-weight: 700;
            color: #1f1f1f;
        }

        .ant-btn {
            border-radius: 6px;
            padding: 8px 14px;
            font-weight: 500;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .ant-btn-primary {
            background-color: #1677ff;
            border-color: #1677ff;
            color: #fff;
        }

        .ant-btn-primary:hover {
            background-color: #4096ff;
        }

        .ant-btn-danger {
            background-color: #ff4d4f;
            border-color: #ff4d4f;
            color: #fff;
        }

        .ant-btn-danger:hover {
            background-color: #ff7875;
        }

        .ant-btn-sm {
            font-size: 13px;
            padding: 5px 10px;
        }

        .ant-table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 12px;
            overflow: hidden;
        }

        .ant-table thead th {
            background: #f9fafc;
            color: #4a4a4a;
            font-weight: 600;
            font-size: 14px;
            padding: 14px 16px;
            border-bottom: 1px solid #e0e0e0;
        }

        .ant-table tbody td {
            text-align: center;
            font-size: 14px;
            padding: 14px 16px;
            color: #333;
            border-bottom: 1px solid #f0f0f0;
        }

        .ant-table tbody tr:hover {
            background-color: #f5f7fa;
        }

        .unpaid-row {
            background-color: #fff5f5;
        }

        .ant-tag {
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
        }

        .ant-tag-green {
            background-color: #f6ffed;
            color: #389e0d;
            border: 1px solid #b7eb8f;
        }

        .ant-tag-red {
            background-color: #fff1f0;
            color: #cf1322;
            border: 1px solid #ffa39e;
        }

        .action-buttons a,
        .action-buttons form {
            display: inline-block;
            margin-right: 6px;
        }

        .text-center {
            text-align: center;
            padding: 20px;
            color: #999;
            font-style: italic;
        }
    </style>

    <div class="card-container">
        <div class="card-header">
            <h3 class="card-title">📋 Quản lý Sinh viên</h3>
            <a href="{{ route('students.create') }}" class="ant-btn ant-btn-primary">
                <span class="anticon anticon-user-add"></span> Thêm sinh viên
            </a>
        </div>

        <table class="ant-table">
            <thead>
                <tr>
                    <th>👤 Họ và tên</th>
                    <th>📧 Email</th>
                    <th>🏠 Phòng</th>
                    <th>💰 Thanh toán</th>
                    <th>⚙️ Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($students as $student)
                    <tr class="{{ $student->hasNotPaid() ? 'unpaid-row' : '' }}">
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>
                            <span class="anticon anticon-home"></span>
                            {{ $student->room ? $student->room->room_number : 'Không xác định' }}
                        </td>
                        <td>
                            <span class="ant-tag {{ $student->hasNotPaid() ? 'ant-tag-red' : 'ant-tag-green' }}">
                                {{ $student->hasNotPaid() ? 'Chưa nộp tiền' : 'Đã nộp tiền' }}
                            </span>
                        </td>
                        <td class="action-buttons">
                            <a href="{{ route('students.edit', $student) }}" class="ant-btn ant-btn-primary ant-btn-sm">
                                ✏️ Sửa
                            </a>
                            <a href="{{ route('notifications.create') }}?user_id={{ $student->id }}" class="ant-btn ant-btn-sm">
                                📩 Thông báo
                            </a>
                            <form action="{{ route('students.destroy', $student) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sinh viên này?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="ant-btn ant-btn-danger ant-btn-sm">
                                    🗑️ Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Không có sinh viên nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection