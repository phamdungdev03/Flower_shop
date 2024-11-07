<?php
include('../functions/account_function.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
    switch ($action) {
        case 'addAccount':
            $userName = $_POST['user_name'];
            $password = $_POST['password'];
            $fullName = $_POST['full_name'];
            $email = $_POST['email'];
            $phone = $_POST['phone_number'];
            $address = $_POST['address'];
            $isAdmin = $_POST['is_admin'];
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            if (isUsernameExists($userName)) {
                echo "<script>
                        alert('Tên đăng nhập đã tồn tại!');
                        window.location.href = 'javascript:history.back()';
                      </script>";
                exit();
            } else {
                if (addUser($userName, $email, $phone, $address, $hashed_password, $isAdmin, $fullName)) {
                    echo "Thêm người dùng thành công!";
                    header("Location: ../index.php?id=7");
                    exit();
                } else {
                    echo "Lỗi khi thêm người dùng";
                }
            }
            break;
        case 'editAccount':
            $accountId = $_POST['account_id'];
            $fullName = $_POST['full_name'];
            $email = $_POST['email'];
            $phone = $_POST['phone_number'];
            $address = $_POST['address'];
            $isAdmin = $_POST['is_admin'];
            if (editUser($accountId, $fullName, $email, $phone, $address, $isAdmin)) {
                echo "Cập nhật người dùng thành công!";
                header("Location: ../index.php?id=7");
                exit();
            } else {
                echo "Lỗi khi cập nhật người dùng";
            }

            break;
        default:
            break;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['account_id'])) {
        $accountId = $_GET['account_id'];
        if (deleteUser($accountId)) {
            header("Location: ../index.php?id=7");
            exit();
        } else {
            echo "<script>
                        alert('Lỗi khi xóa người dùng!');
                        window.location.href = '../index.php?id=7';
                      </script>";
            exit();
        }
    }
}