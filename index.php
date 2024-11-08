<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flower_Shop</title>
    <link rel="stylesheet" href="./public/css/index.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php
    $defaultPage = './layout/home.php';
    $pages = [
        "1" => "./layout/detail_product.php",
        "2" => "./layout/shop.php",
        "3" => "./layout/contact.php",
        "4" => "./layout/account_info.php",
    ];
    $id = $_GET["id"] ?? null;
    $page = $pages[$id] ?? './layout/home.php';
    ?>
    <section class="main">
        <!-- Header -->
        <?php include("./layout/component/header.php"); ?>

        <!-- Sidebar và Wrapper -->
        <div class="section-content">
            <div class="container_sidebar">
                <?php if ($id !== "3" && $id !== "1") {
                    include("./layout/component/sidebar.php");
                } ?>

            </div>
            <div class="content">
                <?php include "$page"; ?>
            </div>
        </div>
        <div class="container_footer">
            <?php include("./layout/component/footer.php") ?>
        </div>
    </section>
</body>

</html>