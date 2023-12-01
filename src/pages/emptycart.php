<?php

include("../includes/conn.php");
session_start();

if (isset($_SESSION['client_name'])) {

    $cartId = $_SESSION['client_cart'];
    $plantId = $_GET['plantId'];

    $delete = "DELETE FROM plants_carts WHERE cartId = ?";
    $stmt = $conn->prepare($delete);
    $stmt->bind_param("i", $cartId);
    $stmt->execute();
    $stmt->close();
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
} else {
    echo "You don't have permission";
    exit;
}
