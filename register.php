<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng ký</title>
  <link rel="stylesheet" href="./public/css/signup.css">
</head>

<body>
  <div class="container">
    <div class="sign-box">
      <div class="box_title">
        <h2>Tạo Tài Khoản</h2>
        <p>Vui lòng điền đầy đủ thông tin để tạo tài khoản mới và bắt đầu trải nghiệm các tính năng của chúng tôi.</p>
      </div>



      <form>
        <div class="form-grid">
          <div>
            <label for="full_name">Tên tài khoản</label>
            <input type="text" id="full_name" placeholder="John" required />
          </div>
          <div>
            <label for="user_name">Tên đăng nhập</label>
            <input type="text" id="user_name" placeholder="Doe" required />
          </div>
          <div>
            <label for="address">Địa chỉ</label>
            <input type="text" id="address" placeholder="Flowbite" required />
          </div>
          <div>
            <label for="phone">Số điện thoại</label>
            <input type="tel" id="phone" placeholder="123-45-678" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" required />
          </div>
        </div>
        <div class="input-wrapper">
          <label for="email">Email</label>
          <input type="email" id="email" placeholder="john.doe@address.com" required />
        </div>
        <div class="input-wrapper">
          <label for="password">Mật khẩu</label>
          <input type="password" id="password" placeholder="•••••••••" required />
        </div>
        <div class="input-wrapper">
          <label for="confirm_password">Nhập lại mật khẩu</label>
          <input type="password" id="confirm_password" placeholder="•••••••••" required />
        </div>
        <button class="btn_submit" type="submit">Đăng ký</button>
      </form>


      <div class="or">or</div>

      <p class="signup">Bạn đã có tài khoản? <a href="login.php">Đăng Nhập</a></p>
    </div>

    <div class="image-box">
      <img src="./public/img/image_sign-up.jpg" alt="Plant">
    </div>
  </div>
</body>

</html>
</body>

</html>