<?php
session_start();
include '../config/database.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $contact_date = time();
    $formattedTime = date('Y-m-d H:i:s', $contact_date);
    $accountId = $_SESSION['user_id'];

    $conn = getConnection();
    $sql = "INSERT INTO contacts(contact_name, contact_email, contact_phone, message, account_id, contact_date) VALUE (?,?,?,?,?,?)";
    $st = $conn->prepare($sql);
    $st->bind_param('ssssss', $name, $email, $phone, $message, $accountId, $formattedTime);
    if ($st->execute()) {
        header("Location: ../index.php");
    } else {
        echo "Có lỗi khi gửi liên hệ!";
    }
}
