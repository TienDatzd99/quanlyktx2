<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - Quản lý KTX</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/antd/4.24.7/antd.min.css">

    <style>
        /* Reset */
        * {
            box-sizing: border-box;
        }

        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #f0f2f5;
            height: 100vh;
        }

        .login-container {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #007bff 0%, #00c6ff 100%);
            z-index: -1;
            animation: gradientFlow 8s ease infinite;
        }

        @keyframes gradientFlow {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .login-card {
            background: #ffffff;
            padding: 32px 28px;
            border-radius: 16px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
            animation: slideUpFade 0.5s ease;
        }

        @keyframes slideUpFade {
            from {
                transform: translateY(30px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .login-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
        }

        .login-logo img {
            margin-right: 12px;
        }

        .login-title {
            text-align: center;
            font-weight: 600;
            color: #1890ff;
            margin-bottom: 24px;
        }

        .google-login-btn {
            background: #db4437;
            color: white;
            border: none;
            transition: background 0.3s ease;
            margin-bottom: 24px;
        }

        .google-login-btn:hover {
            background: #c23321;
        }

        .login-divider {
            text-align: center;
            margin: 16px 0;
        }

        .ant-form-item-label {
            font-weight: 500;
            color: #495057;
        }

        .ant-input-affix-wrapper {
            padding: 6px 12px;
            border-radius: 8px;
        }

        .ant-input {
            border-radius: 8px;
        }

        .login-form-forgot {
            color: #1890ff;
            font-size: 14px;
            text-decoration: none;
        }

        .login-form-forgot:hover {
            text-decoration: underline;
        }

        .login-button {
            background: linear-gradient(90deg, #007bff, #00c6ff);
            border: none;
            color: white;
            transition: transform 0.3s ease, background 0.3s ease;
        }

        .login-button:hover {
            background: linear-gradient(90deg, #0056b3, #0096cc);
            transform: translateY(-2px);
        }

        .login-footer {
            text-align: center;
            margin-top: 16px;
            font-size: 14px;
        }

        .login-footer a {
            color: #007bff;
            font-weight: 500;
            text-decoration: none;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }

        .ant-message-error, .ant-message-success {
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .login-card {
                padding: 24px 20px;
            }

            .login-logo {
                flex-direction: column;
                text-align: center;
            }

            .login-logo img {
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-background"></div>
        <div class="ant-row ant-row-center ant-row-middle login-row" style="width: 100%;">
            <div class="ant-col ant-col-xs-22 ant-col-sm-20 ant-col-md-16 ant-col-lg-10 ant-col-xl-8">
                <div class="login-logo">
                    <img src="/Logo_PTIT_University.png" alt="Logo KTX" style="width: 50px; height: 50px;">
                    <h2 class="ant-typography">Hệ thống quản lý KTX</h2>
                </div>
                <div class="ant-card login-card">
                    <h2 class="ant-typography login-title">Đăng nhập</h2>
                    <button class="ant-btn ant-btn-block ant-btn-large google-login-btn">
                        <span class="anticon anticon-google"></span> Đăng nhập với Google
                    </button>
                    <div class="ant-divider login-divider">
                        <span class="ant-typography ant-typography-secondary">HOẶC</span>
                    </div>

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

                    <form class="ant-form ant-form-vertical login-form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="ant-form-item">
                            <label class="ant-form-item-label">Email</label>
                            <div class="ant-input-affix-wrapper">
                                <span class="anticon anticon-user"></span>
                                <input
                                    type="email"
                                    name="email"
                                    class="ant-input"
                                    placeholder="Email"
                                    value="{{ old('email') }}"
                                    required
                                />
                            </div>
                            @error('email')
                                <div class="ant-form-item-explain-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="ant-form-item">
                            <label class="ant-form-item-label">Mật khẩu</label>
                            <div class="ant-input-affix-wrapper">
                                <span class="anticon anticon-lock"></span>
                                <input
                                    type="password"
                                    name="password"
                                    class="ant-input"
                                    placeholder="Mật khẩu"
                                    required
                                />
                            </div>
                            @error('password')
                                <div class="ant-form-item-explain-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="ant-form-item">
                            <div class="ant-space ant-space-horizontal ant-space-align-center" style="width: 100%; justify-content: space-between;">
                                <label class="ant-checkbox-wrapper">
                                    <input type="checkbox" name="remember" checked>
                                    <span>Ghi nhớ đăng nhập</span>
                                </label>
                                <a href="#" class="login-form-forgot">Quên mật khẩu?</a>
                            </div>
                        </div>
                        <div class="ant-form-item">
                            <button type="submit" class="ant-btn ant-btn-primary ant-btn-block ant-btn-large login-button">
                                Đăng nhập
                            </button>
                        </div>
                        <div class="login-footer">
                            <span>Chưa có tài khoản? </span>
                            <a href="{{ route('register') }}">Đăng ký ngay</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/antd/4.24.7/antd.min.js"></script>
</body>
</html>
