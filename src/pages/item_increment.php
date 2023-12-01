<?php
include("../includes/conn.php");
session_start();

if (isset($_SESSION['client_name'])) {

    $cartId = $_SESSION['client_cart'];
    $plantId = $_GET['plantId'];
    $quantity = $_GET['quantity'];
    $quantity += 1;

    $update = "UPDATE plants_carts SET quantity = ? WHERE cartId = ? AND plantId = ?";
    $stmt = $conn->prepare($update);
    $stmt->bind_param("iii", $quantity,$cartId, $plantId);
    $stmt->execute();
    $stmt->close();
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
} else {
    echo "You don't have permission";
    exit;
}
