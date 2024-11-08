<link rel="stylesheet" href="./public/css/product.css">
<div onclick="window.location.href='./index.php?id=1&product_id=<?php echo $product_id; ?>'" class="new-product">
    <img src="./public/uploads/<?php echo $product_image; ?>" alt="Product 1" class="new-product__image">
    <h3 class="new-product__name"><?php echo $product_name ?></h3>
    <p class="new-product__price"><?php echo $format_price ?> đ</p>
</div>