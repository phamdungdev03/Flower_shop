<link rel="stylesheet" href="./public/css/cart.css">

<?php

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'];
$scriptName = $_SERVER['SCRIPT_NAME'];
$path = str_replace(basename($scriptName), '', $scriptName);

$base_url = $protocol . $host . $path;
$base_url = rtrim($base_url, '/layout');

include "./actions/handle_cart.php";
include "./actions/handle_order.php";
if (isset($_SESSION['user_id'])) {
    $error = false;
    $success = false;
    if (isset($_GET['action'])) {
        $customer_id = $_SESSION['user_id'];
        switch ($_GET['action']) {
            case "add";
                if (isset($_POST['quantity'])) {
                    foreach ($_POST['quantity'] as $productID => $quantity) {
                        addToCart($customer_id, $productID, $quantity);
                    }
                }
                break;
            case "delete":
                if (isset($_GET['ctid']) && isset($_GET['cart_id'])) {
                    $cart_item_id = intval($_GET['ctid']);
                    $cart_id = intval($_GET['cart_id']);
                    deleteCart($cart_id, $cart_item_id);
                }
                break;
            case "edit":
                $cart_item_id = intval($_POST['cart_item_id']);
                $quantity = intval($_POST['quantity']);
                $product_id = intval($_POST['product_id']);
                updateCart($cart_item_id, $product_id, $quantity);
                break;
            case "submit":
                if ($error == false) {
                    $cart_id = getCartByUserId($customer_id);
                    $total_amount = 0;
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        if (isset($_POST['sendIds'])) {
                            $selectedIds = json_decode($_POST['sendIds'], true);
                            if (json_last_error() === JSON_ERROR_NONE) {
                                foreach ($selectedIds as $id) {
                                    $total = getTotalAmount($id);
                                    $total_amount += $total;
                                }
                            }
                        }
                    }
                    $order_id = addOrder($customer_id, $total_amount);
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        if (isset($_POST['sendIds'])) {
                            $selectedIds = json_decode($_POST['sendIds'], true);
                            if (json_last_error() === JSON_ERROR_NONE) {
                                foreach ($selectedIds as $id) {
                                    addOrderItem($id, $order_id);
                                }
                                $success = "Đặt hàng thành công";
                                echo "
                                    <script>
                                        localStorage.removeItem('selectedCartIds');
                                    </script>
                                    ";
                                deleteCartWhenByProduct($customer_id);
                            }
                        }
                    }
                }
                break;
            default:
                break;
        }
    }
    $customer_id = $_SESSION['user_id'];
    $result = getAllCarts($customer_id);
