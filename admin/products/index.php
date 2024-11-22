<?php
include './functions/product_function.php';
$result = getAllProducts();
?>

<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-3 pb-3 d-flex gap-2 align-items-center">
                        <h6 class="text-white text-capitalize ps-3 mb-0">Quản Lí Sản Phẩm</h6>
                        <a href="index.php?id=5" class="badge badge-sm bg-gradient-success text-center">
                            <i class="material-symbols-rounded text-sm">add</i>
                        </a>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mã sản phẩm</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tên sản phẩm</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hình ảnh</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Số lượng</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Giá</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Thể loại</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $imageUrl = '../public/uploads/' . htmlspecialchars($row['default_image']);
                                        $format_price = number_format($row['sale_price'], 0, ",", ".");
                                ?>
                                        <tr>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold"><?php echo $row['product_id'] ?></span>
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
                                                <span class="text-secondary text-xs font-weight-bold"><?php echo $format_price ?>đ</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold"><?php echo $row['category_name'] ?></span>
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="index.php?id=6&product_id=<?php echo $row['product_id'] ?>" class="badge badge-sm bg-gradient-success">
                                                        <i class="material-symbols-rounded text-sm">edit</i>
                                                    </a>
                                                    <a href="./actions/product_action.php?product_id=<?php echo $row['product_id'] ?>" class="badge badge-sm bg-gradient-danger text-center" onclick="confirmDelete(event, this.href);">
                                                        <i class="material-symbols-rounded text-sm">delete</i>
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

<script>
    function confirmDelete(event, url) {
        event.preventDefault();
        if (confirm("Bạn có chắc chắn muốn xóa sản phẩm này không?")) {
            window.location.href = url;
        }
    }
</script>