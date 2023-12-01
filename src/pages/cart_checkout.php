<?php
include("../includes/conn.php");
session_start();

if (isset($_SESSION['client_name'])) {

    $cartId = $_SESSION['client_cart'];
    $plantId = $_GET['plantId'];
    $isSelected = $_GET['isSelected'];

    if ($isSelected == 1) {
        $isSelected = 0;
    } else $isSelected = 1;

    $update = "UPDATE plants_carts SET isSelected = ? WHERE cartId = ? AND plantId = ?";
    $stmt = $conn->prepare($update);
    $stmt->bind_param("iii", $isSelected,$cartId, $plantId);
    $stmt->execute();
    $stmt->close();
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
} else {
    echo "You don't have permission";
    exit;
}
