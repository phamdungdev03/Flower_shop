<link rel="stylesheet" href="./public/css/account_info.css">

<?php
include("./config/database.php");

$conn = getConnection();
if (!isset($_SESSION['user_id'])) {
    echo "<p>Bạn hãy <a href='./login.php'>Đăng Nhập</a> để xem thông tin tài khoản.</p>";
    exit();
}

$accountId = $_SESSION['user_id'];
$sql = "SELECT * FROM accounts WHERE account_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $accountId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $userInfo = $result->fetch_assoc();
} else {
    echo "<p>Bạn hãy <a href='./login.php'>Đăng Nhập</a> để xem thông tin tài khoản.</p>";
    exit();
}
?>
<div class="profile-card">
    <div class="profile-header">
        <h1><?php echo htmlspecialchars($userInfo['full_name']); ?></h1>
    </div>
    <div class="profile-body">
        <div class="user-detail"><i class="fas fa-envelope"></i> Email: <?php echo htmlspecialchars($userInfo['email']); ?></div>
        <div class="user-detail"><i class="fas fa-phone"></i> Số Điện Thoại: <?php echo htmlspecialchars($userInfo['phone_number']); ?></div>
        <div class="user-detail"><i class="fas fa-location"></i> Địa Chỉ: <?php echo htmlspecialchars($userInfo['address']); ?></div>
        <div class="user-detail"><i class="fas fa-lock"></i> <a href="index.php?id=10">Thay Đổi Mật Khẩu</a></div>
    </div>
</div>