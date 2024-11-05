<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký - Web bán hoa</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body>

    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="post" action="signup.php">
    <h2>Đăng ký tài khoản</h2>

        <label for="username">Tên đăng nhập:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="password">Mật khẩu:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        
        <label for="confirm_password">Xác nhận mật khẩu:</label><br>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>
        
        <button type="submit">Đăng ký</button>
    </form>
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