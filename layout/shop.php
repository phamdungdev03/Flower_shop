<?php
include './config/database.php';
$conn = getConnection();
if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
} else {
    $sql = "SELECT * FROM categories LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $first_category = $result->fetch_assoc();
        $category_id = $first_category['category_id'];
    } else {
        $category_id = null;
    }
}
if ($category_id === null) {
    exit();
} else {
    $sql1 = "SELECT COUNT(*) as total_products FROM products WHERE category_id = $category_id";
    $result1 = mysqli_query($conn, $sql1);
    if ($result1) {
        $row = mysqli_fetch_assoc($result1);
        $total_products = $row['total_products'];
    }
}
?>
<section style="display: flex; justify-content: space-between; ">
    <?php
    $sql = "SELECT * FROM products WHERE category_id = $category_id";
    $conn = getConnection();
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
            require("./layout/component/product.php");
        }
    } else {
        echo "<p>Không có sản phẩm nào.</p>";
    }
    ?>
</section>