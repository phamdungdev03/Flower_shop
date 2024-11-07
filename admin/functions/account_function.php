<?php
include(__DIR__ . '/../../config/database.php');

function getAllUsers($userId)
{
    $conn = getConnection();
    $sql = "SELECT * FROM accounts where account_id != $userId";
    $result = $conn->query($sql);
    return $result;
}

function getUserById($userId)
{
    $conn = getConnection();
    $sql = "SELECT * FROM accounts WHERE account_id = ?";
    $st = $conn->prepare($sql);
    $st->bind_param("s", $userId);
    $st->execute();
    $result = $st->get_result();
    if ($result->num_rows > 0) {
        $category = $result->fetch_assoc();
        return $category;
    }
}

function addUser($userName, $email, $phone, $address, $password, $isAdmin, $fullName)
{
    $conn = getConnection();
    $sql = "INSERT INTO accounts(user_name,email,phone_number, address, password, is_admin, full_name) VALUES(?,?,?,?,?,?,?)";
    $st = $conn->prepare($sql);
    $st->bind_param("sssssss", $userName, $email, $phone, $address, $password, $isAdmin, $fullName);
    if ($st->execute()) {
        return true;
    } else {
        return false;
    }
    $conn->close();
    $st->closse();
}

function editUser($userId, $fullName, $email, $phone, $address, $isAdmin)
{
    $conn = getConnection();
    $sql = "UPDATE accounts SET full_name=?,email=?, phone_number=?, address=?, is_admin = ? WHERE account_id = ?";
    $st = $conn->prepare($sql);
    $st->bind_param("ssssss", $fullName, $email, $phone, $address, $isAdmin, $userId);
    if ($st->execute()) {
        return true;
    } else {
        return false;
    }
    $conn->close();
    $st->closse();
}

function deleteUser($userId)
{
    $conn = getConnection();
    $sql = "DELETE FROM accounts WHERE account_id = ?";
    $st = $conn->prepare($sql);
    $st->bind_param("s", $userId);

    if ($st->execute()) {
        return true;
    } else {
        return false;
    }

    $st->close();
    $conn->close();
}

function isUsernameExists($userName)
{
    $conn = getConnection();
    $stmt = $conn->prepare("SELECT COUNT(*) FROM accounts WHERE user_name = ?");
    $stmt->bind_param("s", $userName);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();
    $conn->close();
    return $count > 0;
}
