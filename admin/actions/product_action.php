<?php
include('../functions/product_function.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
    switch ($action) {
        case 'addProduct':
            $productName = $_POST['product_name'];
            $productDetail = $_POST['product_detail'];
            $price = $_POST['product_price'];
            $salePrice = $_POST['sale_price'];
            $quantity = $_POST['quantity'];
            $categoryId = $_POST['category_id'];
            $isNew = isset($_POST['is_new']) ? '1' : '0';
            $isBestSeller = isset($_POST['is_best_seller']) ? '1' : '0';
            $isDiscount= isset($_POST['is_discount']) ? '1' : '0';

            $image = $_FILES['image'];
            $targetDir = '../../public/uploads/';
            $timestamp = time();
            $imageName = $timestamp . '_' . basename($image['name']);
            $targetFilePath = $targetDir . $imageName;

            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0755, true);
            }

            if (!move_uploaded_file($image['tmp_name'], $targetFilePath)) {
                echo "Lỗi khi tải lên ảnh.";
            }

            if (addProduct($productName, $productDetail, $price, $quantity, $salePrice, $imageName, $categoryId, $isNew, $isBestSeller, $isDiscount)) {
                echo "Thêm sản phẩm thành công!";
                header("Location: ../index.php?id=4");
                exit();
            } else {
                echo "Lỗi khi thêm sản phẩm";
            }

            break;
        case 'editProduct':
            $productId = $_POST['product_id'];
            $productName = $_POST['product_name'];
            $productDetail = $_POST['product_detail'];
            $price = $_POST['product_price'];
            $salePrice = $_POST['sale_price'];
            $quantity = $_POST['quantity'];
            $categoryId = $_POST['category_id'];
            $isNew = isset($_POST['is_new']) ? '1' : '0';
            $isBestSeller = isset($_POST['is_best_seller']) ? '1' : '0';
            $isDiscount= isset($_POST['is_discount']) ? '1' : '0';

            $image = $_FILES['image'];
            $existingImage = $_POST['existing_image'];

            $targetDir = '../../public/uploads/';
            $newImageName = "";
            if ($image && !empty($image['name'])) {
                $timestamp = time();
                $imageName = $timestamp . '_' . basename($image['name']);
                $targetFilePath = $targetDir . $imageName;

                if (!file_exists($targetDir)) {
                    mkdir($targetDir, 0755, true);
                }

                if (!empty($existingImage) && file_exists($targetDir . $existingImage)) {
                    unlink($targetDir . $existingImage);
                }

                if (move_uploaded_file($image['tmp_name'], $targetFilePath)) {
                    $newImageName = $imageName;
                }
            } else {
                $newImageName = $existingImage;
            }

            if (editProduct($productId, $productName, $productDetail, $price, $quantity, $salePrice, $newImageName, $categoryId, $isNew, $isBestSeller, $isDiscount)) {
                echo "Cập nhật sản phẩm thành công!";
                header("Location: ../index.php?id=4");
                exit();
            } else {
                echo "Lỗi khi cập nhật sản phẩm";
            }
            break;
        default:
            break;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['product_id'])) {
        $productId = $_GET['product_id'];
        $product = getProductById($productId);
        if ($product) {
            $imageName = $product['image_url'];
            if (deleteProduct($productId)) {
                $targetFilePath = '../../public/uploads/' . $imageName;
                if (file_exists($targetFilePath)) {
                    unlink($targetFilePath);
                }
                header("Location: ../index.php?id=4");
                exit();
            } else {
                echo "<script>
                        alert('Bạn không thể xóa sản phẩm này vì liên quan đến dữ liệu hệ thống!');
                        window.location.href = '../index.php?id=4';
                      </script>";
                exit();
            }
        }
    }
}
