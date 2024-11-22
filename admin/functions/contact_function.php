<?php
include(__DIR__ . '/../../config/database.php');

function getAllContacts()
{
    $conn = getConnection();
    $sql = "SELECT c.contact_id, u.full_name ,c.contact_name, c.contact_email, c.contact_phone, c.contact_date, c.message FROM contacts as c LEFT JOIN accounts as u on c.account_id = u.account_id";
    $result = $conn->query(query: $sql);
    return $result;
}

function deleteContact($contactId)
{
    $conn = getConnection();
    $sql = "DELETE FROM contacts WHERE contact_id = ?";
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
