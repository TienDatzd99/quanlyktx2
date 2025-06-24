@extends('layouts.admin')

@section('content')
    <style>
        .ant-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            margin-bottom: 24px;
            padding: 24px;
            transition: all 0.3s ease;
        }

        .ant-card-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
            border-bottom: 1px solid #f0f0f0;
        }

        .ant-card-head-title {
            font-size: 22px;
            font-weight: 700;
            color: #1f1f1f;
        }

        .ant-card-extra a {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 500;
            background-color: #1890ff;
            color: #fff;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .ant-card-extra a:hover {
            background-color: #40a9ff;
        }

        .ant-table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
        }

        .ant-table-thead th {
            background-color: #fafafa;
            font-weight: 600;
            padding: 14px;
            text-align: center !important;
            border-bottom: 1px solid #f0f0f0;
            color: #444;
        }

        .ant-table-tbody td {
            text-align: center;
            padding: 14px;
            border-bottom: 1px solid #f0f0f0;
            color: #333;
        }

        .ant-table-tbody tr:hover {
            background-color: #f9f9f9;
        }

        .ant-btn {
            margin-right: 6px;
            padding: 6px 12px;
            font-size: 13px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
        }

        .ant-btn-primary {
            background-color: #1890ff;
            color: white;
        }

        .ant-btn-primary:hover {
            background-color: #40a9ff;
        }

        .ant-btn-danger {
            background-color: #ff4d4f;
            color: white;
        }

        .ant-btn-danger:hover {
            background-color: #ff7875;
        }

        .ant-tag {
            display: inline-block;
            padding: 4px 10px;
            font-size: 12px;
            border-radius: 4px;
            font-weight: 500;
            color: #fff;
        }

        .ant-tag.green {
            background-color: #52c41a;
        }

        .ant-tag.blue {
            background-color: #1890ff;
        }

        .ant-tag.red {
            background-color: #ff4d4f;
        }

        a {
            color: #1890ff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>

    <div class="ant-card">
        <div class="ant-card-head">
            <h3 class="ant-card-head-title">Danh sách Phòng</h3>
            <div class="ant-card-extra">
                <a href="#" onclick="alert('Chức năng thêm phòng đang phát triển!')">
                    <span class="anticon anticon-plus"></span> Thêm phòng
                </a>
            </div>
        </div>
        <div class="ant-card-body">
            <table class="ant-table">
                <thead class="ant-table-thead">
                    <tr>
                        <th>Số phòng</th>
                        <th>Tầng</th>
                        <th>Sức chứa</th>
                        <th>Trạng thái</th>
                        <th>Sinh viên</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody class="ant-table-tbody">
                    @forelse ($rooms as $room)
                        <tr>
                            <td><a href="{{ route('rooms.show', $room->id) }}">{{ $room->room_number }}</a></td>
                            <td>{{ $room->floor }}</td>
                            <td>{{ $room->capacity }}</td>
                            <td>
                                <span class="ant-tag {{ $room->status === 'Trống' ? 'green' : 'blue' }}">
                                    {{ $room->status }}
                                </span>
                            </td>
                            <td>{{ $room->users->count() }} / {{ $room->capacity }}</td>
                            <td>
                                <a href="#" class="ant-btn ant-btn-primary" onclick="alert('Chức năng sửa phòng đang phát triển!')">
                                    <span class="anticon anticon-edit"></span> Sửa
                                </a>
                                <form action="{{ route('rooms.destroy', $room) }}" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa phòng này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="ant-btn ant-btn-danger">
                                        <span class="anticon anticon-delete"></span> Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center;">Không có phòng nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
