<?php
session_start();
include '../config/database.php';
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['product_id'])) {
        $productId = $_GET['product_id'];
        $accountId = $_SESSION['user_id'];
        $conn = getConnection();

        $sql1 = "SELECT * FROM wishlists WHERE account_id = ? AND product_id = ?";
        $st1 = $conn->prepare($sql1);
        $st1->bind_param('ss', $accountId, $productId);
        $st1->execute();
        $result = $st1->get_result();

        if ($result->num_rows > 0) {
            $sql2 = "DELETE FROM wishlists WHERE account_id = ? AND product_id = ?";
            $st2 = $conn->prepare($sql2);
            $st2->bind_param('ss', $accountId, $productId);
            if ($st2->execute()) {
                header("Location: ../index.php");
            } else {
                echo "Có lỗi khi xóa sản phẩm yêu thích!";
            }
        } else {
            $sql3 = "INSERT INTO wishlists(account_id, product_id) VALUES (?, ?)";
            $st3 = $conn->prepare($sql3);
            $st3->bind_param('ss', $accountId, $productId);
            if ($st3->execute()) {
                header("Location: ../index.php");
            } else {
                echo "Có lỗi khi thêm sản phẩm yêu thích!";
            }
        }
    }
}
