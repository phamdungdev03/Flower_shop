<link rel="stylesheet" href="./public/css/contact.css">

<section class="contact-form">
    <h2>Liên hệ với chúng tôi</h2>
    <form action="./actions/handle_contact.php" method="POST">
        <div class="form-group">
            <label for="name">Họ và Tên:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="phone">Số Điện Thoại:</label>
            <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" required>
        </div>

        <div class="form-group">
            <label for="message">Nội Dung Tin Nhắn:</label>
            <textarea id="message" name="message" rows="5" required></textarea>
        </div>

        <button type="submit" class="submit-button">Gửi Tin Nhắn</button>
    </form>
</section>