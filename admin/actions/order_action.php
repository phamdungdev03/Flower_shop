<?php
include('../includes/order_function.php');
include('../includes/product_function.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
    switch ($action) {
        case 'editOrder':
            $orderId = $_POST['order_id'];
            $status = $_POST['status'];
            if (editOrder($orderId, $status)) {
                if ($status == 'completed') {
                    $resultOrderItem = getAllOrderItemByOrderId($orderId);
                    if ($resultOrderItem->num_rows > 0) {
                        while ($rowItem = $resultOrderItem->fetch_assoc()) {
                            $productId = $rowItem['product_id'];
                            $quantity = $rowItem['quantity'];
                            updateProductQuantity($productId, $quantity);
                        }
                    }
                }
                header("Location: ../indexadmin.php?id=10");
                exit();
            } else {
                echo "Lỗi khi cập nhật đơn hàng";
            }

            break;
        default:
            break;
    }
}
