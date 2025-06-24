<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý KTX</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Thêm dòng này -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="d-flex flex-column min-vh-100">
        <!-- Header -->
        <header class="bg-white shadow-sm">
            <div class="container py-3">
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <div class="d-flex align-items-center">
                        <a href="{{ route('home') }}" class="d-flex align-items-center text-decoration-none">
                            <img src="/Logo_PTIT_University.png" alt="PTIT Ký Túc Xá" style="width: 40px; height: 40px;">
                            <span class="ms-2 fs-4 fw-bold text-danger">PTIT Ký Túc Xá</span>
                        </a>
                    </div>
                    <nav class="d-none d-md-flex align-items-center gap-3">
                        <a href="{{ route('home') }}" class="text-dark text-decoration-none">Trang chủ</a>
                        <a href="#" class="text-dark text-decoration-none">Phần mềm quản lý</a>
                        <a href="#" class="text-dark text-decoration-none">APP sinh viên</a>
                        <a href="#" class="text-dark text-decoration-none">Lợi ích</a>
                        <div class="dropdown">
                            <button class="btn text-dark dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Dịch vụ
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Bán phòng ký túc xá</a></li>
                                <li><a class="dropdown-item" href="#">Thiết bị quản lý</a></li>
                                <li><a class="dropdown-item" href="#">Marketing</a></li>
                            </ul>
                        </div>
                        <div class="dropdown">
                            <button class="btn text-dark dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Thêm
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Cổng thông tin</a></li>
                                <li><a class="dropdown-item" href="#">Tuyển dụng</a></li>
                                <li><a class="dropdown-item" href="#">Hướng dẫn</a></li>
                                <li><a class="dropdown-item" href="#">Liên hệ</a></li>
                            </ul>
                        </div>
                    </nav>
                    <div class="d-flex align-items-center gap-3">
                        <a href="tel:0123456789" class="btn btn-primary"><i class="fas fa-phone-alt me-2"></i>0123.456.789</a>
                        @if (Auth::check())
                            <div class="d-flex align-items-center gap-2">
                                <span class="text-dark">{{ Auth::user()->name }}</span>
                                <div class="dropdown">
                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; cursor: pointer;" data-bs-toggle="dropdown">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="{{ route('user.detail') }}">Thông tin cá nhân</a></li>
                                        <li><a class="dropdown-item" href="#">Đổi mật khẩu</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="dropdown-item text-danger">Đăng xuất</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="text-dark text-decoration-none">Đăng nhập</a>
                            <a href="{{ route('register') }}" class="btn btn-primary">Đăng ký</a>
                        @endif
                    </div>
                </div>
            </div>
        </header>

        <!-- Content -->
        <main class="flex-grow-1">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin: 20px;">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="py-5" style="background-color: rgb(247,250,252); background-image: url('https://quanlytro.me/images/backgrounds/network.webp'); background-size: cover; background-position: center;">
            <div class="container py-5">
                <div class="mb-5 p-4 bg-white rounded" style="background-image: url('https://quanlytro.me/images/backgrounds/container-footer.webp'); background-repeat: no-repeat; background-position: right bottom;">
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="d-flex align-items-center mb-4">
                                <img src="/Logo_PTIT_University.png" alt="Logo" class="img-fluid me-2" style="width: 50px; height: 50px;">
                                <h1 class="h3 fw-bold text-dark ms-2">PTIT Ký túc xá</h1>
                            </div>
                            <p class="text-muted">Phần mềm quản lý ký túc xá chuyên nghiệp với nhiều tính năng hỗ trợ sinh viên quản lý và thanh toán cho ký túc xá của mình.</p>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="row">
                                <div class="col-6">
                                    <h3 class="fw-bold text-dark mb-3">Về chúng tôi</h3>
                                    <ul class="list-unstyled text-muted">
                                        <li><a href="#" class="text-decoration-none text-dark">Giới thiệu</a></li>
                                        <li><a href="#" class="text-decoration-none text-dark">Tính năng</a></li>
                                        <li><a href="#" class="text-decoration-none text-dark">Bảng giá</a></li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <h3 class="fw-bold text-dark mb-3">Hỗ trợ</h3>
                                    <ul class="list-unstyled text-muted">
                                        <li><a href="#" class="text-decoration-none text-dark">Hướng dẫn</a></li>
                                        <li><a href="#" class="text-decoration-none text-dark">Câu hỏi</a></li>
                                        <li><a href="#" class="text-decoration-none text-dark">Liên hệ</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="mb-3">
                                <h3 class="fw-bold text-dark">Tải ứng dụng</h3>
                                <div class="d-flex flex-column">
                                    <a href="#" class="btn btn-dark mb-2 d-flex align-items-center justify-content-center" style="width: 150px;">
                                        <i class="fab fa-apple me-2"></i> App Store
                                    </a>
                                    <a href="#" class="btn btn-dark d-flex align-items-center justify-content-center" style="width: 150px;">
                                        <i class="fab fa-google-play me-2"></i> Google Play
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h3 class="fw-bold text-dark">Liên hệ</h3>
                            <div class="text-muted">
                                <p><i class="fas fa-phone-alt me-2 text-dark"></i> 0123 456 789</p>
                                <p><i class="fas fa-envelope me-2 text-dark"></i> <a href="mailto:example@domain.com" class="text-decoration-none text-dark">example@domain.com</a></p>
                                <p><i class="fas fa-clock me-2 text-dark"></i> 8:00 - 17:00 (Thứ 2 - Thứ 6)</p>
                                <p><i class="fas fa-map-marker-alt me-2 text-dark"></i> 96A Đ. Trần Phú, P. Mộ Lao, Hà Đông, Hà Nội</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <h3 class="fw-bold text-dark mb-3 text-center">Kết nối cộng đồng</h3>
                            <div class="d-flex flex-wrap justify-content-center gap-3">
                                <a href="#" class="btn btn-outline-primary d-flex align-items-center justify-content-center" style="width: 120px;">
                                    <i class="fab fa-zalo me-2"></i> Zalo
                                </a>
                                <a href="#" class="btn btn-outline-primary d-flex align-items-center justify-content-center" style="width: 120px;">
                                    <i class="fab fa-facebook-f me-2"></i> Facebook
                                </a>
                                <a href="#" class="btn btn-outline-danger d-flex align-items-center justify-content-center" style="width: 120px;">
                                    <i class="fab fa-youtube me-2"></i> YouTube
                                </a>
                                <a href="#" class="btn btn-outline-dark d-flex align-items-center justify-content-center" style="width: 120px;">
                                    <i class="fab fa-tiktok me-2"></i> TikTok
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-top pt-4 mt-5 mb-5">
                    <div class="d-flex justify-content-between align-items-center flex-column flex-md-row">
                        <div class="text-center text-muted mb-2 mb-md-0">
                            <p class="mb-0 fw-bold">Copyright © 2020 Học viện Công nghệ Bưu chính Viễn thông</p>
                        </div>
                        <div class="text-muted text-md-end">
                            <p class="mb-0">Design by Le Tien Dat</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init();</script>
</body>
</html>