<link rel="stylesheet" href="./public/css/checkout.css">

<?php
$cartItems = [];
$total = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['selectedCartIds'])) {
        $selectedCartIds = json_decode($_POST['selectedCartIds'], true);

        if (!empty($selectedCartIds)) {
            foreach ($selectedCartIds as $cartId) {
                $cartItem = getCartItemDetails($cartId);
                if ($cartItem) {
                    $cartItems[] = $cartItem;
                }
            }

            $total = array_sum(array_map(function ($item) {
                return $item['product_price'] * $item['quantity'];
            }, $cartItems));
        }
    }
}

function getCartItemDetails($cartId)
{
    $conn = getConnection();
    $sql = "SELECT ci.*, p.product_name, p.product_price,p.default_image
            FROM cart_items ci
            JOIN products p ON ci.product_id = p.product_id
            WHERE ci.cart_item_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $cartId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

$cartItemsJson = json_encode($cartItems);
?>

<section class="checkout">
    <div class="breadcrumb">
        <span>Trang chủ / Đơn hàng</span>
    </div>
    <div class="checkout-container">
        <div class="checkout-form">
            <h2 class="form-title">Thông tin người nhận</h2>
            <form action="actions/handle_checkout.php" method="POST">
            <input type="hidden" name="cartItems" value='<?php echo htmlspecialchars($cartItemsJson); ?>'>
                <div class="form-group">
                    <label for="recipient_name">Họ và tên</label>
                    <input type="text" id="recipient_name" name="recipient_name" placeholder="Nhập họ và tên">
                </div>
                <div class="form-group">
                    <label for="recipient_phone ">Số điện thoại</label>
                    <input type="tel" id="recipient_phone" name="recipient_phone" placeholder="Nhập số điện thoại">
                </div>
                <div class="form-group">
                    <label for="recipient_address">Địa chỉ</label>
                    <input type="text" id="recipient_address" name="recipient_address" placeholder="Nhập địa chỉ">
                </div>
                <div class="form-group">
                    <label for="delivery-time">Thời gian dự kiến</label>
                    <input type="datetime-local" id="delivery-time" name="delivery_time">
                </div>
                <div class="form-group">
                    <label for="service">Dịch vụ kèm theo</label>
                    <select id="service" name="service">
                        <option value="none">Không</option>
                        <option value="Gói quà">Gói quà</option>
                        <option value="Thiệp chúc mừng">Thiệp chúc mừng</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="note">Lời nhắn</label>
                    <textarea id="note" name="note" placeholder="Nhập lời nhắn" rows="4"></textarea>
                </div>
                <div class="form-action">
                    <button type="submit" class="btn-submit">Hoàn tất đơn hàng</button>
                </div>
            </form>
        </div>

        <div class="checkout-products">
            <h2 class="product-title">Thông tin sản phẩm</h2>
            <?php if (!empty($cartItems)) : ?>
                <?php foreach ($cartItems as $item) : ?>
                    <div class="product-item">
                        <img src="./public/uploads/<?= $item["default_image"] ?>" alt="Ảnh" class="product-image">
                        <div class="product-details">
                            <h3 class="product-name"><?= htmlspecialchars($item['product_name']) ?></h3>
                            <p class="product-quantity">Số lượng: <?= htmlspecialchars($item['quantity']) ?></p>
                            <p class="product-price">Giá: <?= number_format($item['product_price'], 0, ',', '.') ?>₫</p>
                            <p class="product-total">Thành tiền: <?= number_format($item['product_price'] * $item['quantity'], 0, ',', '.') ?>₫</p>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="total-price">
                    <span>Tổng tiền: </span>
                    <strong><?= number_format($total, 0, ',', '.') ?>₫</strong>
                </div>
            <?php else : ?>
                <p>Không có sản phẩm nào được chọn.</p>
            <?php endif; ?>
        </div>
    </div>
</section>