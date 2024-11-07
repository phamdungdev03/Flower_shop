<?php
include('../functions/category_function.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
    switch ($action) {
        case 'addCategory':
            $categoryName = $_POST['category_name'];
            if (addCategory($categoryName)) {
                echo "Thêm danh mục thành công!";
                header("location: ../index.php?id=1");
            } else {
                echo "Lỗi khi thêm";
            }

            break;
        case 'editCategory':
            $categoryId = $_POST['category_id'];
            $categoryName = $_POST['category_name'];
            if (editCategory($categoryId, $categoryName)) {
                echo "Cập nhật danh mục thành công!";
                header("location: ../index.php?id=1");
            } else {
                echo "Lỗi khi cập nhật";
            }
            break;
        default:
            break;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['category_id'])) {
        $categoryId = $_GET['category_id'];
        if (deleteCategory($categoryId)) {
            header("Location: ../index.php?id=1");
        } else {
            echo "<script>
                        alert('Lỗi khi xóa thể loại!');
                        window.location.href = '../index.php?id=1';
                      </script>";
            exit();
        }
    }
}
