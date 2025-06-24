<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Đăng ký - Quản lý KTX</title>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(135deg, #007bff, #00c6ff);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .signup-container {
      background: #ffffff;
      padding: 40px 32px;
      border-radius: 16px;
      max-width: 420px;
      width: 100%;
      box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
      animation: slideFade 0.4s ease;
    }

    @keyframes slideFade {
      from {
        transform: translateY(30px);
        opacity: 0;
      }
      to {
        transform: translateY(0);
        opacity: 1;
      }
    }

    .signup-container h2 {
      text-align: center;
      color: #007bff;
      font-size: 28px;
      margin-bottom: 24px;
    }

    .signup-form input,
    .signup-form select {
      width: 100%;
      padding: 12px 14px;
      margin-bottom: 14px;
      border: 1px solid #ced4da;
      border-radius: 8px;
      font-size: 15px;
      transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .signup-form input:focus,
    .signup-form select:focus {
      border-color: #007bff;
      box-shadow: 0 0 6px rgba(0, 123, 255, 0.2);
      outline: none;
    }

    .signup-form button {
      width: 100%;
      padding: 12px;
      background: linear-gradient(90deg, #007bff, #00c6ff);
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      font-weight: 500;
      transition: all 0.3s ease;
    }

    .signup-form button:hover {
      background: linear-gradient(90deg, #0056b3, #0096cc);
      transform: translateY(-2px);
    }

    .signup-container p {
      text-align: center;
      margin-top: 16px;
      font-size: 14px;
    }

    .signup-container a {
      color: #007bff;
      text-decoration: none;
      font-weight: 500;
    }

    .signup-container a:hover {
      text-decoration: underline;
    }

    .error, .success {
      font-size: 14px;
      padding: 10px;
      margin-bottom: 16px;
      border-radius: 8px;
      text-align: center;
    }

    .error {
      color: #721c24;
      background-color: #f8d7da;
      border: 1px solid #f5c6cb;
    }

    .success {
      color: #155724;
      background-color: #d4edda;
      border: 1px solid #c3e6cb;
    }
  </style>
</head>
<body>
  <div class="signup-container">
    <h2>Đăng ký tài khoản</h2>

    @if ($errors->any())
      <div class="error" id="error-msg">{{ $errors->first() }}</div>
    @endif

    @if (session('success'))
      <div class="success" id="success-msg">{{ session('success') }}</div>
    @endif

    <form class="signup-form" method="POST" action="{{ route('register') }}" onsubmit="return validateForm()">
      @csrf
      <input type="text" name="name" value="{{ old('name') }}" placeholder="Họ và tên" required />
      <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" required />
      <input type="password" name="password" id="password" placeholder="Mật khẩu" required />
      <input type="password" name="password_confirm" id="confirmPassword" placeholder="Xác nhận mật khẩu" required />

      <select name="role" required>
        <option value="" disabled selected>Chọn vai trò</option>
        <option value="student" {{ old('role') === 'student' ? 'selected' : '' }}>Sinh viên</option>
        <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Quản trị viên</option>
      </select>

      <input type="text" name="room_id" value="{{ old('room_id') }}" placeholder="Room ID (tùy chọn)" />
      <button type="submit">Đăng ký</button>
    </form>

    <p>Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a></p>
  </div>

  <script>
    function validateForm() {
      const password = document.getElementById("password").value;
      const confirmPassword = document.getElementById("confirmPassword").value;
      const errorMsg = document.getElementById("error-msg");
      const successMsg = document.getElementById("success-msg");

      if (errorMsg) errorMsg.style.display = "none";
      if (successMsg) successMsg.style.display = "none";

      if (password !== confirmPassword) {
        if (errorMsg) {
          errorMsg.textContent = "Mật khẩu không khớp!";
          errorMsg.style.display = "block";
        }
        return false;
      }
      return true;
    }
  </script>
</body>
</html>
