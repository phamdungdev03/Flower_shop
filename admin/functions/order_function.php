<?php
include(__DIR__ . '/../../config/database.php');

function getAllOrders()
{
    $conn = getConnection();
    $sql = "SELECT o.order_id, o.order_date, o.total_price, o.status, o.recipient_name, u.full_name FROM orders as o JOIN accounts as u where o.account_id = u.account_id";
    $result = $conn->query($sql);
    return $result;
}

function getOrderByOderId($orderId)
{
    $conn = getConnection();
    $sql = "SELECT o.order_id, o.order_date, o.total_price, o.status, o.recipient_name, o.delivery_time, u.full_name FROM orders as o JOIN accounts as u where o.account_id = u.account_id AND order_id = ?";
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
    $sql = "SELECT ot.product_id, ot.price, ot.quantity, p.product_name, p.default_image FROM order_items as ot JOIN products as p where ot.product_id = p.product_id AND order_id = $orderId";
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

function getOrderByUserId($userId){
    $conn = getConnection();
    $sql = "SELECT * FROM orders WHERE account_id = $userId";
    $result = $conn->query($sql);
    return $result;
}

function getOrderItemByOrderId($orderId){
    $conn = getConnection();
    $sql = "SELECT * FROM order_items WHERE order_id = $orderId";
    $result = $conn->query($sql);
    return $result;
}

function deleteOrder($orderId)
{
    $conn = getConnection();
    $sql = "DELETE FROM orders WHERE order_id = ?";
    $st = $conn->prepare($sql);
    $st->bind_param("s", $orderId);

    if ($st->execute()) {
        return true;
    } else {
        return false;
    }

    $st->close();
    $conn->close();
}

function deleteOrderItem($orderItemId)
{
    $conn = getConnection();
    $sql = "DELETE FROM order_items WHERE order_item_id = ?";
    $st = $conn->prepare($sql);
    $st->bind_param("s", $orderItemId);

    if ($st->execute()) {
        return true;
    } else {
        return false;
    }

    $st->close();
    $conn->close();
}