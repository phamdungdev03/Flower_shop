<link rel="stylesheet" href="./public/css/sidebar.css">


<section class="sidebar">
    <div class="sidebar__category-list">
        <h3 class="sidebar__title"><i class="fa-solid fa-bars"></i> Danh mục sản phẩm</h3>
        <ul class="sidebar__category-items">
            <?php
            include("./config/database.php");
            $conn = getConnection();
            $sql = "SELECT * FROM categories";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row["category_id"];
                    $name = $row["category_name"];
                    echo " <li><i class='fa-solid fa-check'></i> <a href='./index.php?id=2&category_id={$id}'>{$name}</a></li>";
                }
            }
            ?>
        </ul>
    </div>
    <div class="box_img">
        <img src="./public/img/sidebar_img.jpg" alt="img">
        <img src="./public/img/sidebar_img-1.jpg" alt="img">
        <img src="./public/img/sidebar_img-2.jpg" alt="img">
    </div>
    <div>
    </div>
</section>