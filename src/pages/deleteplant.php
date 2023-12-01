<?php

include("../includes/conn.php");
session_start();

if (isset($_SESSION['admin_name']) || isset($_SESSION['administrator_name'])) {

    $id = $_GET['id'];

    $delete = "DELETE FROM plants WHERE plantId = ?";
    $stmt = $conn->prepare($delete);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
} else {
    echo "You don't have permission";
    exit;
}