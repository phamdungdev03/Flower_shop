<?php
include(__DIR__ . '/../../config/database.php');

function getCartByUserIdd($userId){
    $conn = getConnection();
    $sql = "SELECT * FROM cart WHERE account_id = $userId";
    $result = $conn->query($sql);
    return $result;
}

function getCartItemByUserId($cartId){
    $conn = getConnection();
    $sql = "SELECT * FROM cart_items WHERE cart_id = $cartId";
    $result = $conn->query($sql);
    return $result;
}

function deleteCart($cartId)
{
    $conn = getConnection();
    $sql = "DELETE FROM cart WHERE cart_id = ?";
    $st = $conn->prepare($sql);
    $st->bind_param("s", $cartId);

    if ($st->execute()) {
        return true;
    } else {
        return false;
    }

    $st->close();
    $conn->close();
}

function deleteCartItem($cartItemId)
{
    $conn = getConnection();
    $sql = "DELETE FROM cart_items WHERE cart_item_id = ?";
    $st = $conn->prepare($sql);
    $st->bind_param("s", $cartItemId);

    if ($st->execute()) {
        return true;
    } else {
        return false;
    }

    $st->close();
    $conn->close();
}