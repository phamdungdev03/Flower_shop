<?php
include('../functions/account_function.php');
include('../functions/order_function.php');
include('../functions/cart_function.php');
include('../functions/withlist_function.php');
include('../functions/review_function.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
    switch ($action) {
        case 'addAccount':
            $userName = $_POST['user_name'];
            $password = $_POST['password'];
            $fullName = $_POST['full_name'];
            $email = $_POST['email'];
            $phone = $_POST['phone_number'];
            $address = $_POST['address'];
            $isAdmin = $_POST['is_admin'];
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            if (isUsernameExists($userName)) {
                echo "<script>
                        alert('Tên đăng nhập đã tồn tại!');
                        window.location.href = 'javascript:history.back()';
                      </script>";
                exit();
            } else {
                if (addUser($userName, $email, $phone, $address, $hashed_password, $isAdmin, $fullName)) {
                    echo "Thêm người dùng thành công!";
                    header("Location: ../index.php?id=7");
                    exit();
                } else {
                    echo "Lỗi khi thêm người dùng";
                }
            }
            break;
        case 'editAccount':
            $accountId = $_POST['account_id'];
            $fullName = $_POST['full_name'];
            $email = $_POST['email'];
            $phone = $_POST['phone_number'];
            $address = $_POST['address'];
            $isAdmin = $_POST['is_admin'];
            if (editUser($accountId, $fullName, $email, $phone, $address, $isAdmin)) {
                echo "Cập nhật người dùng thành công!";
                header("Location: ../index.php?id=7");
                exit();
            } else {
                echo "Lỗi khi cập nhật người dùng";
            }

            break;
        default:
            break;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['account_id'])) {
        $accountId = $_GET['account_id'];
        // delete order
        $ordersResult = getOrderByUserId($accountId);
        if ($ordersResult->num_rows > 0) {
            while ($order = $ordersResult->fetch_assoc()) {
                $orderId = $order['order_id'];
                $orderItemsResult = getOrderItemByOrderId($orderId);
                if ($orderItemsResult->num_rows > 0) {
                    while ($orderItem = $orderItemsResult->fetch_assoc()) {
                        echo $orderItem['order_item_id'];
                        deleteOrderItem($orderItem['order_item_id']);
                    }
                }
                deleteOrder($orderId);
            }
        }

        // delete cart
        $cartResult = getCartByUserIdd($accountId);
        if ($cartResult->num_rows > 0) {
            while ($cart = $cartResult->fetch_assoc()) {
                $cartId = $cart['cart_id'];
                $cartItemsResult = getOrderItemByOrderId($cartId);
                if ($cartItemsResult->num_rows > 0) {
                    while ($cartItem = $cartItemsResult->fetch_assoc()) {
                        deleteCartItem($cartItem['cart_item_id']);
                    }
                }
                deleteCart($cartId);
            }
        }

        // delete wishlist
        $wishlistsResult = getWishListByUserId($accountId);
        if ($wishlistsResult->num_rows > 0) {
            while ($wishlists = $wishlistsResult->fetch_assoc()) {
                $wishlistId = $wishlists['wishlist_id'];
                deleteWishlist($wishlistId);
            }
        }

        // delete review
        $reviewResult = getReviewByUserId($accountId);
        if ($reviewResult->num_rows > 0) {
            while ($review = $reviewResult->fetch_assoc()) {
                $reviewId = $review['review_id'];
                deleteReview($reviewId);
            }
        }

        if (deleteUser($accountId)) {
            header("Location: ../index.php?id=7");
            exit();
        } else {
            echo "<script>
                        alert('Bạn không thể xóa người dùng này vì liên quan đến dữ liệu hệ thống!');
                        window.location.href = '../index.php?id=7';
                      </script>";
            exit();
        }
    }
}
