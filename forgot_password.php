<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi mật khẩu</title>
</head>

<body>
    <div class="password-reset-form">
        <h2>Đổi mật khẩu</h2>
        <form id="passwordForm">
            <div class="form-group">
                <label for="currentPassword">Mật khẩu cũ</label>
                <input type="password" id="currentPassword" required>
            </div>
            <div class="form-group">
                <label for="newPassword">Mật khẩu mới</label>
                <input type="password" id="newPassword" required minlength="8">
            </div>
            <div class="form-group">
                <label for="confirmNewPassword">Nhập lại mật khẩu mới</label>
                <input type="password" id="confirmNewPassword" required minlength="8">
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
</body>

</html>