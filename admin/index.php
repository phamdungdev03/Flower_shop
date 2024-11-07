<!DOCTYPE html>
<html lang="en">
<?php include './components/head.php' ?>

<body class="g-sidenav-show  bg-gray-100">
    <?php include './components/sidebar.php' ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <?php include './components/header.php' ?>
        <?php
        $defaultPage = 'home.php';
        $pages = [
            "1" => "./categories/index.php",
            "2" => "./categories/addCategory.php",
            "3" => "./categories/editCategory.php",
            "4" => "./products/index.php",
            "5" => "./products/createProduct.php",
            "6" => "./products/editProduct.php",
            "7" => "./accounts/index.php",
            "8" => "./accounts/createAccount.php",
            "9" => "./accounts/editAccount.php",
            "10" => "./order/index.php",
            "11" => "./order/editOrder.php",
            "12" => "./contacts/index.php",
        ];
        $id = $_GET["id"] ?? null;
        $page = $pages[$id] ?? 'home.php';
        ?>
        <div class="container-fluid py-2">
            <?php include $page ?>
            <?php include './components/footer.php' ?>
        </div>
    </main>
    <?php include './components/script.php' ?>
</body>

</html>