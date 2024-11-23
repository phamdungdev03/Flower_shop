<?php
include './functions/dashboard_function.php';

$moneyToday = getTodayMoney();
$usersToday = getTodayUsers();
$totalSales = getTotalSales();
$total_products = getTotalProducts();
?>

<nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">

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

<div class="row">
    <!-- Today's Money -->
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-2 ps-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-sm mb-0 text-capitalize">Tổng tiền ngày hôm nay</p>
                        <h4 class="mb-0"><?= number_format($moneyToday, 0) ?> VNĐ</h4>
                    </div>
                    <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                        <i class="material-symbols-rounded opacity-10">weekend</i>
                    </div>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-2 ps-3">
                <p class="mb-0 text-sm"><span class="text-success font-weight-bolder"></span>Tổng doanh thu hôm nay</p>
            </div>
        </div>
    </div>

    <!-- Today's Users -->
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-2 ps-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-sm mb-0 text-capitalize">Tài khoản</p>
                        <h4 class="mb-0"><?= $usersToday ?></h4>
                    </div>
                    <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                        <i class="material-symbols-rounded opacity-10">person</i>
                    </div>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-2 ps-3">
                <p class="mb-0 text-sm"><span class="text-success font-weight-bolder"></span>Tổng số tài khoản người dùng</p>
            </div>
        </div>
    </div>

    <!-- Ads Views -->
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-2 ps-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-sm mb-0 text-capitalize">Số sản phẩm</p>
                        <h4 class="mb-0"><?= number_format($total_products) ?></h4>
                    </div>
                    <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                        <i class="material-symbols-rounded opacity-10">leaderboard</i>
                    </div>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-2 ps-3">
                <p class="mb-0 text-sm"><span class="text-danger font-weight-bolder"></span>Tổng số sản phẩm trong shop</p>
            </div>
        </div>
    </div>

    <!-- Total Sales -->
    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-header p-2 ps-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-sm mb-0 text-capitalize">Tổng tiền</p>
                        <h4 class="mb-0"><?= number_format($totalSales) ?> VNĐ</h4>
                    </div>
                    <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                        <i class="material-symbols-rounded opacity-10">weekend</i>
                    </div>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-2 ps-3">
                <p class="mb-0 text-sm"><span class="text-success font-weight-bolder"></span>Tổng doanh thu của shop</p>
            </div>
        </div>
    </div>
</div>