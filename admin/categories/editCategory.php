<?php
include './functions/category_function.php';
if (isset($_GET['category_id'])) {
    $categoryId = $_GET['category_id'];
    $category = getCategoryById($categoryId);
}
?>

<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-3 pb-3 d-flex gap-2 align-items-center">
                        <h6 class="text-white text-capitalize ps-3 mb-0">Cập Nhật Danh Mục</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="card-body">
                        <form action="./actions/category_action.php" method="post">
                            <input type="hidden" name="action" value="editCategory">
                            <div class="input-group input-group-outline mb-3 d-flex flex-column">
                                <label class="font-weight-bold mb-2">Mã Danh Mục</label>
                                <input type="text" class="form-control w-100" id="category_id" name="category_id" value="<?php echo $category['category_id'] ?>" readonly>
                            </div>
                            <div class="input-group input-group-outline mb-3 d-flex flex-column">
                                <label class="font-weight-bold mb-2">Tên Danh Mục</label>
                                <input type="text" class="form-control w-100" id="category_name" name="category_name" value="<?php echo $category['category_name'] ?>" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-dark btn-lg w-20 mt-4 mb-0">Cập Nhật Danh Mục</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>