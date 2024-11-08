<link rel="stylesheet" href="./public/css/detail_product.css">

<?php
include("./config/database.php");

$product_id = $_GET["product_id"];
$sql = "SELECT * From `products` where product_id = $product_id";
$conn = getConnection();
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $product_id = $row["product_id"];
    $product_name = $row["product_name"];
    $default_image = $row["default_image"];
    $product_price = $row["product_price"];
    $product_sale = $row["sale_price"];
    $product_detail = $row["product_detail"];
    $format_price = number_format($product_price, 0, ",", ",");
    $format_price_sale = number_format($product_sale, 0, ",", ",");
    $category_id = $row['category_id'];
}
if ($category_id) {
    $sql1 = "SELECT * From categories where category_id = $category_id";
    $result1 = mysqli_query($conn, $sql1);
    while ($row = mysqli_fetch_assoc($result1)) {
        $category_name = $row['category_name'];
    }
}
?>

<section class="product-detail">
    <div class="breadcrumb">
        <span>Trang chủ / Chi tiết sản phẩm</span>
    </div>

    <div class="product-detail__main">
        <div class="product-detail__image">
            <img src="./public/uploads/<?php echo $default_image ?>" alt="Tên sản phẩm">
        </div>
        <form method="POST" action="index.php?id=5&action=add" class="product-detail__info">
            <h1 class="product-detail__name"><?php echo $product_name ?></h1>
            <div class="product-detail__price">
                <span class="original-price"><?php echo $format_price ?>đ</span>
                <span class="discounted-price"><?php echo $format_price_sale ?>đ</span>
            </div>
            <div class="detail-info-category">
                <span>Loại hoa:
                    <a href="./index.php?id=2&category_id=<?php echo $category_id ?>"><?php echo $category_name ?></a>
                </span>
            </div>
            <div class="quantity-selector">
                <span class="btn_count" id="decrease-btn">-</span>
                <input type="number" id="quantity-input" value="1" min="1" name="quantity[<?php echo $product_id ?>]">
                <span class="btn_count" id="increase-btn">+</span>
            </div>
            <p class="product-detail__description"><?php echo $product_detail ?></p>
            <p>Hoa giao nhanh 60 phút Hà nội</p>
            <div class="product-detail__note">
                <h2>Lưu ý</h2>
                <span>Sản phẩm bạn đang chọn là sản phẩm được thiết kế đặc biệt!</span>
                <span>Hiện nay, Hoayeuthuong.com chỉ thử nghiệm cung cấp cho thị trường Tp. Hồ Chí Minh và Hà Nội</span>
            </div>

            <div class="area_order">
                <input type="submit" onclick="addToCart()" value="Thêm Giỏ Hàng" class="btn_add-cart" />
                <input type="submit" id="add-to-cart-btn" onclick="addToCart()" value="Mua ngay" class="btn_add-cart" />
            </div>

            <div class="endow">
                <h2>Ưu đãi đặc biệt</h2>
                <ul>
                    <li>Tặng banner hoặc thiệp (trị giá 20.000đ - 50.000đ) miễn phí</li>
                    <li>Giảm tiếp 3% cho đơn hàng Bạn tạo ONLINE lần thứ 2, 5% cho đơn hàng Bạn tạo ONLINE lần thứ 6 và 10% cho đơn hàng Bạn tạo ONLINE lần thứ 12.</li>
                    <li>Miễn phí giao khu vực nội thành (chi tiết)</li>
                    <li>Giao gấp trong vòng 2 giờ</li>
                    <li>Cam kết 100% hoàn lại tiền nếu Bạn không hài lòng</li>
                    <li>Cam kết hoa tươi trên 3 ngày</li>
                </ul>
            </div>
        </form>
    </div>

    <div class="product-detail__related">
        <h2 class="related-title">Sản Phẩm Liên Quan</h2>
        <?php
        $conn = getConnection();
        $sql = "SELECT * From products WHERE category_id = $category_id AND product_id != $product_id";
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
</section>
<script>
    function addToCart() {
        <?php
        if (isset($_SESSION['username'])) {
            echo "alert('Thêm vào giỏ hàng thành công!');";
        } else {
            echo "alert('Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng!');";
        }
        ?>
    }
    var prev = document.getElementById("decrease-btn");
    var add = document.getElementById("increase-btn");
    var quantity = document.getElementById("quantity-input");

    prev.onclick = () => {
        var currentValue = parseInt(quantity.value);
        if (currentValue > 1) {
            quantity.value = currentValue - 1;
        }
    }

    add.onclick = () => {
        var currentValue = parseInt(quantity.value);
        quantity.value = currentValue + 1;
    }
</script>