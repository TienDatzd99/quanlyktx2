<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý KTX - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/antd/4.24.7/antd.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <style>
        .ant-layout-header {
            background: #001529;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            height: 64px;
        }

        .logo {
            color: white;
            font-size: 20px;
            font-weight: bold;
        }

        .top-menu {
            display: flex;
            gap: 20px;
        }

        .top-menu a, .top-menu button {
            color: white;
            text-decoration: none;
        }

        .ant-menu-sub {
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .ant-menu-sub.open {
            padding-left: 16px;
        }

        .ant-menu-item-selected {
            background-color: #e6f7ff;
        }
        .ant-layout-sider {
    width: 240px;
    background-color: #001529;
    color: #fff;
    display: flex;
    flex-direction: column;
    padding-top: 20px;
}

/* Header */
.sider-header {
    font-size: 20px;
    font-weight: bold;
    color: white;
    text-align: center;
    margin-bottom: 16px;
}

/* Nhóm menu */
.sider-section-title {
    padding: 8px 24px;
    font-size: 12px;
    text-transform: uppercase;
    color: #8c8c8c;
    letter-spacing: 0.5px;
}

/* Link từng mục */
.sider-link {
    display: flex;
    align-items: center;
    padding: 10px 24px;
    color: #d9d9d9;
    text-decoration: none;
    font-size: 14px;
    transition: all 0.3s ease;
    border-left: 3px solid transparent;
}

.sider-link i {
    margin-right: 10px;
}

/* Hover và active */
.sider-link:hover {
    background-color: #1890ff;
    color: #fff;
}

.sider-link.active {
    background-color: #1890ff;
    color: #fff;
    border-left: 3px solid #40a9ff;
    font-weight: 600;
}

/* Footer */
.sider-footer {
    margin-top: auto;
    padding: 16px;
    text-align: center;
    font-size: 12px;
    color: #8c8c8c;
}
    </style>
</head>
<body>
<div class="ant-layout" style="min-height: 100vh; display: flex; flex-direction: column;">
    <!-- Header -->
    <div class="ant-layout-header">
        <div class="logo">KTX Management</div>
        <div class="top-menu">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('students.index') }}">Quản lý</a>
            <a href="{{ route('notifications.create') }}">Thông báo</a>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="ant-btn ant-btn-link">Đăng xuất</button>
            </form>
        </div>
    </div>

    <!-- Main layout -->
    <div class="ant-layout" style="display: flex; flex: 1; flex-direction: row;">
        <!-- Sidebar -->
<aside class="ant-layout-sider">
  
  <nav class="sider-menu">
    <div class="sider-section-title">Sinh viên</div>
    <a href="{{ route('students.index') }}" class="sider-link {{ Request::is('students*') ? 'active' : '' }}">
      <i class="anticon anticon-user"></i> Danh sách sinh viên
    </a>
    <a href="#" class="sider-link"><i class="anticon anticon-file-protect"></i> Xử lý yêu cầu</a>
    <a href="#" class="sider-link"><i class="anticon anticon-pie-chart"></i> Thống kê</a>

    <div class="sider-section-title">Phòng</div>
    <a href="{{ route('rooms.index') }}" class="sider-link {{ Request::is('rooms*') ? 'active' : '' }}">
      <i class="anticon anticon-home"></i> Danh sách phòng
    </a>
    <a href="#" class="sider-link"><i class="anticon anticon-deployment-unit"></i> Phân phòng</a>
    <a href="#" class="sider-link"><i class="anticon anticon-tool"></i> Bảo trì</a>

    <div class="sider-section-title">Thông báo</div>
    <a href="{{ route('notifications.create') }}" class="sider-link {{ Request::is('notifications*') ? 'active' : '' }}">
      <i class="anticon anticon-notification"></i> Gửi thông báo
    </a>
    <a href="#" class="sider-link"><i class="anticon anticon-history"></i> Lịch sử thông báo</a>
  </nav>
  <div class="sider-footer">
    © {{ now()->year }} KTX Admin
  </div>
</aside>
        <!-- Content -->
        <div class="ant-layout-content" style="padding: 24px; flex: 1; overflow-y: auto; background: #f0f2f5;">
            <div class="ant-breadcrumb" style="margin: 16px 0;">
                <span><a href="{{ route('home') }}">Trang chủ</a></span> /
                <span>Quản lý</span> /
                <span>{{ Request::is('students*') ? 'Sinh viên' : 'Thông báo' }}</span>
            </div>
            <div style="padding: 24px; background: #fff; min-height: 280px; border-radius: 4px;">
                @if (session('success'))
                    <div class="ant-message-success" style="margin-bottom: 20px;">
                        {{ session('success') }}
                    </div>
                @endif
                @yield('content')
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const menuItems = document.querySelectorAll('.ant-menu-item[data-menu]');
        const submenus = document.querySelectorAll('.ant-menu-sub');

        menuItems.forEach(item => {
            item.addEventListener('click', (e) => {
                e.preventDefault();
                const submenuId = item.getAttribute('data-menu');
                const submenu = document.getElementById(submenuId);

                submenus.forEach(sub => {
                    if (sub !== submenu) {
                        sub.classList.remove('open');
                        sub.style.maxHeight = '0';
                    }
                });

                if (submenu) {
                    const isOpen = submenu.classList.contains('open');
                    if (isOpen) {
                        submenu.classList.remove('open');
                        submenu.style.maxHeight = '0';
                    } else {
                        submenu.classList.add('open');
                        submenu.style.maxHeight = submenu.scrollHeight + 'px';
                    }
                }
            });
        });

        const path = window.location.pathname;
        if (path.includes('students')) toggleOpen('sub1');
        else if (path.includes('rooms')) toggleOpen('sub2');
        else if (path.includes('notifications')) toggleOpen('sub3');

        function toggleOpen(id) {
            const submenu = document.getElementById(id);
            if (submenu) {
                submenu.classList.add('open');
                submenu.style.maxHeight = submenu.scrollHeight + 'px';
            }
        }
    });
</script>
</body>
</html>
