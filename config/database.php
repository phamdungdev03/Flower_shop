<?php
if (!function_exists('getConnection')) {
    function getConnection()
    {
<<<<<<< HEAD
        $servername = "localhost";
=======
        $servername = "localhost:3306";
>>>>>>> 9f21b378d246bdc8b48233ee68dcd55068a7657f
        $username = "root";
        $password = "";
        $dbname = "flower_shop";
        $host = 3366;
        $conn = new mysqli($servername, $username, $password, $dbname, $host);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }
}