?>
    <?php if (!empty($error)) { ?>
        <?php
        echo "<script>
                localStorage.removeItem('selectedCartIds');
                alert('$error');
                window.location.href = '$base_url/cart.php';
             </script>";
        ?>
    <?php } else if (!empty($success)) { ?>
        <?php
        echo "<script>
                alert('Đặt đơn hàng thành công. Tiếp tục vào đơn hàng');
                window.location.href = '$base_url/index.php?id=6';
            </script>";
        ?>
    <?php
    } else { ?>
        <?php
        if ($result && mysqli_num_rows($result) <= 0) {
            echo "<div class='cart_null'>Không có sản phẩm nào trong giỏ hàng</div>";
        ?>
        <?php
        } else {
        ?>
            <div id="cart" class="container">
                <div class="cart-head">
                    <p>GIỎ HÀNG</p> (
                    <span>
                        <?php
                        if ($result && mysqli_num_rows($result) > 0) {
                            $totalProducts = mysqli_num_rows($result);
                            echo "<strong>$totalProducts</strong> sản phẩm";
                        }
                        ?>
                    </span>
                    )
                </div>
                <form id="sendIdsForm" action="index.php?id=5&action=submit" method="POST">
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th><input type="checkbox" class="checkbox-all"> Chọn tất cả</th>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result && mysqli_num_rows($result) > 0) {
                                $total = 0;
                                while ($row = mysqli_fetch_array($result)) {
                            ?>
                                    <tr class="cart-item">
                                        <td>
                                            <input type="checkbox" class="cart-checkbox" data-cart-id="<?= $row["cart_item_id"] ?>">
                                        </td>
                                        <td>
                                            <div class="cart-item_product">
                                                <img src="./public/uploads/<?= $row["default_image"] ?>" alt="image" class="cart-image">
                                                <p><?= $row["product_name"] ?></p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="cart-item-center__quantity">
                                                <span id="prev" data-product_id="<?= $row["product_id"] ?>" data-cart-id="<?= $row["cart_item_id"] ?>">-</span>
                                                <input id="quantity" name="quantity" type="number" min="1" value="<?= $row["quantity"] ?>" data-product_id="<?= $row["product_id"] ?>" data-cart-id="<?= $row["cart_item_id"] ?>">
                                                <span id="add" data-product_id="<?= $row["product_id"] ?>" data-cart-id="<?= $row["cart_item_id"] ?>">+</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="cart-item-center__total"><?= number_format($row["quantity"] * $row["product_price"], 0, ",", ","); ?>₫</span>
                                        </td>
                                        <td>
                                            <a class="cart-remove" href="index.php?id=5&action=delete&ctid=<?= $row["cart_item_id"] ?>&cart_id=<?= $row["cart_id"] ?>" style="text-decoration: none;">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='5' class='cart-null'>Không có sản phẩm nào trong giỏ hàng</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>

                    <!-- Phần tính tổng tiền và thanh toán -->
                    <div class="cart-summary">
                        <?php
                        $hasValidId = false;
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            if (isset($_POST['selectedIds'])) {
                                $selectedIds = json_decode($_POST['selectedIds'], true);
                                foreach ($selectedIds as $id) {
                                    $hasValidId = true;
                                    $conn = getConnection();
                                    $sql1 = "SELECT ci.*, p.product_price AS product_price FROM cart_items ci
                                  JOIN products p ON ci.product_id = p.product_id
                                  WHERE ci.cart_item_id = $id";
                                    $result = mysqli_query($conn, $sql1);

                                    if ($row = $result->fetch_assoc()) {
                                        $total += $row['product_price'] * $row['quantity'];
                                    }
                                }

                        ?>
                                <div class="cart-detail">
                                    <div class="cart-detail-price">
                                        <p>Thành tiền</p>
                                        <span><?php echo number_format($total, 0, ',', '.'); ?>đ</span>
                                    </div>
                                    <div class="cart-detail-total">
                                        <p>Tổng số tiền (gồm VAT)</p>
                                        <span><?php echo number_format($total, 0, ',', '.'); ?>đ</span>
                                    </div>
                                    <input type="hidden" name="sendIds" id="sendIdsInput">
                                    <input class="checkout <?php echo !$hasValidId ? 'disabled-btn' : ''; ?>" value="THANH TOÁN" onclick="buyProduct()">
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </form>
            </div>

            <!-- Các form và script khác -->
            <form id="updateCartForm" action="index.php?id=5&action=edit" method="POST" style="display:none;">
                <input type="hidden" name="cart_item_id" id="hiddenCartId">
                <input type="hidden" name="product_id" id="hiddenProductId">
                <input type="hidden" name="quantity" id="hiddenQuantity">
            </form>
            <form id="myForm" method="POST" action="index.php?id=5">
                <input type="hidden" name="selectedIds" id="selectedIds">
            </form>
            <form id="cart-list-form" action="index.php?id=5&action=select" method="POST">
                <input type="hidden" name="cartIds" id="cartIds">
            </form>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
            <script src="./public/js/cart.js"></script>
<?php
        }
    }
} else {
    echo " <div class='popup' id='popup'>
        <div class='popup-content'>
            <p>Bạn không thể thêm hoặc vào giỏ hàng vì chưa đăng nhập. Vui lòng đăng nhập tại đây.<a href='$base_url/login.php'> Đăng nhập</a>.</p>
        </div>
    </div>";
}
?>