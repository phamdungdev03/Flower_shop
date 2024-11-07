<?php
include './functions/category_function.php';
$result = getAllCategories();
?>

<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-3 pb-3 d-flex gap-2 align-items-center">
                        <h6 class="text-white text-capitalize ps-3 mb-0">Thêm Mới Sản Phẩm</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="card-body">
                        <form action="./actions/product_action.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="action" value="addProduct">
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Tên sản phẩm</label>
                                <input type="text" class="form-control" id="product_name" name="product_name" required>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Số lượng</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" required>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Giá</label>
                                <input type="number" class="form-control" id="product_price" name="product_price" required>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Giá giảm</label>
                                <input type="number" class="form-control" id="sale_price" name="sale_price" required>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <select class="form-control text-base" id="category" name="category_id" required>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option class='text-base' value='{$row['category_id']}'>{$row['category_name']}</option>";
                                        }
                                    } else {
                                        echo "<option value=''>Không có thể loại nào</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div id="imagePreviewContainer" style="margin-top: 20px;">
                                <img id="imagePreview" src="" alt="Image Preview" style="width: 50px; height: 50px; border-radius: 20px; margin-bottom: 10px; display: none;">
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <input type="file" class="form-control" id="image" name="image" onchange="previewImage(event)" required>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <textarea class="form-control" id="product_detail" name="product_detail" placeholder="Nhập mô tả" required></textarea>
                            </div>
                            <div class="d-flex gap-5">
                                <div class="form-check form-check-info text-start ps-0">
                                    <input class="form-check-input" type="checkbox" value="" id="is_new" name="is_new" checked>
                                    <label class="form-check-label" for="is_new">
                                        Sản phẩm mới
                                    </label>
                                </div>
                                <div class="form-check form-check-info text-start ps-0">
                                    <input class="form-check-input" type="checkbox" value="" id="is_best_seller" name="is_best_seller">
                                    <label class="form-check-label" for="is_best_seller">
                                        Sản phẩm bán chạy
                                    </label>
                                </div>
                                <div class="form-check form-check-info text-start ps-0">
                                    <input class="form-check-input" type="checkbox" value="" id="is_discount" name="is_discount">
                                    <label class="form-check-label" for="is_discount">
                                        Sản phẩm giảm giá
                                    </label>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-dark btn-lg w-20 mt-4 mb-0">Thêm Sản Phẩm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        const imagePreview = document.getElementById('imagePreview');
        imagePreview.src = URL.createObjectURL(event.target.files[0]);
        imagePreview.style.display = 'block';
    }
</script>