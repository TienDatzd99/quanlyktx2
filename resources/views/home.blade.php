@extends('layouts.app')

@section('content')
    <div data-aos="fade-up">
        <!-- Banner Section -->
        <section class="bg-light text-dark py-5" style="background-image: url('https://quanlytro.me/images/backgrounds/bg-banner.webp'); background-size: cover; background-position: center;">
            <div class="container py-5">
                <div class="row align-items-center">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <h1 class="display-4 fs-1 fw-bold mb-4">
                            <span class="text-success">Đăng ký vào ở ký túc xá ngay</span><br /> Điện thoại - iPad - Máy tính 🎉
                        </h1>
                        <p class="fs-4 mb-4">
                            Ký túc xá của chúng tôi cung cấp môi trường sống an toàn, tiện nghi với mức giá sinh viên, thuận tiện cho việc di chuyển đến trường. Cơ sở vật chất hiện đại, không gian xanh mát tạo môi trường sống lý tưởng.
                        </p>
                        <div class="d-flex flex-column flex-sm-row gap-3">
                            <a href="#" class="btn btn-primary btn-lg">Đăng ký hồ sơ xét duyệt</a>
                            <a href="#" class="btn btn-outline-dark btn-lg rounded-pill">Tư vấn dịch vụ</a>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <img src="/truong.jpg" alt="App Dormido" class="img-fluid rounded shadow" style="max-width: 100%; height: auto;">
                    </div>
                </div>
            </div>
        </section>

        <!-- Bank Carousel Section -->
        <section class="py-5 bg-white">
            <div class="container py-5">
                <div class="text-center mb-4">
                    <h1 class="fw-bold text-dark mb-2">Hỗ trợ thanh toán qua nhiều ngân hàng</h1>
                    <p class="text-success mb-4">Miễn phí giao dịch</p>
                </div>
                <div id="bankCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#bankCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#bankCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row row-cols-4 g-5">
                                @foreach (['Vietcombank', 'Techcombank', 'TPBank', 'ACB'] as $bank)
                                    <div class="col">
                                        <div class="card shadow-sm d-flex align-items-center justify-content-center p-3">
                                            <img src="https://logo.clearbit.com/{{ strtolower($bank) }}.com.vn" alt="{{ $bank }} logo" class="img-fluid" style="height: 150px;">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row row-cols-4 g-5">
                                @foreach (['Agribank', 'BIDV', 'MBBank', 'VPBank'] as $bank)
                                    <div class="col">
                                        <div class="card shadow-sm d-flex align-items-center justify-content-center p-3">
                                            <img src="https://logo.clearbit.com/{{ strtolower($bank) }}.com.vn" alt="{{ $bank }} logo" class="img-fluid" style="height: 150px;">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#bankCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#bankCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </section>

        <!-- Register Section -->
        <section class="py-5 text-dark">
            <div class="container py-5 text-center">
                <h2 class="display-5 fw-bold mb-4">Đăng ký ngay bây giờ</h2>
                <p class="fs-4 mb-5">Nhận tư vấn về thông tin chi tiết về việc đăng ký ký túc xá</p>
                <div class="card mx-auto shadow" style="max-width: 500px;">
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('register.application') }}">
                            @csrf
                            <div class="mb-3">
                                <input type="text" name="name" class="form-control form-control-lg" placeholder="Họ và tên" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input type="tel" name="phone" class="form-control form-control-lg" placeholder="Số điện thoại" value="{{ old('phone') }}" required>
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg w-100">Đăng ký ngay</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection