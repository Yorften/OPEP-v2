<?php
// include '../includes/conn.php';
// session_start();
// if(isset($_GET['add_acticle'])){
//     $id = $_GET['articleid'];
//     $title = $_GET['articleTitle'];
//     $content = $_GET['articleContent'];
//     $user = $_GET['userId'];
//     $theme = $_GET['themeId'];

//     $addarticle = 'INSERT INTO Articles (atricleid , articleTitle , articleContent , userId , 	themeId) VALUES (? , ? , ? , ? , ?)';
//     $stmt = $conn->prepare($addarticle);
//     $stmt->bind_param("issii" , $id , $title , $content , $user , $theme);
//     $stmt->execute();
//     header('Location:' . $_SERVER['HTTP_REFERER']);
// }

// if(isset($_GET['delete_article'])){
//     $deletearticle = "DELETE FROM Articles WHERE articleid = ?";
//     $stmtwo = $conn->prepare($deletearticle);
//     $stmtwo->bind_param("i" , $_GET['articleId']);
//     $stmtwo->execute();
//     header('Location:' . $_SERVER['HTTP_REFERER']);
// }


// if(isset($_GET['edite_article'])){
//     $id = $_GET['articleid'];
//     $title = $_GET['articleTitle'];
//     $content = $_GET['articleContent'];
//     $user = $_GET['userId'];
//     $theme = $_GET['themeId'];
    
//     $editearticle = "UPDATE Article SET title = ? , content = ?  WHERE articleId = ?";
//     $stmthree = $conn->prepare($editearticle);
//     $stmthree->bind_param("ss", $id, $title, $content, $user, $theme);
//     $stmthree->execute();
//     header('Location:' . $_SERVER['HTTP_REFERER']);
// }
?>