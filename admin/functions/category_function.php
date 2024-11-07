<?php
include(__DIR__ . '/../../config/database.php');

function getAllCategories()
{
    $conn = getConnection();
    $sql = "SELECT * FROM categories";
    $result = $conn->query($sql);
    return $result;
}

function getCategoryById($categoryId)
{
    $conn = getConnection();
    $sql = "SELECT * FROM categories WHERE category_id = ?";
    $st = $conn->prepare($sql);
    $st->bind_param("s", $categoryId);
    $st->execute();
    $result = $st->get_result();
    if ($result->num_rows > 0) {
        $category = $result->fetch_assoc();
        return $category;
    }
}

function addCategory($categoryName)
{
    $conn = getConnection();
    $sql = "INSERT INTO categories(category_name) VALUES(?)";
    $st = $conn->prepare($sql);
    $st->bind_param("s", $categoryName);
    if ($st->execute()) {
        return true;
    } else {
        return false;
    }
    $conn->close();
    $st->closse();
}

function editCategory($categoryId, $categoryName)
{
    $conn = getConnection();
    $sql = "UPDATE categories SET category_name = ? WHERE category_id = ?";
    $st = $conn->prepare($sql);
    $st->bind_param("ss", $categoryName, $categoryId);
    if ($st->execute()) {
        return true;
    } else {
        return false;
    }
    $conn->close();
    $st->closse();
}

function deleteCategory($categoryId)
{
    $conn = getConnection();
    $sql = "DELETE FROM categories WHERE category_id = ?";
    $st = $conn->prepare($sql);
    $st->bind_param("s", $categoryId);

    if ($st->execute()) {
        return true;
    } else {
        return false;
    }

    $st->close();
    $conn->close();
}
