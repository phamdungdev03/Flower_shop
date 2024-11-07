<?php
include(__DIR__ . '/../../config/database.php');

function getAllContacts()
{
    $conn = getConnection();
    $sql = "SELECT c.contact_id, u.full_name, c.email, c.phone_number, c.created_at, c.message FROM contact as c JOIN users as u where c.user_id = u.user_id";
    $result = $conn->query($sql);
    return $result;
}

function deleteContact($contactId)
{
    $conn = getConnection();
    $sql = "DELETE FROM contact WHERE contact_id = ?";
    $st = $conn->prepare($sql);
    $st->bind_param("s", $contactId);

    if ($st->execute()) {
        return true;
    } else {
        return false;
    }

    $st->close();
    $conn->close();
}

