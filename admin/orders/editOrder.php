<?php
include './functions/order_function.php';

if (isset($_GET['order_id'])) {
    $orderId = $_GET['order_id'];
    $order = getOrderByOderId($orderId);
    $orderItems = getAllOrderItemByOrderId($orderId);
}
?>

<style>
    .disabled-btn {
        background-color: gray;
        font-weight: 600;
        pointer-events: none;
        opacity: 0.6;
        cursor: not-allowed;
    }

    .disabled-btn:hover {
        background-color: gray;
        color: #fff;
    }
</style>

<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-3 pb-3 d-flex gap-2 align-items-center">
                        <h6 class="text-white text-capitalize ps-3 mb-0">Cập Nhật Đơn Hàng</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <div class="card-body px-0 pb-2">
                            <div class="card-body">
                                <form action="./actions/order_action.php" method="post">
                                    <input type="hidden" name="action" value="editOrder">
                                    <div class="input-group input-group-outline mb-3 d-flex flex-column">
                                        <label class="font-weight-bold mb-2">Mã Đơn Hàng</label>
                                        <input type="text" class="form-control w-100" id="order_id" name="order_id" value="<?php echo $order['order_id'] ?>" readonly>
                                    </div>
                                    <div class="input-group input-group-outline mb-3 d-flex flex-column">
                                        <label class="font-weight-bold mb-2">Người Mua Hàng</label>
                                        <input type="text" class="form-control w-100" id="full_name" name="full_name" value="<?php echo $order['full_name'] ?>" readonly>
                                    </div>
                                    <div class="input-group input-group-outline mb-3 d-flex flex-column">
                                        <label class="font-weight-bold mb-2">Tổng Tiền</label>
                                        <input type="text" class="form-control w-100" id="total_price" name="total_price" value="<?php echo $order['total_price'] ?>" readonly>
                                    </div>
                                    <div class="input-group input-group-outline mb-3 d-flex flex-column">
                                        <label class="font-weight-bold mb-2">Ngày Đặt</label>
                                        <input type="text" class="form-control w-100" id="order_date" name="order_date" value="<?php echo $order['order_date'] ?>" required>
                                    </div>
                                    <div class="input-group input-group-outline mb-3">
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="pending" <?php echo ($order['status'] == 'pending') ? 'selected' : ''; ?>>Chờ Xác Nhận</option>
                                            <option value="processed" <?php echo ($order['status'] == 'processed') ? 'selected' : ''; ?>>Đã Xác Nhận</option>
                                            <option value="shipping" <?php echo ($order['status'] == 'shipping') ? 'selected' : ''; ?>>Đang Vận Chuyển</option>
                                            <option value="completed" <?php echo ($order['status'] == 'completed') ? 'selected' : ''; ?>>Hoàn Thành</option>
                                            <option value="cancelled" <?php echo ($order['status'] == 'cancelled') ? 'selected' : ''; ?>>Đã Hủy</option>
                                        </select>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-dark btn-lg w-100 mt-4 mb-0 <?php echo (($order['status'] == 'completed') || ($order['status'] == 'cancelled')) ? 'disabled-btn' : ''; ?>">Cập Nhật Đơn Hàng</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="mt-4 text-center text-md font-weight-bold text-dark">Danh Sách Sản Phẩm</div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder ">STT</th>
                                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Sản Phẩm</th>
                                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Hình ảnh</th>
                                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Số lượng</th>
                                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Giá</th>
                                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Thành Tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($orderItems->num_rows > 0) {
                                            $index = 1;
                                            $total = 0;
                                            while ($row = $orderItems->fetch_assoc()) {
                                                $total = $row['quantity'] * $row['price'];
                                                $imageUrl = '../public/uploads/' . htmlspecialchars($row['default_image']);
                                        ?>
                                                <tr>
                                                    <td class="align-middle text-center">
                                                        <span class="text-secondary text-xs font-weight-bold"><?php echo $index ?></span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span class="text-secondary text-xs font-weight-bold"><?php echo $row['product_name'] ?></span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <img src="<?php echo $imageUrl ?>" style="width: 70px; height: 70px; border-radius: 20px;" alt="">
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span class="text-secondary text-xs font-weight-bold"><?php echo $row['quantity'] ?></span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span class="text-secondary text-xs font-weight-bold"><?php echo $row['price'] ?></span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span class="text-secondary text-xs font-weight-bold"><?php echo $total ?></span>
                                                    </td>
                                                </tr>
                                        <?php
                                                $index++;
                                            }
                                        } else {
                                            echo "<tr><td class='text-xs text-center font-weight-bold'>Chưa có bản ghi nào!</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>