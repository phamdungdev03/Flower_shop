<link rel="stylesheet" href="./public/css/order.css">
<section class="order-section">
    <div class="container">
        <h2>Danh Sách Đơn Hàng</h2>
        <?php
        include './config/database.php';
        $conn = getConnection();
        $username = $_SESSION['username'];
        $query = "SELECT account_id FROM accounts WHERE user_name = '$username'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $customer_id = $row['account_id'];
        $sql = "SELECT order_id FROM orders WHERE account_id = $customer_id";
        $result = mysqli_query($conn, $sql);
        $order_ids = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $order_ids[] = $row['order_id'];
        }
        if (count($order_ids) > 0) {
            $sql2 = "
                    SELECT *
                    FROM orders 
                    WHERE orders.order_id IN (" . implode(',', $order_ids) . ")
                ";
            $result2 = mysqli_query($conn, $sql2);
        } else {
            echo "<script>alert('Đơn hàng rỗng.! Bạn chưa mua đơn hàng nào');
						window.location.href = 'index.php';
						</script>";
        }
        ?>

        <div class="order-list">
            <?php
            $index = 0;
            while ($row = mysqli_fetch_assoc($result2)) {
                $index++;
                $ma = $row['order_id'];
                $ten = $row['recipient_name'];
                $diachi = $row['recipient_address'];
                $phone = $row['recipient_phone'];
                $Ngaytao = $row['order_date'];
                $status = $row['status'];
                $thoiGianDuKien = $row['delivery_time'];

                switch ($status) {
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
            ?>
                <div class='order-item'>
                    <div class='order-item-header'>
                        <h3>Tên Người Nhận: <?php echo $ten ?></h3>
                        <span class='order-status'><?php echo $statusDisplay ?></span>
                    </div>
                    <div class='order-item-details'>
                        <p><strong>Địa Chỉ:</strong> <?php echo $diachi ?></p>
                        <p><strong>Điện Thoại:</strong> <?php echo $phone ?></p>
                        <p><strong>Thời Gian Đặt:</strong> <?php echo $Ngaytao ?></p>
                        <p><strong>Thời Gian Giao Hàng Dự Kiến:</strong> <?php echo $thoiGianDuKien ?></p>
                    </div>
                    <div class='order-item-actions'>
                        <a href='./index.php?id=7&order_id=<?php echo $ma ?>' class='view-order'>Xem Đơn Hàng</a>
                        <?php
                        if ($status == "pending") {
                        ?>
                            <div>
                                <a href='./actions/handle_remove-order.php?iddh=<?php echo $ma ?>'>
                                    <button class='delete-order'>Hủy Đơn</button>
                                </a>
                            </div>
                        <?php
                        } else if ($status == "completed" || $status == "cancelled") {
                            echo "";
                        } else {
                            echo "<a>
                                    <button class='order-wait'>Đang trong quá trình</button>
                                </a>";
                        }
                        ?>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>