<link rel="stylesheet" href="./public/css/checkout.css">

<?php
if (isset($_GET['selectedIds']) && !empty($_GET['selectedIds'])) {
    $selectedIds = $_GET['selectedIds'];
    $selectedProductIds = implode(',', $selectedIds);

    $conn = getConnection();
    $sql = "SELECT ci.*, p.product_name, p.product_price, p.default_image 
            FROM cart_items ci
            JOIN products p ON ci.product_id = p.product_id
            WHERE ci.cart_item_id IN ($selectedProductIds)";
    $result = mysqli_query($conn, $sql);
} else {
    echo "Không có sản phẩm nào được chọn.";
    exit;
}
?>

<section class="checkout">
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <span>Trang chủ / Đơn hàng</span>
    </div>
    <!-- Main container -->
    <div class="checkout-container">
        <!-- Form bên trái -->
        <div class="checkout-form">
            <h2 class="form-title">Thông tin người nhận</h2>
            <form action="#" method="post">
                <div class="form-group">
                    <label for="name">Họ và tên</label>
                    <input type="text" id="name" name="name" placeholder="Nhập họ và tên">
                </div>
                <div class="form-group">
                    <label for="phone">Số điện thoại</label>
                    <input type="tel" id="phone" name="phone" placeholder="Nhập số điện thoại">
                </div>
                <div class="form-group">
                    <label for="address">Địa chỉ</label>
                    <input type="text" id="address" name="address" placeholder="Nhập địa chỉ">
                </div>
                <div class="form-group">
                    <label for="delivery-time">Thời gian dự kiến</label>
                    <input type="datetime-local" id="delivery-time" name="delivery_time">
                </div>
                <div class="form-group">
                    <label for="services">Dịch vụ kèm theo</label>
                    <select id="services" name="services">
                        <option value="none">Không</option>
                        <option value="Gói quà">Gói quà</option>
                        <option value="Thiệp chúc mừng">Thiệp chúc mừng</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="message">Lời nhắn</label>
                    <textarea id="message" name="message" placeholder="Nhập lời nhắn" rows="4"></textarea>
                </div>
                <div class="form-action">
                    <button type="submit" class="btn-submit">Hoàn tất đơn hàng</button>
                </div>
            </form>
        </div>
        <!-- Thông tin sản phẩm bên phải -->
        <div class="checkout-products">
            <h2 class="product-title">Thông tin sản phẩm</h2>
            <?php
            if ($result && mysqli_num_rows($result) > 0) {
                $total = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $productTotal = $row['product_price'] * $row['quantity'];
                    $total += $productTotal;
            ?>
                    <div class="product-item">
                        <img src="./public/uploads/<?= $row["default_image"] ?>" alt="Ảnh sản phẩm" class="product-image">
                        <div class="product-details">
                            <h3 class="product-name"><?= $row["product_name"] ?></h3>
                            <p class="product-price">Giá: <?= number_format($row["product_price"], 0, ",", "."); ?>₫</p>
                            <p class="product-total">Thành tiền: <?= number_format($productTotal, 0, ",", "."); ?>₫</p>
                        </div>
                    </div>
                <?php
                }
                ?>
                <div class="total-price">
                    <p>Tổng tiền (gồm VAT): <strong><?= number_format($total, 0, ",", "."); ?>₫</strong></p>
                </div>
            <?php
            } else {
                echo "<p>Không có sản phẩm nào được chọn.</p>";
            }
            ?>
        </div>
    </div>
</section>