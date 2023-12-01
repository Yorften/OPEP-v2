<?php
include("../includes/conn.php");
session_start();

if (isset($_SESSION['client_name'])) {

    $cartId = $_SESSION['client_cart'];
    $date = date("Y-m-d H:i:s");
    $commanded = 0;
    $total = $_GET['total'];

    $insert = "INSERT INTO commands (commandDate, cartId, total) VALUES (?,?,?)";
    $stmt = $conn->prepare($insert);
    $stmt->bind_param("sii", $date , $cartId, $total);
    $stmt->execute();
    $commandId = $stmt->insert_id;
    $isSelected = 1;

    $update = "UPDATE plants_carts SET isCommanded = ? WHERE cartId = ? AND isSelected = ? AND isCommanded = ? ";
    $stmt = $conn->prepare($update);
    $stmt->bind_param("iiii", $commandId , $cartId, $isSelected, $commanded);
    $stmt->execute();
    $stmt->close();
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
} else {
    echo "You don't have permission";
    exit;
}
