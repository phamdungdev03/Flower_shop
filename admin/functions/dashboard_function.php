<?php
include_once(__DIR__ . '/../../config/database.php');

function getTodayMoney()
{
    $conn = getConnection();
    $query = "
        SELECT COALESCE(SUM(total_price), 0) AS today_money 
        FROM orders 
        WHERE DATE(order_date) = CURDATE();
    ";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result)['today_money'];
}

function getTodayUsers()
{
    $conn = getConnection();
    $query = "
        SELECT COUNT(account_id) AS today_users 
        FROM accounts where is_admin = 0;
    ";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result)['today_users'];
}

function getTotalSales()
{
    $conn = getConnection();
    $query = "
        SELECT COALESCE(SUM(total_price), 0) AS total_sales 
        FROM orders;
    ";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result)['total_sales'];
}

function getTotalProducts()
{
    $conn = getConnection();
    $query = "
       SELECT COUNT(*) AS total_products
       FROM products;
    ";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result)['total_products'];
}
