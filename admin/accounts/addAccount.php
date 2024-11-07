<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-3 pb-3 d-flex gap-2 align-items-center">
                        <h6 class="text-white text-capitalize ps-3 mb-0">Thêm Mới Tài Khoản</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="card-body">
                        <form action="./actions/account_action.php" method="post">
                            <input type="hidden" name="action" value="addAccount">
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Tên đăng nhập</label>
                                <input type="text" class="form-control" id="user_name" name="user_name" required>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Mật khẩu</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Họ Và Tên</label>
                                <input type="text" class="form-control" id="full_name" name="full_name" required>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Số điên thoại</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" required>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Địa chỉ</label>
                                <input type="text" class="form-control" id="address" name="address" required>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <select class="form-control" id="is_admin" name="is_admin" required>
                                    <option value="0">User</option>
                                    <option value="1">Admin</option>
                                </select>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-dark btn-lg w-20 mt-4 mb-0">Thêm Tài Khoản</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>