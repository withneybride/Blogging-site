<?php
include 'db.php';
if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $conn->query("UPDATE posts SET rating = rating + 1 WHERE id=$id");
}
