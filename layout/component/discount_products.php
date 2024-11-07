<link rel="stylesheet" href="./public/css/discount_products.css">

<section class="discount-products">
    <header class="discount-products__header">
        <h2 class="discount-products__title">Sản phẩm giảm giá</h2>
    </header>
    <div class="discount-products__list">
        <?php
        require("./config/database.php");
        $conn = getConnection();
        $sql = "SELECT * FROM products WHERE is_discount = '1'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $ma = $row["product_id"];
                $ten = $row["product_name"];
                $anh = $row["default_image"];
                $gia = $row["sale_price"];
                $parsed_gia = number_format($gia, 0, ",", ".");
                include("{$base_path}/layout/component/product.php");
            }
        } else {
            echo "<p>Không có sản phẩm nào.</p>";
        }

        mysqli_close($conn);
        ?>
    </div>
</section>