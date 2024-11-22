<?php
include(__DIR__ . '/../../config/database.php');

function getWishListByProductId($productId){
    $conn = getConnection();
    $sql = "SELECT * FROM wishlists WHERE product_id = $productId";
    $result = $conn->query($sql);
    return $result;
}

function getWishListByUserId($userId){
    $conn = getConnection();
    $sql = "SELECT * FROM wishlists WHERE account_id = $userId";
    $result = $conn->query($sql);
    return $result;
}

function deleteWishlist($wishlistId)
{
    $conn = getConnection();
    $sql = "DELETE FROM wishlists WHERE wishlist_id = ?";
    $st = $conn->prepare($sql);
    $st->bind_param("s", $wishlistId);

    if ($st->execute()) {
        return true;
    } else {
        return false;
    }

    $st->close();
    $conn->close();
}

