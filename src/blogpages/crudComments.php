<?php
include '../includes/conn.php';
// This Conndition For Add New Comments
if(isset($_GET['add_comments'])){
    $nom = $_GET['commentsId'];
    $commentscontent = $_GET['commentsContent'];
    $userssession = $_GET['usersSession'];
    $articleid = $_GET['articleid'];
    
    $add_comment = "INSERT INTO comments (nom , commentsContent , usersSession , articleid) Values (? , ? , ? , ?)";
    $stmtfor = $conn->prepare($add_comment);
    $stmtfor->bind_param("ssii" , $nom , $commentscontent , $userssession , $articleid);
    $stmtfor->execute();
}
// This Conndition For Delete Comments
if(isset($_GET['delete_comments'])){
    $delete_comments = "DELETE FROM comments WHERE commentsId = ?";
    $stmtfive = $conn->prepare($delete_comments);
    
}

?>