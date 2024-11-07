<?php
include './functions/order_function.php';
$result = getAllOrders();
?>

<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-3 pb-3 d-flex gap-2 align-items-center">
                        <h6 class="text-white text-capitalize ps-3 mb-0">Quản Lí Đơn Hàng</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mã đơn hàng</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Họ Tên</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tổng Tiền</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Trạng Thái</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ngày Mua</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        switch ($row['status']) {
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
                                        <tr>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold"><?php echo $row['order_id'] ?></span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold"><?php echo $row['full_name'] ?></span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold"><?php echo $row['total_price'] ?></span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold"><?php echo $statusDisplay ?></span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold"><?php echo $row['order_date'] ?></span>
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="index.php?id=11&order_id=<?php echo $row['order_id'] ?>" class="badge badge-sm bg-gradient-success">
                                                        <i class="material-symbols-rounded text-sm">edit</i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                <?php
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