@extends('home')

@section('content')
    <style>
        .user-detail-container {
            padding: 24px;
            max-width: 950px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .user-detail-container:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 35px rgba(0, 0, 0, 0.12);
        }

        .ant-typography {
            color: #2c3e50;
            font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        .ant-card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            background: #fff;
            margin-bottom: 32px;
            transition: all 0.3s ease;
        }

        .ant-card:hover {
            background: #f9f9f9;
        }

        .ant-card-head {
            background: linear-gradient(90deg, #007bff, #00c6ff);
            color: #fff;
            padding: 15px 20px;
            font-size: 18px;
            font-weight: 600;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .ant-card-body {
            padding: 20px;
        }

        .ant-divider,
        .divider-title {
            margin: 30px 0 20px;
            border-bottom: 2px solid #dee2e6;
            padding-bottom: 6px;
            color: #495057;
            font-weight: 600;
            font-size: 16px;
        }

        .info-item {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            background: #f8f9fa;
            padding: 8px 12px;
            border-radius: 6px;
            transition: background 0.3s ease;
        }

        .info-item:hover {
            background: #e9ecef;
        }

        .ant-typography-strong {
            color: #34495e;
            font-weight: 500;
            min-width: 130px;
            margin-right: 15px;
        }

        .ant-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6f42c1, #007bff);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            color: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .ant-avatar:hover {
            transform: scale(1.1);
        }

        .ant-row {
            justify-content: space-between;
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 12px;
        }

        .ant-col-6 {
            width: 25%;
            font-weight: 500;
            color: #555;
        }

        .ant-col-18 {
            width: 75%;
        }

        .ant-tag {
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
            margin-left: 8px;
        }

        .ant-tag-blue {
            background: #17a2b8;
            color: #fff;
        }

        .ant-tag-green {
            background: #28a745;
            color: #fff;
        }

        .ant-tag-red {
            background: #dc3545;
            color: #fff;
        }

        .ant-list {
            list-style: none;
            padding-left: 0;
        }

        .ant-list-item {
            display: flex;
            align-items: flex-start;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .ant-list-item:hover {
            background: #f1f3f5;
            transform: translateX(5px);
        }

        .ant-list-item-meta {
            display: flex;
            align-items: center;
            width: 100%;
        }

        .ant-list-item-meta-avatar {
            margin-right: 12px;
        }

        .ant-list-item-meta-content {
            flex: 1;
        }

        .ant-list-item-meta-title {
            margin: 0;
            color: #2c3e50;
            font-weight: 500;
        }

        .ant-list-item-meta-description {
            color: #7f8c8d;
            font-size: 14px;
        }

        .payment-btn {
            background: linear-gradient(90deg, #28a745, #218838);
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .payment-btn:hover {
            background: linear-gradient(90deg, #218838, #1e7e34);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 1000;
            animation: fadeIn 0.4s ease;
        }

        .modal-content {
            background: #fff;
            margin: 8% auto;
            padding: 24px;
            border-radius: 15px;
            width: 90%;
            max-width: 520px;
            position: relative;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            animation: slideUp 0.4s ease;
        }

        .close {
            position: absolute;
            top: 12px;
            right: 20px;
            font-size: 28px;
            cursor: pointer;
            color: #7f8c8d;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .close:hover {
            color: #dc3545;
            transform: rotate(90deg);
        }

        .ant-form-item {
            margin-bottom: 18px;
        }

        .ant-form-item-label {
            font-weight: 500;
            margin-bottom: 8px;
            display: block;
            color: #34495e;
        }

        .ant-input,
        .ant-textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ced4da;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .ant-input:focus,
        .ant-textarea:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
            outline: none;
        }

        .ant-btn {
            margin-right: 10px;
            border-radius: 8px;
            padding: 10px 20px;
            transition: all 0.3s ease, transform 0.2s ease;
            cursor: pointer;
            border: none;
        }

        .ant-btn-primary {
            background: linear-gradient(90deg, #007bff, #00c6ff);
            color: #fff;
        }

        .ant-btn-primary:hover {
            background: linear-gradient(90deg, #0056b3, #00a3cc);
            transform: translateY(-2px);
        }

        .ant-btn-link {
            color: #dc3545;
            background: none;
        }

        .ant-btn-link:hover {
            color: #c82333;
            text-decoration: none;
        }

        .ant-card-small .ant-card-head {
            padding: 10px;
            font-size: 14px;
            background: #e9ecef;
            color: #2c3e50;
            border-bottom: 1px solid #dee2e6;
        }

        .ant-card-small .ant-card-body {
            padding: 10px;
            font-size: 13px;
        }

        .ant-empty {
            text-align: center;
            padding: 40px;
            color: #7f8c8d;
            background: #f8f9fa;
            border-radius: 8px;
            border: 1px dashed #e9ecef;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                transform: translateY(30px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .user-detail-container {
                padding: 16px;
            }

            .ant-col-6,
            .ant-col-18 {
                width: 100%;
            }

            .ant-row {
                flex-direction: column;
            }

            .modal-content {
                margin-top: 20%;
                width: 95%;
            }

            .ant-card {
                margin-bottom: 24px;
            }

            .ant-btn {
                width: 100%;
                margin-bottom: 8px;
            }
        }
    </style>

    <div class="user-detail-container">
        <h2 class="ant-typography" style="margin-bottom: 20px;">Thông tin cá nhân</h2>
        
        <div class="ant-card">
            <div style="display: flex; margin-bottom: 20px;">
                <div class="ant-avatar ant-avatar-circle" style="margin-right: 20px;">
                    <span class="anticon anticon-user" style="font-size: 32px; color: #fff;"></span>
                </div>
                <div>
                    <h3 class="ant-typography" style="margin: 0;">{{ $user->name }}</h3>
                    <span class="ant-typography-secondary">Sinh viên</span>
                </div>
            </div>
            
            <div class="ant-divider"></div>
            
            <div class="ant-row" style="margin-bottom: 12px;">
                <div class="ant-col ant-col-6"><span class="ant-typography-strong">ID:</span></div>
                <div class="ant-col ant-col-18">{{ $user->id }}</div>
            </div>
            
            <div class="ant-row" style="margin-bottom: 12px;">
                <div class="ant-col ant-col-6"><span class="ant-typography-strong">Email:</span></div>
                <div class="ant-col ant-col-18">{{ $user->email }}</div>
            </div>
            
            @if($user->room_id)
                <div class="ant-row" style="margin-bottom: 12px;">
                    <div class="ant-col ant-col-6">
                        <span class="ant-typography-strong">
                           Phòng:
                        </span>
                    </div>
                    <div class="ant-col ant-col-18">{{ $roomDetails->room_number ?? $user->room_id }}</div>
                </div>
            @endif
            
            @if($user->created_at)
                <div class="ant-row" style="margin-bottom: 12px;">
                    <div class="ant-col ant-col-6"><span class="ant-typography-strong">Ngày đăng ký:</span></div>
                    <div class="ant-col ant-col-18">{{ $user->created_at->format('d/m/Y') }}</div>
                </div>
            @endif
            
            @if($user->phone)
                <div class="ant-row" style="margin-bottom: 12px;">
                    <div class="ant-col ant-col-6"><span class="ant-typography-strong">Số điện thoại:</span></div>
                    <div class="ant-col ant-col-18">{{ $user->phone }}</div>
                </div>
            @endif
            
            @if($user->address)
                <div class="ant-row" style="margin-bottom: 12px;">
                    <div class="ant-col ant-col-6"><span class="ant-typography-strong">Địa chỉ:</span></div>
                    <div class="ant-col ant-col-18">{{ $user->address }}</div>
                </div>
            @endif
        </div>
        
        @if($user->room_id)
            <div class="ant-card" style="margin-top: 24px;">
                <div class="ant-card-head">
                    <span>
                        <span class="anticon anticon-home" style="margin-right: 8px;"></span>
                        Chi tiết phòng đang ở
                    </span>
                </div>
                <div class="ant-card-body">
                    @if($roomDetails)
                        <div class="ant-row" style="margin-bottom: 12px;">
                            <div class="ant-col ant-col-6"><span class="ant-typography-strong">Số phòng:</span></div>
                            <div class="ant-col ant-col-18">{{ $roomDetails->room_number }}</div>
                        </div>
                        
                        <div class="ant-row" style="margin-bottom: 12px;">
                            <div class="ant-col ant-col-6"><span class="ant-typography-strong">Loại phòng:</span></div>
                            <div class="ant-col ant-col-18">{{ $roomDetails->type ?? 'Tiêu chuẩn' }}</div>
                        </div>
                        
                        <div class="ant-row" style="margin-bottom: 12px;">
                            <div class="ant-col ant-col-6"><span class="ant-typography-strong">Sức chứa:</span></div>
                            <div class="ant-col ant-col-18">{{ $roomDetails->capacity }} người</div>
                        </div>
                        
                        <!-- Nút Thanh toán tiền KTX -->
                        @if(!$user->payments()->exists())
                            <div style="margin-top: 15px;">
                                <button class="payment-btn" onclick="showPaymentModal()">Thanh toán tiền KTX</button>
                            </div>
                        @endif
                        
                        <div class="ant-divider" orientation="left">
                            <span class="anticon anticon-appstore" style="margin-right: 8px;"></span> Trang thiết bị phòng
                        </div>
                        
                        @if($roomItems && count($roomItems) > 0)
                            <div class="ant-row" style="margin-bottom: 16px;" gutter="[16, 16]">
                                @foreach($roomItems as $item)
                                    <div class="ant-col ant-col-12">
                                        <div class="ant-card ant-card-small" style="margin-bottom: 16px;">
                                            <div class="ant-card-head">
                                                <span>{{ $item->name }}</span>
                                                <span class="ant-tag {{ $item->status === 'active' ? 'ant-tag-green' : 'ant-tag-red' }}">
                                                    {{ $item->status === 'active' ? 'Hoạt động' : 'Đã hỏng' }}
                                                </span>
                                            </div>
                                            <div class="ant-card-body">
                                                <p>ID: {{ $item->id }}</p>
                                                @if($item->description)
                                                    <p>{{ $item->description }}</p>
                                                @endif
                                                @if($item->status === 'active')
                                                    <a href="#" class="ant-btn ant-btn-link ant-btn-danger" onclick="showReportModal({{ $item->id }}, '{{ addslashes($item->name) }}')">
                                                        <span class="anticon anticon-warning"></span> Báo hỏng
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="ant-empty">Không có vật dụng nào trong phòng</div>
                        @endif
                        
                        <div class="ant-divider" orientation="left">
                            <span class="anticon anticon-team" style="margin-right: 8px;"></span> Sinh viên cùng phòng
                        </div>
                        
                        @if($roomDetails->users && count($roomDetails->users) > 0)
                            <ul class="ant-list">
                                @foreach($roomDetails->users as $roomUser)
                                    <li class="ant-list-item">
                                        <div class="ant-list-item-meta">
                                            <div class="ant-list-item-meta-avatar">
                                                <span class="ant-avatar ant-avatar-circle">
                                                    <span class="anticon anticon-user"></span>
                                                </span>
                                            </div>
                                            <div class="ant-list-item-meta-content">
                                                <h4 class="ant-list-item-meta-title">
                                                    {{ $roomUser->name }}
                                                    @if($roomUser->id === $user->id)
                                                        <span class="ant-tag ant-tag-blue" style="margin-left: 8px;">Bạn</span>
                                                    @endif
                                                </h4>
                                                <div class="ant-list-item-meta-description">{{ $roomUser->email }}</div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="ant-empty">Không có sinh viên nào trong phòng</div>
                        @endif
                    @else
                        <div class="ant-empty">Không có thông tin chi tiết về phòng</div>
                    @endif
                </div>
            </div>
        @endif

        <!-- Modal báo cáo vật dụng hỏng -->
        <div id="report-modal" class="modal" style="display: none;">
            <div class="modal-content">
                <span class="close" onclick="hideReportModal()">×</span>
                <h3 id="report-modal-title">Báo cáo vật dụng hỏng</h3>
                <form id="report-form">
                    <input type="hidden" id="report-item-id">
                    <div class="ant-form-item">
                        <label class="ant-form-item-label">Vật dụng</label>
                        <input type="text" id="report-item-name" class="ant-input" disabled>
                    </div>
                    <div class="ant-form-item">
                        <label class="ant-form-item-label">Mô tả vấn đề</label>
                        <textarea id="report-description" class="ant-textarea" rows="4" placeholder="Mô tả chi tiết vấn đề của vật dụng..." required></textarea>
                    </div>
                    <div class="ant-form-item" style="text-align: right; margin-bottom: 0;">
                        <button type="button" class="ant-btn" onclick="hideReportModal()">Hủy</button>
                        <button type="submit" class="ant-btn ant-btn-primary">Xác nhận</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal thanh toán -->
        <div id="payment-modal" class="modal" style="display: none;">
            <div class="modal-content">
                <span class="close" onclick="hidePaymentModal()">×</span>
                <h3>Chi tiết thanh toán</h3>
                <div class="ant-form-item">
                    <label class="ant-form-item-label">Số tiền:</label>
                    <p id="payment-amount">1,000,000 VND</p>
                </div>
                <div class="ant-form-item">
                    <label class="ant-form-item-label">Kỳ hạn:</label>
                    <p id="payment-period">Tháng 6/2025</p>
                </div>
                <div class="ant-form-item">
                    <label class="ant-form-item-label">Trạng thái:</label>
                    <p id="payment-status" style="color: #dc3545;">Chưa thanh toán</p>
                </div>
                <div class="ant-form-item" style="text-align: right; margin-bottom: 0;">
                    <button type="button" class="ant-btn" onclick="hidePaymentModal()">Đóng</button>
                    <button type="button" class="ant-btn ant-btn-primary" onclick="confirmPayment()">Thanh toán</button>
                </div>
            </div>
        </div>

        <script>
    function showReportModal(itemId, itemName) {
        const modal = document.getElementById('report-modal');
        const modalTitle = document.getElementById('report-modal-title');
        const itemIdInput = document.getElementById('report-item-id');
        const itemNameInput = document.getElementById('report-item-name');
        const descriptionInput = document.getElementById('report-description');

        modal.style.display = 'block';
        modalTitle.textContent = 'Báo cáo vật dụng hỏng: ' + itemName;
        itemIdInput.value = itemId;
        itemNameInput.value = itemName;
        descriptionInput.value = '';
    }

    function hideReportModal() {
        document.getElementById('report-modal').style.display = 'none';
    }

    document.getElementById('report-form').onsubmit = function(e) {
        e.preventDefault();
        const itemId = document.getElementById('report-item-id').value;
        const description = document.getElementById('report-description').value;

        fetch('/item/report', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                item_id: itemId,
                description: description
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            alert(data.message || 'Báo cáo thành công!');
            hideReportModal();
            location.reload(); // Làm mới trang để cập nhật trạng thái
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Lỗi khi báo cáo: ' + error.message);
        });
    };

    function showPaymentModal() {
        const modal = document.getElementById('payment-modal');
        modal.style.display = 'block';
    }

    function hidePaymentModal() {
        document.getElementById('payment-modal').style.display = 'none';
    }

    function confirmPayment() {
        fetch('/payment', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                user_id: {{ $user->id }},
                room_id: {{ $user->room_id }},
                amount: 1000000.00,
                type: 'monthly',
                status: 'paid',
                payment_date: new Date().toISOString().split('T')[0]
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            alert(data.message || 'Thanh toán thành công!');
            hidePaymentModal();
            location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Lỗi khi thanh toán: ' + error.message);
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        const paymentBtn = document.querySelector('.payment-btn');
        if (paymentBtn) {
            paymentBtn.addEventListener('click', showPaymentModal);
        }
    });
</script>
    </div>
@endsection