<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand px-4 py-3 m-0" href="#" target="_blank">
            <img src="assets/img/logo-ct-dark.png" class="navbar-brand-img" width="26" height="26" alt="main_logo">
            <span class="ms-1 text-sm text-dark">Flower Shop</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        ?>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link <?php echo ($id == null) ? 'active bg-gradient-dark text-white' : 'text-dark' ?>" href="index.php">
                    <i class="material-symbols-rounded opacity-5">dashboard</i>
                    <span class="nav-link-text ms-2">Trang Chủ</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($id == 1 || $id == 2 || $id == 3) ? 'active bg-gradient-dark text-white' : 'text-dark' ?>" href="index.php?id=1">
                    <i class="material-symbols-rounded opacity-5">list</i>
                    <span class="nav-link-text ms-2">Quản Lí Danh Mục</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($id == 4 || $id == 5 || $id == 6) ? 'active bg-gradient-dark text-white' : 'text-dark' ?>" href="index.php?id=4">
                    <i class="material-symbols-rounded opacity-5">shop</i>
                    <span class="nav-link-text ms-2">Quản Lí Sản Phẩm</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($id == 7 || $id == 8 || $id == 9) ? 'active bg-gradient-dark text-white' : 'text-dark' ?>" href="index.php?id=7">
                    <i class="material-symbols-rounded opacity-5">settings</i>
                    <span class="nav-link-text ms-2">Quản Lí Tài Khoản</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($id == 10 || $id == 11) ? 'active bg-gradient-dark text-white' : 'text-dark' ?>" href="index.php?id=10">
                    <i class="material-symbols-rounded opacity-5">note</i>
                    <span class="nav-link-text ms-2">Quản Lí Đơn Hàng</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($id == 12) ? 'active bg-gradient-dark text-white' : 'text-dark' ?>" href="index.php?id=12">
                    <i class="material-symbols-rounded opacity-5">phone</i>
                    <span class="nav-link-text ms-2">Quản Lí Liên Hệ</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
        <div class="mx-3">
            <a class="btn bg-gradient-dark w-100" href="#" type="button">Đăng Xuất</a>
        </div>
    </div>
</aside>