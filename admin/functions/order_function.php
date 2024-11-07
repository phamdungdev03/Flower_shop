<?php
include(__DIR__ . '/../../config/database.php');

function getAllOrders()
{
    $conn = getConnection();
    $sql = "SELECT o.order_id, o.order_date, o.total_amount, o.status, u.full_name FROM orders as o JOIN users as u where o.user_id = u.user_id";
    $result = $conn->query($sql);
    return $result;
}

function getOrderByOderId($orderId)
{
    $conn = getConnection();
    $sql = "SELECT o.order_id, o.order_date, o.total_amount, o.status, u.full_name FROM orders as o JOIN users as u where o.user_id = u.user_id AND order_id = ?";
    $st = $conn->prepare($sql);
    $st->bind_param("s", $orderId);
    $st->execute();
    $result = $st->get_result();
    if ($result->num_rows > 0) {
        $category = $result->fetch_assoc();
        return $category;
    }
}

function getAllOrderItemByOrderId($orderId){
    $conn = getConnection();
    $sql = "SELECT ot.product_id, ot.price, ot.quantity, p.product_name, p.image_url FROM order_items as ot JOIN products as p where ot.product_id = p.product_id AND order_id = $orderId";
    $result = $conn->query($sql);
    return $result;
}

function editOrder($orderId, $orderStatus)
{
    $conn = getConnection();
    $sql = "UPDATE orders SET status = ? WHERE order_id = ?";
    $st = $conn->prepare($sql);
    $st->bind_param("ss", $orderStatus, $orderId);
    if ($st->execute()) {
        return true;
    } else {
        return false;
    }
    $conn->close();
    $st->closse();
}
