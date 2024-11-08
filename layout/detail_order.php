<link rel="stylesheet" href="./public/css/order_item.css">
<?php
include './actions/handle_order.php';
if (isset($_GET['order_id'])) {
    $orderId = $_GET['order_id'];
    $result = getOrderById($orderId);
    $order = mysqli_fetch_assoc($result);
    $orderItems = getOrderItemByOrderId($orderId);

    switch ($order['status']) {
        case 'pending':
            $statusDisplay = 'Chờ Xác Nhận';
            break;
        case 'processed':
            $statusDisplay = 'Đã Xác Nhận';
            break;
        case 'shipping':
            $statusDisplay = 'Đang Vận Chuyển';
            break;
        case 'completed':
            $statusDisplay = 'Hoàn Thành';
            break;
        case 'cancelled':
            $statusDisplay = 'Đã Hủy';
            break;
        default:
            $statusDisplay = 'Không xác định';
    }
}
?>
<div class="order-details">
    <h1 class="order-title">Chi Tiết Đơn Hàng</h1>
    <section class="order-info">
        <div class="order-item">
            <span class="label">Số Đơn Hàng:</span>
            <span class="value"><?php echo $order['order_id'] ?></span>
        </div>
        <div class="order-item">
            <span class="label">Ngày Đặt Hàng:</span>
            <span class="value"><?php echo $order['order_date'] ?></span>
        </div>
        <div class="order-item">
            <span class="label">Tổng tiền đơn hàng:</span>
            <span class="value"><?php echo number_format($order['total_price'], 0, ',', ',') . 'đ' ?></span>
        </div>
        <div class="order-item">
            <span class="label">Trạng Thái Đơn Hàng:</span>
            <span class="value"><?php echo $statusDisplay ?></span>
        </div>
    </section>
    <section class="order-items">
        <?php
        while ($row = mysqli_fetch_assoc($orderItems)) {
            $ten = $row['product_name'];
            $gia = $row['price'];
            $soluong = $row['quantity'];
            $tong = $row['quantity'] * $row['price'];
            $imageUrl = './public/uploads/' . htmlspecialchars($row['default_image']);
            $productId = $row['product_id'];
        ?>
            <div class="order-product">
                <img src="<?php echo $imageUrl ?>" alt="" class="product-image">
                <div class="product-info">
                    <span class="product-name"><?php echo $ten ?></span>
                    <div class="product-details">
                        <span class="product-price">Giá sản phẩm: <?php echo number_format($gia, 0, ',', ',') . 'đ' ?></span>
                        <span class="product-quantity">Số Lượng: <?php echo $soluong ?></span>
                        <span class="product-total">Thành Tiền: <?php echo number_format($tong, 0, ',', ',') . 'đ' ?></span>
                    </div>
                </div>
                <?php
                if ($order['status'] == "completed") {
                    echo "<a href='./index.php?id=8&product_id=$productId'>
                        <button class='order-review'>Đánh giá</button>
                    </a>";
                }
                ?>
            </div>
        <?php
        }
        ?>
    </section>
</div>