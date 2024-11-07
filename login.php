<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng nhập</title>
  <link rel="stylesheet" href="./public/css/login.css">
</head>

<body>
  <div class="container">
    <div class="login-box">
      <div class="box_title">
        <h2>Đăng Nhập</h2>
        <p>Nhập thông tin đăng nhập của bạn để truy cập tài khoản và bắt đầu trải nghiệm web của chúng tôi</p>
      </div>

      <form action="#" method="POST">
        <div class="box_items">
          <label for="first_name" class="label">Tên dăng nhập</label>
          <input type="text" id="first_name" class="input" placeholder="John" required />
        </div>

        <div class="box_items">
          <label for="first_name" class="label">Mật khẩu</label>
          <input type="text" id="first_name" class="input" placeholder="*******" required />
        </div>

        <div class="options">
          <a href="#">Quên Mật Khẩu?</a>
        </div>

        <button type="submit" class="login-btn">Đăng Nhập</button>
      </form>

      <div class="or">or</div>

      <p class="signup">Bạn chưa có tài khoản? <a href="register.php">Đăng Ký</a></p>
    </div>

    <div class="image-box">
      <img src="./public/img/image_login.webp" alt="Plant">
    </div>
  </div>
</body>

</html>
</body>

</html>