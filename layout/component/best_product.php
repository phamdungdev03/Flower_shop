<link rel="stylesheet" href="./public/css/best_product.css">

<section class="best-products">
    <header class="best-products__header">
        <h2 class="best-products__title">Sản phẩm bán chạy</h2>
    </header>
    <div class="best-products__list">
        <?php
        require("./config/database.php");
        $conn = getConnection();
        $sql = "SELECT * FROM products WHERE is_best_seller = '1'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $product_id = $row["product_id"];
                $product_name = $row["product_name"];
                $product_image = $row["default_image"];
                $product_price = $row["product_price"];
                $product_sale = $row["sale_price"];
                $format_price = number_format($product_price, 0, ",", ".");
                include("{$base_path}/layout/component/product.php");
            }
        } else {
            echo "<p>Không có sản phẩm nào.</p>";
        }

        mysqli_close($conn);
        ?>
    </div>
</section>