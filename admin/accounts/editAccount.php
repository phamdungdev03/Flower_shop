<?php
include './functions/account_function.php';

if (isset($_GET['account_id'])) {
    $accountId = $_GET['account_id'];
    $user = getUserById($accountId);
}

?>

<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-3 pb-3 d-flex gap-2 align-items-center">
                        <h6 class="text-white text-capitalize ps-3 mb-0">Cập Nhật Sản Phẩm</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="card-body">
                        <form action="./actions/account_action.php" method="post">
                            <input type="hidden" name="action" value="editAccount">
                            <div class="input-group input-group-outline mb-3 d-flex flex-column">
                                <label class="font-weight-bold mb-2">Mã Tài Khoản</label>
                                <input type="text" class="form-control w-100" id="account_id" name="account_id" value="<?php echo $user['account_id'] ?>" readonly>
                            </div>
                            <div class="input-group input-group-outline mb-3 d-flex flex-column">
                                <label class="font-weight-bold mb-2">Tên đăng nhập</label>
                                <input type="text" class="form-control w-100" id="user_name" name="user_name" value="<?php echo $user['user_name'] ?>" readonly>
                            </div>
                            <div class="input-group input-group-outline mb-3 d-flex flex-column">
                                <label class="font-weight-bold mb-2">Họ Và Tên</label>
                                <input type="text" class="form-control w-100" id="full_name" name="full_name" value="<?php echo $user['full_name'] ?>" required>
                            </div>
                            <div class="input-group input-group-outline mb-3 d-flex flex-column">
                                <label class="font-weight-bold mb-2">Email</label>
                                <input type="text" class="form-control w-100" id="email" name="email" value="<?php echo $user['email'] ?>" required>
                            </div>
                            <div class="input-group input-group-outline mb-3 d-flex flex-column">
                                <label class="font-weight-bold mb-2">Số điên thoại</label>
                                <input type="text" class="form-control w-100" id="phone_number" name="phone_number" value="<?php echo $user['phone_number'] ?>" required>
                            </div>
                            <div class="input-group input-group-outline mb-3 d-flex flex-column">
                                <label class="font-weight-bold mb-2">Địa chỉ</label>
                                <input type="text" class="form-control w-100" id="address" name="address" value="<?php echo $user['address'] ?>" required>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <select class="form-control" id="is_admin" name="is_admin" required>
                                    <option value="0" <?php echo ($user['is_admin'] == '0') ? 'selected' : ''; ?>>User</option>
                                    <option value="1" <?php echo ($user['is_admin'] == '1') ? 'selected' : ''; ?>>Admin</option>
                                </select>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-dark btn-lg w-20 mt-4 mb-0">Cập Nhật Tài Khoản</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>