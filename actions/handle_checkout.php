<?php
include("../config/database.php");
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recipient_name = trim($_POST['recipient_name']);
    $recipient_phone = trim($_POST['recipient_phone']);
    $recipient_address = trim($_POST['recipient_address']);
    $delivery_time = $_POST['delivery_time'];
    $service = $_POST['service'];
    $note = trim($_POST['note']);
    $customer_id = $_SESSION['user_id'];

    $cartItemsJson = isset($_POST['cartItems']) ? $_POST['cartItems'] : '[]';
    $cartItems = json_decode($cartItemsJson, true);
    $total_amount = 0;
    if (!empty($cartItems)) {
        foreach ($cartItems as $item) {
            $total = getTotalAmount($item['cart_item_id']);
            $total_amount += $total;
        }
    }
    $order_id = addOrder($customer_id, $total_amount, $recipient_name, $recipient_phone, $recipient_address, $delivery_time, $service, $note);
    echo $order_id;
    if (!empty($cartItems)) {
        foreach ($cartItems as $item) {
            addOrderItem($item['cart_item_id'], $order_id);
        }
    }
    echo "<script>
                localStorage.removeItem('selectedCartIds');
                alert('Đặt hàng thành công');
                window.location.href = '../index.php?id=6';
             </script>";
    deleteCartWhenByProduct($customer_id, $cartItems);
} else {
    foreach ($errors as $error) {
        echo "<p style='color: red;'>$error</p>";
    }
}

function getTotalAmount($cartItemId)
{
    $conn = getConnection();
    $total = 0;
    $sql2 = "SELECT ci.quantity, p.sale_price 
    FROM cart_items ci
    JOIN products p ON ci.product_id = p.product_id
    WHERE ci.cart_item_id = $cartItemId";
    $result2 = $conn->query($sql2);

    if ($result2 && $result2->num_rows > 0) {
        while ($itemRow = $result2->fetch_assoc()) {
            $total = $itemRow["quantity"] * $itemRow["sale_price"];
        }
    }
    return $total;
}

function addOrder($user_id, $total_amount, $recipient_name, $recipient_phone, $recipient_address, $delivery_time, $service, $note)
{
    $conn = getConnection();
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $currentTime = time();
    $formattedTime = date('Y-m-d H:i:s', $currentTime);
    $sql2 = "INSERT INTO `orders`( `account_id`,`order_date`, `total_price`, `recipient_name`, `recipient_phone`, `recipient_address`, `delivery_time`, `service`, `note`)
                        VALUES ('$user_id', '$formattedTime', '$total_amount', '$recipient_name','$recipient_phone', '$recipient_address', '$delivery_time', '$service', '$note')";
    $inserntOrder = mysqli_query($conn, $sql2);
    $last_id = mysqli_insert_id($conn);
    return $last_id;
}

function addOrderItem($cartItemId, $cartId)
{
    $conn = getConnection();
    $sql = "SELECT ci.quantity,p.sale_price ,p.product_price, ci.product_id FROM cart_items ci JOIN products p ON ci.product_id = p.product_id WHERE ci.cart_item_id = $cartItemId";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($itemRow = $result->fetch_assoc()) {
            $price = $itemRow['sale_price'];
            $quantity = $itemRow['quantity'];
            $product_id = $itemRow['product_id'];

            $sql3 = "INSERT INTO `order_items`(`order_id`, `price`, `quantity`, `product_id`) VALUES ('$cartId', '$price', '$quantity', '$product_id')";
            $insertOrder = mysqli_query($conn, $sql3);
            return $insertOrder;
        }
    }
}

function deleteCartWhenByProduct($customerId, $cartItems)
{
    $conn = getConnection();
    $sql1 = "SELECT cart_id FROM cart WHERE account_id = $customerId";
    $result1 = $conn->query($sql1);
    if ($result1->num_rows > 0) {
        $row = $result1->fetch_assoc();
        $cart_id = $row['cart_id'];
        foreach ($cartItems as $item) {
            $cartItemId = $item['cart_item_id'];
            $sql2 = "SELECT cart_item_id FROM cart_items WHERE cart_item_id = $cartItemId";
            $result2 = $conn->query($sql2);
            if ($result2->num_rows > 0) {
                while ($itemRow = $result2->fetch_assoc()) {
                    $cart_item_id = $itemRow['cart_item_id'];
                    deleteCart($cart_id, $cart_item_id);
                }
            }
        }
    }
}

function deleteCart($cart_id, $cart_item_id)
{
    $conn = getConnection();
    $sql = "DELETE FROM cart_items WHERE cart_item_id = $cart_item_id";
    $conn->query($sql);

    $sql_check = "SELECT COUNT(*) as total FROM cart_items WHERE cart_id = $cart_id";
    $result = $conn->query($sql_check);
    if ($result) {
        $row = $result->fetch_assoc();
        $total = $row['total'];
        if ($total == 0) {
            $sql_delete = "DELETE FROM cart where cart_id = $cart_id";
            $conn->query($sql_delete);
        }
    }
}
