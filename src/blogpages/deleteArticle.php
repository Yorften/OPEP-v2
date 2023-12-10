<?php
include '../includes/conn.php';
session_start();
$userId = $_SESSION['userId'];
if (isset($_GET['articleId'])) {
    $articleId = $_GET['articleId'];
    $select = "SELECT * FROM articles WHERE articleId = ?";
    $stmt = $conn->prepare($select);
    $stmt->bind_param("i", $articleId);
    $stmt->execute();
    $result = $stmt->get_result();
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $authorId = $row['userId'];
        $isDeleted = $row['isDeleted'];
        if($isDeleted == 1){
            $isDeleted = 0;
        }else $isDeleted = 1;
        if ($userId == $authorId || isset($_SESSION['administrator_name']) || isset($_SESSION['admin_name'])) {
            $update = "UPDATE articles SET isDeleted = ? WHERE articleId = ?";
            $stmt = $conn->prepare($update);
            $stmt->bind_param("ii", $isDeleted, $articleId);
            $stmt->execute();
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        } else {
            header('Location:../blog/themes.php');
            exit;
        }
    } else {
        header('Location:../blog/themes.php');
        exit;
    }
} else {
    header('Location:../blog/themes.php');
    exit;
}
