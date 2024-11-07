<?php
include('../includes/contact_function.php');
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['contact_id'])) {
        $contactId = $_GET['contact_id'];
        if (deleteContact($contactId)) {
            header("Location: ../indexadmin.php?id=12");
        } else {
            echo "<script>
                        alert('Lỗi khi xóa liên hệ!');
                        window.location.href = '../indexadmin.php?id=12';
                      </script>";
            exit();
        }
    }
}
