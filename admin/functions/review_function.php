<?php
include(__DIR__ . '/../../config/database.php');

function getReviewByProductId($productId){
    $conn = getConnection();
    $sql = "SELECT * FROM reviews WHERE product_id = $productId";
    $result = $conn->query($sql);
    return $result;
}

function getReviewByUserId($userId){
    $conn = getConnection();
    $sql = "SELECT * FROM reviews WHERE account_id = $userId";
    $result = $conn->query($sql);
    return $result;
}

function deleteReview($reviewId)
{
    $conn = getConnection();
    $sql = "DELETE FROM reviews WHERE review_id = ?";
    $st = $conn->prepare($sql);
    $st->bind_param("s", $reviewId);

    if ($st->execute()) {
        return true;
    } else {
        return false;
    }

    $st->close();
    $conn->close();
}