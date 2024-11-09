<link rel="stylesheet" href="./public/css/forgot_password.css">

<div class="password-reset-form">
    <h2>Đổi mật khẩu</h2>
    <form id="passwordForm" action="./actions/handle_forgot.php" method="POST">
        <div class="form-group">
            <label for="currentPassword">Mật khẩu cũ</label>
            <input type="password" id="currentPassword" name="currentPassword" required>
        </div>
        <div class="form-group">
            <label for="newPassword">Mật khẩu mới</label>
            <input type="password" id="newPassword" name="newPassword" required>
        </div>
        <div class="form-group">
            <label for="confirmNewPassword">Nhập lại mật khẩu mới</label>
            <input type="password" id="confirmNewPassword" name="confirmNewPassword" required>
        </div>
        <button type="submit" class="submit-btn">Xác nhận</button>
    </form>
</div>

<script>
    document.getElementById("passwordForm").addEventListener("submit", function(event) {
        const newPassword = document.getElementById("newPassword").value;
        const confirmNewPassword = document.getElementById("confirmNewPassword").value;

        if (newPassword !== confirmNewPassword) {
            alert("Mật khẩu mới và nhập lại mật khẩu không khớp.");
            event.preventDefault();
        } else if (newPassword.length < 8) {
            alert("Mật khẩu mới phải có ít nhất 8 ký tự.");
            event.preventDefault();
        } else {
            alert("Đổi mật khẩu thành công!");
        }
    });
</script>