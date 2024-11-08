<?php

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'];
$scriptName = $_SERVER['SCRIPT_NAME'];
$path = str_replace(basename($scriptName), '', $scriptName);

$base_url = $protocol . $host . $path;
$base_url = rtrim($base_url, '/');

include("$base_url/config/database.php");

function getCartByUserId($userId)
{
    $conn = getConnection();
    $sql = "SELECT cart_id FROM cart WHERE account_id = $userId";
    $resultCartItem = $conn->query($sql);
    if ($resultCartItem->num_rows > 0) {
        $row = $resultCartItem->fetch_assoc();
        $cart_id = $row['cart_id'];
        return $cart_id;
    }
}

function addOrder($user_id, $total_amount)
{
    $conn = getConnection();
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $currentTime = time();
    $formattedTime = date('Y-m-d H:i:s', $currentTime);
    $sql2 = "INSERT INTO `orders`( `account_id`,`order_date`, `total_price`)
                        VALUES ('$user_id', '$formattedTime', '$total_amount')";
    $inserntOrder = mysqli_query($conn, $sql2);
    $last_id = mysqli_insert_id($conn);
    return $last_id;
}

function addOrderItem($cartItemId, $cartId)
{
    $conn = getConnection();
    $sql = "SELECT ci.quantity, p.product_price, ci.product_id FROM cart_items ci JOIN products p ON ci.product_id = p.product_id WHERE ci.cart_item_id = $cartItemId";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($itemRow = $result->fetch_assoc()) {
            $price = $itemRow['product_price'];
            $quantity = $itemRow['quantity'];
            $product_id = $itemRow['product_id'];

            $sql3 = "INSERT INTO `order_items`(`order_id`, `price`, `quantity`, `product_id`) VALUES ('$cartId', '$price', '$quantity', '$product_id')";
            $insertOrder = mysqli_query($conn, $sql3);
            return $insertOrder;
        }
    }
}

function getTotalAmount($cartItemId)
{
    $conn = getConnection();
    $total = 0;
    $sql2 = "SELECT ci.quantity, p.product_price 
    FROM cart_items ci
    JOIN products p ON ci.product_id = p.product_id
    WHERE ci.cart_item_id = $cartItemId";
    $result2 = $conn->query($sql2);

    if ($result2 && $result2->num_rows > 0) {
        while ($itemRow = $result2->fetch_assoc()) {
            $total = $itemRow["quantity"] * $itemRow["product_price"];
        }
    }
    return $total;
}
