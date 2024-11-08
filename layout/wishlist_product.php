<link rel="stylesheet" href="./public/css/wishlist_product.css">
<div class="product-wishlist">
    <h1>Danh Sách Sản Phẩm Yêu Thích</h1>
    <div class="product-wishlist-list">
        <?php
        $accountId = $_SESSION['user_id'];
        require("./config/database.php");

        $conn = getConnection();
        $sql = "SELECT w.*, p.* FROM wishlists as w JOIN products as p ON w.product_id = p.product_id WHERE account_id = $accountId";
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
                include("./layout/component/product.php");
            }
        } else {
            echo "<p>Không có sản phẩm nào.</p>";
        }

        mysqli_close($conn);
        ?>
    </div>
</div>