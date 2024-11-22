<?php
session_start();

if(isset($_SESSION['username'])){
    if (!isset($_SESSION['role_name']) || $_SESSION['role_name'] != 1) {
        echo "<script>alert('Xin lỗi bạn! Bạn không phải là QTV!');
              window.location.href = '../index.php';</script>";
    }
}else{
    echo "<script>alert('Bạn chưa đăng nhập vào hệ thống!');
              window.location.href = '../login.php';</script>";
}
?>

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
            "5" => "./products/addProduct.php",
            "6" => "./products/editProduct.php",
            "7" => "./accounts/index.php",
            "8" => "./accounts/addAccount.php",
            "9" => "./accounts/editAccount.php",
            "10" => "./orders/index.php",
            "11" => "./orders/editOrder.php",
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