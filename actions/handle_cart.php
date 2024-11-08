<?php
include("./config/database.php");
function getAllCarts($userId)
{
    $conn = getConnection();
    $sql = "SELECT products.product_name, products.default_image,cart.cart_id,cart_items.cart_item_id,products.product_price, cart_items.quantity, cart_items.product_id 
        FROM cart 
        JOIN cart_items ON cart.cart_id = cart_items.cart_id 
        JOIN products ON cart_items.product_id = products.product_id
        WHERE cart.account_id = $userId";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function addToCart($customer_id, $product_id, $quantity)
{
    $conn = getConnection();
    $sql1 = "SELECT cart_id FROM cart WHERE account_id = $customer_id";
    $result1 = $conn->query($sql1);

    if ($result1->num_rows > 0) {
        $row = $result1->fetch_assoc();
        $cart_id = $row['cart_id'];
    } else {
        $sql2 = "INSERT INTO cart (account_id) VALUES ($customer_id)";
        if ($conn->query($sql2) === TRUE) {
            $cart_id = $conn->insert_id;
        }
    }

    $sql3 = "SELECT quantity FROM cart_items WHERE cart_id = $cart_id AND product_id = $product_id";
    $result3 = $conn->query($sql3);

    $sql7 = "SELECT * from products where product_id = $product_id";
    $resultProduct = $conn->query($sql7);

    if ($resultProduct->num_rows > 0) {
        $product = $resultProduct->fetch_assoc();
        $price = $product['product_price'];
    }

    if ($result3->num_rows > 0) {

        $row = $result3->fetch_assoc();
        $new_quantity = $row['quantity'] + $quantity;
        $sql4 = "UPDATE cart_items SET quantity = $new_quantity WHERE cart_id = $cart_id AND product_id = $product_id";
        $conn->query($sql4);
    } else {
        $sql5 = "INSERT INTO cart_items (cart_id, product_id, quantity) VALUES ($cart_id, $product_id, $quantity)";
        $conn->query($sql5);
    }
}

function updateCart($cart_item_id, $product_id, $quantity)
{
    $conn = getConnection();
    if ($quantity > 0) {
        $sql = "UPDATE cart_items SET quantity = $quantity Where cart_item_id = $cart_item_id and product_id = $product_id";
        $conn->query($sql);
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

function deleteCartWhenByProduct($customerId)
{
    $conn = getConnection();
    $sql1 = "SELECT cart_id FROM cart WHERE account_id = $customerId";
    $result1 = $conn->query($sql1);
    if ($result1->num_rows > 0) {
        $row = $result1->fetch_assoc();
        $cart_id = $row['cart_id'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['sendIds'])) {
                $selectedIds = json_decode($_POST['sendIds'], true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    foreach ($selectedIds as $id) {
                        $sql2 = "SELECT cart_item_id FROM cart_items WHERE cart_item_id = $id";
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
        }
    }
}
