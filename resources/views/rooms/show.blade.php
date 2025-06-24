@extends('layouts.admin')

@section('content')
    <style>
        .room-detail-container {
            padding: 24px;
        }
        .room-detail-header {
            display: flex;
            align-items: center;
            margin-bottom: 24px;
        }
        .back-button {
            margin-right: 16px;
        }
        .info-item {
            margin-bottom: 16px;
        }
        .tab-header {
            margin-bottom: 16px;
        }
        .ant-card {
            margin-bottom: 24px;
        }
        .ant-tabs {
            margin-bottom: 24px;
        }
        .ant-tabs-nav {
            display: flex;
            border-bottom: 1px solid #f0f0f0;
            margin-bottom: 16px;
        }
        .ant-tabs-tab {
            padding: 8px 16px;
            cursor: pointer;
            margin-right: 16px;
            font-weight: 500;
            color: #666;
            transition: color 0.3s;
        }
        .ant-tabs-tab-active {
            color: #1890ff;
            border-bottom: 2px solid #1890ff;
        }
        .ant-tabs-tabpane {
            display: none;
        }
        .ant-tabs-tabpane.active {
            display: block;
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }
        .modal-content {
            background: #fff;
            margin: 15% auto;
            padding: 20px;
            border-radius: 4px;
            width: 80%;
            max-width: 500px;
            position: relative;
        }
        .close {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 24px;
            cursor: pointer;
            color: #999;
        }
        .close:hover {
            color: #000;
        }
        .ant-form-item {
            margin-bottom: 16px;
        }
        .ant-form-item-label {
            font-weight: 500;
            margin-bottom: 8px;
            display: block;
        }
        .ant-input, .ant-select {
            width: 100%;
            padding: 8px;
            border: 1px solid #d9f9d9;
            border-radius: 4px;
        }
        .ant-select {
            appearance: none;
            background: #fff;
        }
        .ant-btn {
            margin-right: 8px;
        }
        .ant-btn-primary {
            background-color: #1890ff;
            border-color: #1890ff;
            color: #fff;
        }
        .ant-btn-primary:hover {
            background-color: #40a9ff;
            border-color: #40a9ff;
        }
        .ant-btn-danger {
            background-color: #ff4d4f;
            border-color: #ff4d4f;
            color: #fff;
        }
        .ant-btn-danger:hover {
            background-color: #ff7875;
            border-color: #ff7875;
        }
        .ant-btn-sm {
            font-size: 12px;
            padding: 4px 10px;
        }
        .anticon {
            margin-right: 4px;
        }
        .ant-table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
        }
        .ant-table-thead th {
            background-color: #fafafa;
            font-weight: 600;
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #f0f0f0;
        }
        .ant-table-tbody td {
            padding: 12px;
            border-bottom: 1px solid #f0f0f0;
        }
        .ant-table-tbody tr:hover {
            background-color: #f5f5f5;
        }
    </style>

    <div class="room-detail-container">
        <div class="room-detail-header">
            <a href="{{ route('rooms.index') }}" class="ant-btn ant-btn-link back-button">
                <span class="anticon anticon-arrow-left"></span> Quay lại
            </a>
            <h2 class="ant-typography">Chi tiết phòng {{ $room->room_number }}</h2>
        </div>

        <div class="ant-row ant-row-gutter-16">
            <div class="ant-col ant-col-8">
                <div class="ant-card" style="border: none;">
                    <div class="ant-card-head">
                        <h3 class="ant-card-head-title">Thông tin cơ bản</h3>
                    </div>
                    <div class="ant-card-body">
                        <div class="info-item">
                            <span class="ant-typography-strong">Số phòng:</span>
                            <span>{{ $room->room_number }}</span>
                        </div>
                        <div class="info-item">
                            <span class="ant-typography-strong">Tầng:</span>
                            <span>{{ $room->floor }}</span>
                        </div>
                        <div class="info-item">
                            <span class="ant-typography-strong">Sức chứa:</span>
                            <span>{{ $room->capacity }} người</span>
                        </div>
                        <div class="info-item">
                            <span class="ant-typography-strong">Đang ở:</span>
                            <span>{{ $room->users->count() }} người</span>
                        </div>
                        <div class="info-item">
                            <span class="ant-typography-strong">Trạng thái:</span>
                            <span class="ant-tag {{ $room->status === 'Trống' ? 'ant-tag-green' : 'ant-tag-blue' }}">
                                {{ $room->status }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ant-col ant-col-16">
                <div class="ant-card">
                    <div class="ant-tabs-nav">
                        <div class="ant-tabs-tab {{ $activeTab === 'students' ? 'ant-tabs-tab-active' : '' }}" onclick="switchTab('students')">
                            <span class="anticon anticon-user"></span> Sinh viên ({{ $room->users->count() }})
                        </div>
                        <div class="ant-tabs-tab {{ $activeTab === 'items' ? 'ant-tabs-tab-active' : '' }}" onclick="switchTab('items')">
                            <span class="anticon anticon-tool"></span> Đồ dùng ({{ $room->items->count() }})
                        </div>
                        <div class="ant-tabs-tab {{ $activeTab === 'reports' ? 'ant-tabs-tab-active' : '' }}" onclick="switchTab('reports')">
                            <span class="anticon anticon-warning"></span> Báo cáo sự cố ({{ $room->reports->count() }})
                        </div>
                    </div>
                    <div class="ant-tabs-content">
                        <div class="ant-tabs-tabpane {{ $activeTab === 'students' ? 'active' : '' }}" id="students-pane">
                            <div class="tab-header">
                                <a href="#" class="ant-btn ant-btn-primary" onclick="showModal('add-student')">
                                    Thêm sinh viên
                                </a>
                            </div>
                            <table class="ant-table" id="students-table">
                                <thead class="ant-table-thead">
                                    <tr>
                                        <th>Họ tên</th>
                                        <th>Email</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody class="ant-table-tbody">
                                    @forelse ($room->users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <a href="#" class="ant-btn ant-btn-primary ant-btn-sm" onclick="showModal('edit-student', {{ $user->id }})">
                                                    <span class="anticon anticon-edit"></span> Sửa
                                                </a>
                                                <form action="{{ route('students.destroy', $user) }}" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sinh viên này?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="ant-btn ant-btn-danger ant-btn-sm">
                                                        <span class="anticon anticon-delete"></span> Xóa
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" style="text-align: center;">Không có sinh viên nào.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="ant-tabs-tabpane {{ $activeTab === 'items' ? 'active' : '' }}" id="items-pane">
                            <div class="tab-header">
                                <a href="#" class="ant-btn ant-btn-primary" onclick="showModal('add-item')">
                                    Thêm đồ dùng
                                </a>
                            </div>
                            <table class="ant-table" id="items-table">
                                <thead class="ant-table-thead">
                                    <tr>
                                        <th>Tên đồ dùng</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody class="ant-table-tbody">
                                    @forelse ($room->items as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                <span class="ant-tag {{ $item->status === 'Tốt' ? 'ant-tag-green' : 'ant-tag-orange' }}">
                                                    {{ $item->status }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="#" class="ant-btn ant-btn-primary ant-btn-sm" onclick="showModal('edit-item', {{ $item->id }})">
                                                    <span class="anticon anticon-edit"></span> Sửa
                                                </a>
                                                <form action="{{ route('items.destroy', $item) }}" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đồ dùng này?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="ant-btn ant-btn-danger ant-btn-sm">
                                                        <span class="anticon anticon-delete"></span> Xóa
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" style="text-align: center;">Không có đồ dùng nào.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="ant-tabs-tabpane {{ $activeTab === 'reports' ? 'active' : '' }}" id="reports-pane">
                            <div class="tab-header">
                                <a href="#" class="ant-btn ant-btn-primary" onclick="showModal('add-report')">
                                    Thêm báo cáo
                                </a>
                            </div>
                            <table class="ant-table" id="reports-table">
                                <thead class="ant-table-thead">
                                    <tr>
                                        <th>Mô tả</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày báo cáo</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody class="ant-table-tbody">
                                    @forelse ($room->reports as $report)
                                        <tr>
                                            <td>{{ $report->description }}</td>
                                            <td>
                                                <span class="ant-tag {{ $report->status === 'Đã xử lý' ? 'ant-tag-green' : 'ant-tag-red' }}">
                                                    {{ $report->status }}
                                                </td>
                                            <td>{{ $report->date }}</td>
                                            <td>
                                                <a href="#" class="ant-btn ant-btn-primary ant-btn-sm" onclick="showModal('edit-report', {{ $report->id }})">
                                                    <span class="anticon anticon-edit"></span> Sửa
                                                </a>
                                                <form action="{{ route('reports.destroy', $report) }}" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa báo cáo này?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="ant-btn ant-btn-danger ant-btn-sm">
                                                        <span class="anticon anticon-delete"></span> Xóa
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" style="text-align: center;">Không có báo cáo nào.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div id="modal" class="modal" style="display: none;">
            <div class="modal-content">
                <span class="close" onclick="hideModal()">×</span>
                <h3 id="modal-title"></h3>
                <form id="modal-form">
                    <div class="ant-form-item">
                        <label id="modal-label1"></label>
                        <input type="text" id="modal-input1" class="ant-input" required>
                    </div>
                    <div class="ant-form-item" id="modal-field2" style="display: none;">
                        <label id="modal-label2"></label>
                        <select id="modal-select" class="ant-select">
                            <option value="Tốt">Tốt</option>
                            <option value="Cần sửa chữa">Cần sửa chữa</option>
                        </select>
                    </div>
                    <div class="ant-form-item" id="modal-field3" style="display: none;">
                        <label id="modal-label3"></label>
                        <select id="modal-select2">
                            <option value="Đang xử lý">Đang xử lý</option>
                            <option value="Đã xử lý">Đã xử lý</option>
                        </select>
                    </div>
                    <button type="submit" class="ant-btn ant-btn-primary">Lưu</button>
                    <button type="button" class="ant-btn" onclick="hideModal()">Hủy</button>
                </form>
            </div>
        </div>

        <script>
            let activeTab = '{{ $activeTab }}'; // Lấy giá trị từ controller

            function switchTab(tab) {
                activeTab = tab;
                const tabpanes = document.querySelectorAll('.ant-tabs-tabpane');
                tabpanes.forEach(pane => {
                    const paneElement = pane; // Tránh lỗi null
                    if (paneElement) {
                        paneElement.classList.remove('active');
                        const table = paneElement.querySelector('table');
                        if (table) table.style.display = 'none';
                    }
                });
                const activePane = document.getElementById(`${tab}-pane`);
                if (activePane) {
                    activePane.classList.add('active');
                    const table = activePane.querySelector('table');
                    if (table) table.style.display = 'table';
                }
                const tabs = document.querySelectorAll('.ant-tabs-tab');
                tabs.forEach(t => t.classList.remove('ant-tabs-tab-active'));
                document.querySelector(`.ant-tabs-tab.${tab}`).classList.add('ant-tabs-tab-active');
            }

            // Khởi tạo tab mặc định
            document.addEventListener('DOMContentLoaded', () => {
                switchTab(activeTab);
                // Đảm bảo bảng hiển thị khi tab được chọn
                const tables = document.querySelectorAll('.ant-table');
                tables.forEach(table => {
                    const paneId = table.id.replace('-table', '-pane');
                    table.style.display = activeTab === paneId.replace('pane-', '') ? 'table' : 'none';
                });
            });

            function showModal(type, id = null) {
                const modal = document.getElementById('modal');
                const modalTitle = document.getElementById('modal-title');
                const modalLabel1 = document.getElementById('modal-label1');
                const modalInput1 = document.getElementById('modal-input1');
                const modalField2 = document.getElementById('modal-field2');
                const modalLabel2 = document.getElementById('modal-label2');
                const modalSelect = document.getElementById('modal-select');
                const modalField3 = document.getElementById('modal-field3');
                const modalLabel3 = document.getElementById('modal-label3');
                const modalSelect2 = document.getElementById('modal-select2');

                modal.style.display = 'block';
                modalField2.style.display = 'none';
                modalField3.style.display = 'none';

                if (type === 'add-student' || type === 'edit-student') {
                    modalTitle.textContent = type === 'add-student' ? 'Thêm sinh viên' : 'Chỉnh sửa sinh viên';
                    modalLabel1.textContent = 'Tên sinh viên';
                    modalInput1.value = '';
                    modalInput1.name = 'name';
                } else if (type === 'add-item' || type === 'edit-item') {
                    modalTitle.textContent = type === 'add-item' ? 'Thêm đồ dùng' : 'Chỉnh sửa đồ dùng';
                    modalLabel1.textContent = 'Tên đồ dùng';
                    modalInput1.value = '';
                    modalInput1.name = 'name';
                    modalField2.style.display = 'block';
                    modalLabel2.textContent = 'Trạng thái';
                    modalSelect.name = 'status';
                } else if (type === 'add-report' || type === 'edit-report') {
                    modalTitle.textContent = type === 'add-report' ? 'Thêm báo cáo' : 'Cập nhật báo cáo';
                    modalLabel1.textContent = 'Mô tả';
                    modalInput1.value = '';
                    modalInput1.name = 'description';
                    modalField3.style.display = 'block';
                    modalLabel3.textContent = 'Trạng thái';
                    modalSelect2.name = 'status';
                }

                if (id) {
                    // Giả lập lấy dữ liệu từ server
                    const data = { name: 'Tên mẫu', status: 'Tốt' }; // Dữ liệu giả lập
                    modalInput1.value = data.name;
                    if (modalSelect) modalSelect.value = data.status;
                    if (modalSelect2) modalSelect2.value = data.status;
                }

                document.getElementById('modal-form').onsubmit = function(e) {
                    e.preventDefault();
                    console.log({
                        type: type,
                        id: id,
                        data: {
                            [modalInput1.name]: modalInput1.value,
                            ...(modalSelect && { status: modalSelect.value }),
                            ...(modalSelect2 && { status: modalSelect2.value })
                        }
                    });
                    hideModal();
                };
            }

            function hideModal() {
                document.getElementById('modal').style.display = 'none';
            }
        </script>
    </div>
@endsection