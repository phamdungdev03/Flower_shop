<?php
include(__DIR__ . '/../../config/database.php');

function getAllContacts()
{
    $conn = getConnection();
    $sql = "SELECT c.contact_id, u.full_name, u.email, u.phone_number, c.contact_date, c.message FROM contacts as c JOIN accounts as u where c.account_id = u.account_id";
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

