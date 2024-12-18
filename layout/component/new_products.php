<link rel="stylesheet" href="./public/css/new_products.css">

<section class="new-products">
    <header class="new-products__header">
        <h2 class="new-products__title">Sản phẩm mới</h2>
    </header>
    <div class="new-products__list">
        <?php
        require("./config/database.php");
        $conn = getConnection();
        $sql = "SELECT * FROM products WHERE is_new = '1'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $product_id = $row["product_id"];
                $product_name = $row["product_name"];
                $product_image = $row["default_image"];
                $product_price = $row["product_price"];
                $product_sale = $row["sale_price"];
                $is_new = $row["is_new"];
                $is_best_seller = $row["is_best_seller"];
                $is_discount = $row["is_discount"];
                $format_price = number_format($product_price, 0, ",", ".");
                $product_price_sale = number_format($product_sale, 0, ",", ".");
                include(__DIR__ ."/product.php");
            }
        } else {
            echo "<p>Không có sản phẩm nào.</p>";
        }

        mysqli_close($conn);
        ?>
    </div>
</section>