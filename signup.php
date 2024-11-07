<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signup Page</title>
  <link rel="stylesheet" href="signup.css">
</head>
<body>
  <div class="container">
    <div class="sign-box">
      <h2>Đăng Ký</h2>
      
      <form action="#" method="POST">
        <label for="acccoutname">Tên Tài Khoản </label>
        <input type="text" id="acccoutname" name="acccoutname" placeholder="Enter your acccout name" required>

        <label for="username">Tên Đăng Nhập</label>
        <input type="text" id="username" name="username" placeholder="Enter your user name" required>

        <label for="phonenumber">Số Điện Thoại</label>
        <input type="number" id="phonenumber" name="phonenumber" placeholder="Enter your phone number" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>
        
        <label for="password">Mật Khẩu</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>

        <label for="re-enterpassword">Nhập Lại Mật Khẩu</label>
        <input type="password" id="re-enterpassword" name="re-enterpassword" placeholder="Enter your Re-enter password" required>
        
       
        
        <button type="submit" class="sign-btn">Đăng Ký</button>
      </form>
      
      <div class="or">or</div>
      
      <div class="social-sign">
        <button class="google-btn">Sign in with Google</button>
        <button class="apple-btn">Sign in with Apple</button>
      </div>
      
      <p class="signup">Đã Có Tài Khoản? <a href="login.php">Đăng Nhập</a></p>
    </div>
    
    <div class="image-box"> 
      <img src="hoa.jpg" alt="Plant">
    </div>
  </div>
</body>
</html>
    <?php
// Bắt đầu session
session_start();

// Kết nối cơ sở dữ liệu (điều chỉnh theo thông tin kết nối của bạn)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flower_shop";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Xử lý đăng ký khi người dùng gửi form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Kiểm tra nếu mật khẩu và xác nhận mật khẩu không khớp
    if ($password !== $confirm_password) {
        $error = "Mật khẩu xác nhận không khớp!";
    } else {
        // Kiểm tra nếu tên người dùng đã tồn tại
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $error = "Tên đăng nhập đã tồn tại!";
        } else {
            // Mã hóa mật khẩu và lưu thông tin người dùng vào cơ sở dữ liệu
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
            if ($conn->query($sql) === TRUE)
            {
                echo "<script>
                alert('Đăng ký thành công!');
                window.location.href = 'login.php';
              </script>";
                exit();
            }
           
        }
    }
}

$conn->close();
?>
</body>
</html>