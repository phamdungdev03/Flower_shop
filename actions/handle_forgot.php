<?php
session_start();
include("../config/database.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION)) {
        $accountId = $_SESSION['user_id'];
        $conn = getConnection();

        $sql = "SELECT * FROM accounts WHERE account_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $accountId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $userInfo = $result->fetch_assoc();
        }

        $passwordOld = $_POST['currentPassword'];
        $passwordNew = $_POST['newPassword'];
        $passwordConfig = $_POST['confirmNewPassword'];
        if (password_verify($passwordOld, $userInfo['password'])) {
            if ($passwordNew == $passwordConfig) {
                $hashedPassword = password_hash($passwordNew, PASSWORD_DEFAULT);

                $updateSql = "UPDATE accounts SET password = ? WHERE account_id = ?";
                $updateStmt = $conn->prepare($updateSql);
                $updateStmt->bind_param("si", $hashedPassword, $accountId);
                if ($updateStmt->execute()) {
                    echo "<script>alert('Mật khẩu đã được thay đổi thành công.'); window.location.href = '../index.php?id=4';</script>";
                } else {
                    echo "<script>alert('Đã xảy ra lỗi. Vui lòng thử lại.'); window.location.href = '../index.php?id=4';</script>";
                }
            }
        } else {
            echo "<script>alert('Mật khẩu cũ không đúng. Vui lòng thử lại.'); window.location.href = '../index.php?id=10';</script>";
        }
    } else {
        echo "<p>Bạn hãy <a href='./login.php'>Đăng Nhập</a> để thay đổi mật khẩu.</p>";
        exit();
    }
}
