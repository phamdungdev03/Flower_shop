<?php
session_start();
include("../config/database.php");
if (isset($_POST["btn_submit"])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $conn = getConnection();
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role_name'] = $user['role_name'];
            if ($user["role_name"] == "admin") {
                header("Location: ../admin");
            } else {
                header("Location: ../index.php");
            }
        } else {
            echo "<script>alert('Mật khẩu không đúng!');
                  window.location.href = '../login.php';</script>";
        }
    } else {
        echo "<script>alert('Tên đăng nhập không tồn tại!');
              window.location.href = 'login.php';</script>";
    }
}
