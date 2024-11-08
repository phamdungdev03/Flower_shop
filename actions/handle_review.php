<?php
session_start();
include '../config/database.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $accountId = $_SESSION['user_id'];
    $comment = $_POST['comment'];
    $rating = $_POST['rating'];
    $productId = $_POST['product_id'];

    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $review_date = time();
    $formattedTime = date('Y-m-d H:i:s', $review_date);

    $conn = getConnection();
    $sql = "INSERT INTO reviews(account_id, product_id, rating, comment, review_date) VALUE (?,?,?,?,?)";
    $st = $conn->prepare($sql);
    $st->bind_param('sssss', $accountId, $productId, $rating, $comment, $formattedTime);
    if ($st->execute()) {
        header("Location: ../index.php");
    } else {
        echo "Có lỗi khi đánh giá sản phẩm!";
    }
}
