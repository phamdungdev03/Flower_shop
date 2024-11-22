<link rel="stylesheet" href="./public/css/checkout.css">

<section class="checkout">
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <span>Trang chủ / Đơn hàng</span>
    </div>
    <!-- Main container -->
    <div class="checkout-container">
        <!-- Form bên trái -->
        <div class="checkout-form">
            <h2 class="form-title">Thông tin người nhận</h2>
            <form action="#" method="post">
                <div class="form-group">
                    <label for="name">Họ và tên</label>
                    <input type="text" id="name" name="name" placeholder="Nhập họ và tên">
                </div>
                <div class="form-group">
                    <label for="phone">Số điện thoại</label>
                    <input type="tel" id="phone" name="phone" placeholder="Nhập số điện thoại">
                </div>
                <div class="form-group">
                    <label for="address">Địa chỉ</label>
                    <input type="text" id="address" name="address" placeholder="Nhập địa chỉ">
                </div>
                <div class="form-group">
                    <label for="delivery-time">Thời gian dự kiến</label>
                    <input type="datetime-local" id="delivery-time" name="delivery_time">
                </div>
                <div class="form-group">
                    <label for="services">Dịch vụ kèm theo</label>
                    <select id="services" name="services">
                        <option value="none">Không</option>
                        <option value="Gói quà">Gói quà</option>
                        <option value="Thiệp chúc mừng">Thiệp chúc mừng</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="message">Lời nhắn</label>
                    <textarea id="message" name="message" placeholder="Nhập lời nhắn" rows="4"></textarea>
                </div>
                <div class="form-action">
                    <button type="submit" class="btn-submit">Hoàn tất đơn hàng</button>
                </div>
            </form>
        </div>
        <!-- Thông tin sản phẩm bên phải -->
        <div class="checkout-products">
            <h2 class="product-title">Thông tin sản phẩm</h2>
            <div class="product-item">
                <img src="product-image.jpg" alt="Ảnh" class="product-image">
                <div class="product-details">
                    <h3 class="product-name">Tên sản phẩm</h3>
                    <p class="product-price">Giá: 500,000₫</p>
                    <p class="product-sale-price">Giảm giá: 450,000₫</p>
                </div>
            </div>
            <div class="total-price">
                <span>Tổng tiền: </span>
                <strong>450,000₫</strong>
            </div>
        </div>
    </div>
</section>