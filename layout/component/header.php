<link rel="stylesheet" href="./public/css/header.css">

<header class="header">
    <div class="container_header-top">
        <div class="header-top">
            <h2 class="header_top-title">Hotline: 0352718888 | Email: shop@gmail.com</h2>
            <ul class="top-menu">
                <?php
                session_start();
                if (isset($_SESSION['username'])) {
                    echo "
                            <li><a href='./index.php?id=4' class='name_user'>{$_SESSION['username']}</a></li>
                            <li><a href='#'>Chính sách bảo mật</a></li>
                            <li><a href='#'>Đơn hàng</a></li>
                            <li><a href='./login.php'>Đăng xuất</a></li>
                        ";
                } else {
                    echo " 
                            <li><a href='./index.php?id=4'>Tài khoản</a></li>
                            <li><a href='#'>Chính sách bảo mật</a></li>
                            <li><a href='./login.php'>Đăng nhập</a></li>
                        ";
                }
                ?>
            </ul>
        </div>
    </div>
    <?php
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $host = $_SERVER['HTTP_HOST'];
    $scriptName = $_SERVER['SCRIPT_NAME'];
    $path = str_replace(basename($scriptName), '', $scriptName);

    $base_url = $protocol . $host . $path;
    $base_url = rtrim($base_url, '/');
    ?>

    <!-- Content Section -->
    <div class="header-content">
        <div class="logo">
            <img src="./public/img/logo-shop.png" alt="Logo">
        </div>

        <div class="header-info">
            <div class="info-item">
                <div class="info_item-icon">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
                <div class="box_info-span">
                    <span class="ingo-title">Giỏ hàng</span>
                </div>
            </div>
            <div class="info-item">
                <div class="info_item-icon">
                    <i class="fa-solid fa-phone"></i>
                </div>
                <div class="box_info-span">
                    <span class="info-title">035278888</span>
                    <span class="info-text">Hotline mua hàng</span>
                </div>
            </div>
            <div class="info-item">
                <div class="info_item-icon">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <div class="box_info-span">
                    <span class="info-title">Thời gian làm việc</span>
                    <span class="info-text">Mở cửa 0:00 - 22:00</span>
                </div>
            </div>
        </div>
    </div>
    <div class="container_header-bottom">
        <div class="header-bottom">
            <ul>
                <li><a href="<?php echo $base_url; ?>/index.php">Trang chủ</a></li>
                <li><a href="<?php echo $base_url; ?>/index.php">Giới thiệu</a></li>
                <li><a href="<?php echo $base_url; ?>/index.php?id=2">Sản phẩm</a></li>
                <li><a href="<?php echo $base_url; ?>/index.php?id=3">Liên hệ</a></li>
                <li><a href="<?php echo $base_url; ?>/index.php?">Tin tức</a></li>
            </ul>
        </div>
    </div>
</header>

<script>
    var search = document.getElementById('s1');
    var modal = document.getElementById('modal-search');
    var background = document.getElementById('background-close');

    search.addEventListener('click', function(event) {
        event.stopPropagation();
        modal.style.display = 'block';
    });

    background.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    document.addEventListener('click', function(event) {
        if (!modal.contains(event.target) && event.target !== search) {
            modal.style.display = 'none';
        }
    });

    window.addEventListener('load', () => {
        const currentPath = window.location.pathname;
        const currentUrl = window.location.href;
        const isCartPage = currentPath.includes('/page/cart.php');
        const isEditAction = currentUrl.includes('action=edit');
        if (!(isCartPage && !isEditAction)) {
            localStorage.removeItem('selectedCartIds');
        }
    });
</script>