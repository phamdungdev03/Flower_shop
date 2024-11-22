<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recipient_name = trim($_POST['recipient_name']);
    $recipient_phone = trim($_POST['recipient_phone']);
    $recipient_address = trim($_POST['recipient_address']);
    $delivery_time = $_POST['delivery_time'];
    $service = $_POST['service'];
    $note = trim($_POST['note']);

    $conn = getConnection();
    $sql = "INSERT INTO orders (recipient_name, recipient_phone, recipient_address, delivery_time, service, note)
                VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $recipient_name, $recipient_phone, $recipient_address, $delivery_time, $service, $note);

    if ($stmt->execute()) {
        echo "Đơn hàng đã được tạo thành công.";
    } else {
        echo "Có lỗi xảy ra khi thêm đơn hàng.";
    }
} else {
    foreach ($errors as $error) {
        echo "<p style='color: red;'>$error</p>";
    }
}
