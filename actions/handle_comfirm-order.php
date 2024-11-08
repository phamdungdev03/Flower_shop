<?php
include '../config/database.php';

$conn = getConnection();
$sql = "UPDATE `orders` SET status='processed' WHERE `order_id`=' " . $_GET['iddh'] . "'";
if (mysqli_query($conn, $sql)) {
    header('location: ../index.php?id=6');
} else {
    $result = "Lỗi thêm mới" . mysqli_error($conn);
}
