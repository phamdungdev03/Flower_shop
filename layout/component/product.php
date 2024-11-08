<link rel="stylesheet" href="./public/css/product.css">

<div onclick="window.location.href='./index.php?id=1&product_id=<?php echo $product_id; ?>'" class="new-product">
    <?php
    echo ($is_new == 1 ? "<div class='new-product__label new'>New</div>" : "") .
        ($is_best_seller == 1 ? "<div class='new-product__label hot'>Hot</div>" : "") .
        ($is_discount == 1 ? "<div class='new-product__label sale'>Sale</div>" : "");
    ?>


    <img src="./public/uploads/<?php echo $product_image; ?>" alt="Product 1" class="new-product__image">
    <h3 class="new-product__name"><?php echo $product_name; ?></h3>

    <div class="new-product__price">
        <span class="original-price"><?php echo $format_price; ?> đ</span>
        <span class="sale-price"><?php echo $product_price_sale; ?> đ</span>
    </div>
</div>