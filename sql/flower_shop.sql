-- Tạo cơ sở dữ liệu nếu chưa tồn tại
CREATE DATABASE IF NOT EXISTS flower_shop;
USE flower_shop;
-- Xóa các bảng nếu tồn tại
DROP TABLE IF EXISTS order_items;
DROP TABLE IF EXISTS reviews;
DROP TABLE IF EXISTS images;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS accounts;
DROP TABLE IF EXISTS categories;
-- Tạo bảng categories (Loại sản phẩm)
CREATE TABLE categories (
    category_id INT PRIMARY KEY AUTO_INCREMENT,
    category_name VARCHAR(255) NOT NULL
);
-- Tạo bảng products (Danh sách sản phẩm)
CREATE TABLE products (
    product_id INT PRIMARY KEY AUTO_INCREMENT,
    product_name VARCHAR(255) NOT NULL,
    product_price DECIMAL(10, 2) NOT NULL,
    category_id INT,
    rating_star FLOAT DEFAULT 0,
    product_info TEXT,
    product_detail TEXT,
    default_image VARCHAR(255),
    stock_quantity INT DEFAULT 0,
    FOREIGN KEY (category_id) REFERENCES categories(category_id)
);
-- Tạo bảng accounts (Tài khoản người dùng)
CREATE TABLE accounts (
    account_id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    user_name VARCHAR(255),
    phone VARCHAR(20),
    address TEXT,
    is_admin TINYINT(1) DEFAULT 0 -- Cột phân quyền
);
-- Tạo bảng orders (Đơn hàng)
CREATE TABLE orders (
    order_id INT PRIMARY KEY AUTO_INCREMENT,
    account_id INT,
    order_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(50) DEFAULT 'pending',
    total_price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (account_id) REFERENCES accounts(account_id)
);
-- Tạo bảng order_items (Chi tiết đơn hàng)
CREATE TABLE order_items (
    order_item_id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT,
    product_id INT,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id)
);
-- Tạo bảng reviews (Đánh giá sản phẩm)
CREATE TABLE reviews (
    review_id INT PRIMARY KEY AUTO_INCREMENT,
    product_id INT,
    account_id INT,
    rating INT CHECK (
        rating BETWEEN 1 AND 5
    ),
    comment TEXT,
    review_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(product_id),
    FOREIGN KEY (account_id) REFERENCES accounts(account_id)
);
-- Tạo bảng images (Hình ảnh sản phẩm)
CREATE TABLE images (
    image_id INT PRIMARY KEY AUTO_INCREMENT,
    product_id INT,
    image_path VARCHAR(255),
    FOREIGN KEY (product_id) REFERENCES products(product_id)
);
-- Thêm Dữ Liệu Vào Bảng categories
INSERT INTO categories (category_name)
VALUES ('Hoa hồng'),
    ('Hoa cúc'),
    ('Hoa lan'),
    ('Hoa tulip'),
    ('Hoa ly');
-- Thêm Dữ Liệu Vào Bảng products
INSERT INTO products (
        product_name,
        product_price,
        category_id,
        rating_star,
        product_info,
        product_detail,
        default_image,
        stock_quantity
    )
VALUES (
        'Bó hoa hồng đỏ',
        500000,
        1,
        4.5,
        'Hoa hồng đỏ tình yêu',
        'Bó hoa hồng đỏ với 20 bông',
        'rose_red.jpg',
        100
    ),
    (
        'Bó hoa cúc trắng',
        300000,
        2,
        4.0,
        'Hoa cúc trắng',
        'Bó hoa cúc trắng tươi mát',
        'daisy_white.jpg',
        50
    ),
    (
        'Chậu hoa lan hồ điệp',
        800000,
        3,
        5.0,
        'Lan hồ điệp đẹp',
        'Chậu lan hồ điệp sang trọng',
        'orchid_pot.jpg',
        20
    ),
    (
        'Bó hoa tulip vàng',
        600000,
        4,
        4.2,
        'Hoa tulip vàng',
        'Bó hoa tulip vàng rực rỡ',
        'tulip_yellow.jpg',
        30
    ),
    (
        'Bó hoa ly trắng',
        400000,
        5,
        4.7,
        'Hoa ly trắng tinh khôi',
        'Bó hoa ly trắng thơm ngát',
        'lily_white.jpg',
        40
    );
-- Thêm Dữ Liệu Vào Bảng accounts
INSERT INTO accounts (
        email,
        password,
        user_name,
        phone,
        address,
        is_admin
    )
VALUES (
        'dungmickey03@gmail.com',
        '1',
        'Phạm Văn Dũng',
        '0452714499',
        'Tp.Bắc Ninh, Bắc Ninh',
        0
    ),
    (
        'nam@gmail.com',
        '1',
        'Nguyễn Hoàng Nam',
        '0987654321',
        '456 Đường XYZ, Quận 3, TP.HCM',
        0
    ),
    (
        'admin@example.com',
        'admin',
        'Quản trị viên',
        '0123456789',
        '789 Đường DEF, Quận 5, TP.HCM',
        1
    );
-- Thêm Dữ Liệu Vào Bảng orders
INSERT INTO orders (account_id, total_price)
VALUES (1, 500000),
    (2, 900000);
-- Thêm Dữ Liệu Vào Bảng order_items
INSERT INTO order_items (order_id, product_id, quantity, price)
VALUES (1, 1, 1, 500000),
    (2, 3, 1, 800000),
    (2, 2, 2, 600000);
-- Giá cho 2 bó hoa cúc trắng
-- Thêm Dữ Liệu Vào Bảng reviews
INSERT INTO reviews (product_id, account_id, rating, comment)
VALUES (1, 1, 5, 'Hoa rất đẹp và tươi'),
    (2, 2, 4, 'Hoa cúc trắng rất thơm'),
    (3, 1, 5, 'Lan hồ điệp rất đẹp, tôi rất hài lòng');
-- Thêm Dữ Liệu Vào Bảng images
INSERT INTO images (product_id, image_path)
VALUES (1, 'rose_red_1.jpg'),
    (1, 'rose_red_2.jpg'),
    (2, 'daisy_white_1.jpg'),
    (3, 'orchid_pot_1.jpg');