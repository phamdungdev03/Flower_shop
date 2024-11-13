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
                            <li><a href='./index.php?id=6'>Đơn hàng</a></li>
                            <li><a href='./actions/handle_logout.php'>Đăng xuất</a></li>
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
            <div class="info-item cart_link">
                <div class="info_item-icon">
                    <i class="fa-solid fa-heart"></i>
                </div>
                <div class="box_info-span">
                    <span class="ingo-title" onclick="window.location.href='./index.php?id=9'">Yêu Thích</span>
                </div>
            </div>
            <div class="info-item cart_link">
                <div class="info_item-icon">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
                <div class="box_info-span">
                    <span class="ingo-title" onclick="window.location.href='./index.php?id=5'">Giỏ hàng</span>
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
        <section class="box_header-bottom">
            <div class="header-bottom">
                <ul>
                    <li><a href="<?php echo $base_url; ?>/index.php">Trang chủ</a></li>
                    <li><a href="<?php echo $base_url; ?>/index.php">Giới thiệu</a></li>
                    <li><a href="<?php echo $base_url; ?>/index.php?id=2">Sản phẩm</a></li>
                    <li><a href="<?php echo $base_url; ?>/index.php?id=3">Liên hệ</a></li>
                    <li><a href="<?php echo $base_url; ?>/index.php?">Tin tức</a></li>
                </ul>
            </div>

            <div class="header__search-bar">
                <?php
                include './config/database.php';
                $conn = getConnection();

                if (isset($_GET["s1"]) && !empty($_GET["s1"])) {
                    $key = mysqli_real_escape_string($conn, trim($_GET["s1"]));
                    $sql = "SELECT product_id, product_name, default_image, product_price 
                    FROM products 
                    WHERE (product_id LIKE '%$key%') 
                        OR (product_name LIKE '%$key%') 
                        OR (default_image LIKE '%$key%') 
                        OR (product_price LIKE '%$key%');";

                    $result = mysqli_query($conn, $sql);
                } else {
                    $sql = "SELECT * FROM products ORDER BY product_price DESC LIMIT 4;";
                    $result = mysqli_query($conn, $sql);
                }
                ?>
                <div id="modal-search" class='modal-search'>
                    <div id="background-close" class='search-background'></div>
                    <div class='modal-search-container'>
                        <div class='search-container-wrapper'>
                            <div class='modal-search-title'>
                                <span>Sản phẩm gợi ý</span>
                            </div>
                            <div class='modal-search-list'>
                                <?php
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $product_id = $row['product_id'];
                                        $product_name = $row['product_name'];
                                        $product_image = $row['default_image'];
                                        $price = number_format($row['product_price'], 0, ',', '.') . 'đ';
                                        echo "<a href='chitietsanpham.php?product_id=$product_id' class='search-item'>
                                    <img src='./public/uploads/$product_image' alt='$product_name' />
                                    <div class='search-item-info'>
                                        <p class='search-item-info__name'>$product_name</p>
                                        <div class='search-item-info__price'>
                                            <p class='search-item-price__new'>$price</p>
                                        </div>
                                    </div>
                                </a>";
                                    }
                                } else {
                                    echo "<div class='search-no-product'>
                                        <img src='https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg/search/a60759ad1dabe909c46a.png' alt='' />
                                        <p>Chưa có kết quả tìm kiếm nào.</p>
                                        <span>Vui lòng sử dụng những từ khóa chung.</span>
                                      </div>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <form id="searchForm" method="get" class="search-container">
                    <input id="s1" class="search-input" type="text" name="s1" placeholder="Bạn cần tìm gì ..." value="<?php if (isset($_GET["s1"])) {
                                                                                                                            echo trim($_GET["s1"]);
                                                                                                                        }
                                                                                                                        ?>" />
                    <button type="submit" class="search-button">
                        <i class="fa-duotone fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>
        </section>
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