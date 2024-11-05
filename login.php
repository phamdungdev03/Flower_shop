<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - Web bán hoa</title>
    <link rel="stylesheet" href="login.css">

</head>
<body>
    

    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="post" action="login.php">
    <h2>Đăng nhập</h2>
        <label for="username">Tên đăng nhập:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="password">Mật khẩu:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        
        <button type="submit">Đăng nhập</button>
    </form>
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