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
                $product_id = $row["product_id"];
                $product_name = $row["product_name"];
                $product_image = $row["default_image"];
                $product_price = $row["sale_price"];
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