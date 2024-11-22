<?php
include('../functions/contact_function.php');
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['contact_id'])) {
        $contactId = $_GET['contact_id'];
        if (deleteContact($contactId)) {
            header("Location: ../index.php?id=12");
        } else {
            echo "<script>
                        alert('Lỗi khi xóa liên hệ!');
                        window.location.href = '../index.php?id=12';
                      </script>";
            exit();
        }
    }
}
