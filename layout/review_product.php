<link rel="stylesheet" href="./public/css/review_product.css">

<?php
include("./config/database.php");
$conn = getConnection();
if (isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];
    $sql = "SELECT * From `products` where product_id = $productId";
    $result = mysqli_query($conn, $sql);
    $product = mysqli_fetch_assoc($result);
    $imageUrl = './public/uploads/' . htmlspecialchars($product['default_image']);
}
?>
<?php
if (isset($_SESSION['user_id'])) {
?>
    <div class="review-container">
        <h2>Đánh Giá Sản Phẩm</h2>
        <div class="product-info">
            <img src="<?php echo $imageUrl ?>" alt="Tên Sản Phẩm" class="product-image">
            <h1 class="product-name"><?php echo $product['product_name'] ?></h1>
        </div>
        <div class="review-form">
            <form id="review-form" action="./actions/handle_review.php" method="post">
                <input type="hidden" name="product_id" value="<?php echo $product['product_id'] ?>">
                <div class="form-group">
                    <label for="rating" class="form-label">Lựa chọn:</label>
                    <div class="form-input">
                        <select id="rating" name="rating" required>
                            <option value="1">1 sao</option>
                            <option value="2">2 Sao</option>
                            <option value="3">3 Sao</option>
                            <option value="4">4 Sao</option>
                            <option value="5" selected>5 Sao</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="comment" class="form-label">Đánh giá:</label>
                    <div class="form-input">
                        <textarea id="comment" name="comment" rows="4" required></textarea>
                    </div>
                </div>
                <button type="submit" class="submit-button">Gửi Đánh Giá</button>
            </form>
        </div>
    </div>
<?php
} else {
    echo "<p style='text-align: center;'>Bạn hãy đăng nhập để đánh giá sản phẩm. <a href='login.php'>Đăng nhập</a></p>";
}
?>