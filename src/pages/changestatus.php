<?php

include("../includes/conn.php");
session_start();


if (isset($_SESSION['administrator_name']) || isset($_SESSION['admin_name'])) {

    $id = $_GET['id'];
    if ($_GET['status'] == 1) {
        $status = 0;
    } else $status = 1;

    $update = "UPDATE users SET isVerified = ? WHERE userId = ?";

    $stmt = $conn->prepare($update);
    $stmt->bind_param("ii", $status, $id);
    $stmt->execute();
    $stmt->close();
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
} else {
    echo "You don't have permission";
    exit;
}
