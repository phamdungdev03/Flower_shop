<?php
include './functions/product_function.php';
$search = $_GET['search'] ?? null;
$result = getAllProducts($search);
?>

<nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <!-- Search -->
            <div
                class="input-group input-group-outline"
                style="max-width: 400px; margin: 0 auto;">
                <form
                    action="index.php"
                    method="GET"
                    style="display: flex; align-items: baseline; gap: 0.5rem;">
                    <input
                        type="hidden"
                        name="id"
                        value="4">
                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Tìm kiếm ở đây..."
                        value="<?php echo $_GET['search'] ?? ''; ?>"
                        style="flex: 1; border: 1px solid #ced4da; padding: 0.5rem 1rem;">
                    <button
                        type="submit"
                        class="btn btn-primary btn-sm"
                        style="padding: 0.5rem 1.5rem; background-color: #007bff; color: white; border: none; transition: background-color 0.3s ease;"
                        onmouseover="this.style.backgroundColor='#0056b3'"
                        onmouseout="this.style.backgroundColor='#007bff'">
                        Tìm kiếm
                    </button>
                </form>
            </div>

            <ul class="navbar-nav d-flex align-items-center  justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <?php
                    if (isset($_SESSION['username'])) {
                        $userName = $_SESSION['username'];
                    ?>
                        <div class="d-flex flex-column align-items-center">
                            <i class='material-symbols-rounded'>account_circle</i>
                            <span class='text-xs text-center text-uppercase font-weight-bolder'><?php echo $userName ?></span>
                        </div>
                    <?php
                    } else {
                        echo "<i class='material-symbols-rounded'>account_circle</i>";
                    }
                    ?>
                </li>
            </ul>
        </div>
    </div>
</nav>

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
                                    echo "<tr><td colspan='7' class='text-center text-xs font-weight-bold'>Không tìm thấy sản phẩm nào!</td></tr>";
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