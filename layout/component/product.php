<link rel="stylesheet" href="./public/css/product.css">

<div onclick="window.location.href='./index.php?id=1&product_id=<?php echo $product_id; ?>'" class="new-product">
    <?php
    echo ($is_new == 1 ? "<div class='new-product__label new'>New</div>" : "") .
        ($is_best_seller == 1 ? "<div class='new-product__label hot'>Hot</div>" : "") .
        ($is_discount == 1 ? "<div class='new-product__label sale'>Sale</div>" : "");

    if (isset($_SESSION['user_id'])) {
        $accountId = $_SESSION['user_id'];
        require("./config/database.php");

        $conn = getConnection();
        $sql1 = "SELECT * FROM wishlists WHERE account_id = $accountId";
        $wishlists = mysqli_query($conn, $sql1);
        $wishlist = [];
        while ($row = mysqli_fetch_assoc($wishlists)) {
            $wishlist[] = $row['product_id'];
        }
        $isInWishlist = in_array($product_id, $wishlist);
    }
    ?>


    <img src="./public/uploads/<?php echo $product_image; ?>" alt="Product 1" class="new-product__image">
    <h3 class="new-product__name"><?php echo $product_name; ?></h3>

    <div class="new-product__price">
        <?php
        if ($product_price != $product_sale) {
            echo "<span class='original-price'> $format_price đ</span>
                <span class='sale-price'> $product_price_sale đ</span>";
        } else {
            echo " <span class='sale-price'> $product_price_sale; đ</span>";
        }
        ?>
    </div>
    <a href="./actions/handle_wishlist.php?product_id=<?php echo $product_id ?>" class="wishlist-link <?php echo $isInWishlist ? 'wishlist-active' : ''; ?>">
        <i class="fa-solid fa-heart"></i>
    </a>
</div>