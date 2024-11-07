<link rel="stylesheet" href="./public/css/home.css">

<section class="home-products">
    <div class="banner">
        <img src="./public/img/daisy-img-01.jpg" alt="">
    </div>
    <div class="product-list">
        <?php
        include("./layout/component/new_products.php");
        include("./layout/component/best_product.php");
        include("./layout/component/discount_products.php");
        ?>
    </div>
</section>