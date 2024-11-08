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
                    SELECT orders.order_id, orders.order_date, orders.status AS order_status, orders.total_price, 
                        accounts.full_name AS customer_name, accounts.address AS customer_address, accounts.email AS customer_email, 
                        accounts.phone_number AS customer_phone 
                    FROM orders 
                    JOIN accounts ON orders.account_id = accounts.account_id 
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
                $ten = $row['customer_name'];
                $diachi = $row['customer_address'];
                $email = $row['customer_email'];
                $phone = $row['customer_phone'];
                $Ngaytao = $row['order_date'];
                $status = $row['order_status'];

                $ngayTaoObj = new DateTime($Ngaytao);
                $ngayTaoObj->modify('+2 days');
                $ngayGiao = $ngayTaoObj->format('Y-m-d');

                echo "<div class='order-item'>
                    <div class='order-item-header'>
                        <h3>Tên Người Nhận: $ten</h3>
                        <span class='order-status'>$status</span>
                    </div>
                    <div class='order-item-details'>
                        <p><strong>Địa Chỉ:</strong> $diachi</p>
                        <p><strong>Điện Thoại:</strong> $phone</p>
                        <p><strong>Email:</strong> $email</p>
                        <p><strong>Thời Gian Đặt:</strong> $Ngaytao</p>
                        <p><strong>Thời Gian Giao:</strong> $ngayGiao</p>
                    </div>
                    <div class='order-item-actions'>
                        <a href='./index.php?id=7' class='view-order'>Xem Đơn Hàng</a>
                        <div>
                            <a href='./actions/handle_comfirm-order.php?iddh=$ma'>
                                <button class='comfirm-order'>Xác nhận</button>
                            </a>
                            <a href='./actions/handle_remove-order.php'?iddh=$ma'>
                                <button class='delete-order'>Hủy Đơn</button>
                            </a>
                        </div>
                    </div>
                </div>";
            }
            ?>
        </div>
    </div>
</section>