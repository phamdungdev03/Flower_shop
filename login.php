<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="login.css">
</head>
<body>
  <div class="container">
    <div class="login-box">
      <h2>Đăng Nhập</h2>
      <p>Nhập thông tin đăng nhập của bạn để truy cập tài khoản của bạn</p>
      
      <form action="#" method="POST">
      <label for="username">Tên Đăng Nhập</label>
      <input type="text" id="username" name="username" placeholder="Enter your user name" required>
        
        <label for="password">Mật Khẩu</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>
        
        <div class="options">
          
          <a href="#">Quên Mật Khẩu?</a>
        </div>
        
        <button type="submit" class="login-btn">Đăng Nhập</button>
      </form>
      
      <div class="or">or</div>
      
      <div class="social-login">
        <button class="google-btn">Sign in with Google</button>
        <button class="apple-btn">Sign in with Apple</button>
      </div>
      
      <p class="signup">Bạn chưa có tài khoản? <a href="signup.php">Đăng Ký</a></p>
    </div>
    
    <div class="image-box"> 
      <img src="hinh-nen-hoa.jpg.webp" alt="Plant">
    </div>
  </div>
</body>
</html>

    <?php
// Bắt đầu session
session_start();

// Kiểm tra nếu người dùng đã đăng nhập thì chuyển đến trang chính
// if (isset($_SESSION['username'])) {
//     header("Location: index.php");
//     exit();
// }
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flower_shop";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
// Kiểm tra đăng nhập khi người dùng gửi form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password']))
        {
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit();
        }else {
            echo "<script>
                    alert('Sai tên đăng nhập, mật khẩu!');
                    window.location.href = 'login.php';
                  </script>";
                    exit();
        }
    }else{
        echo "<script>
                    alert('Sai tên đăng nhập, mật khẩu!');
                    window.location.href = 'login.php';
                  </script>";
                    exit();
    }

    
}
?>
</body>
</html>