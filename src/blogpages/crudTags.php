<?php
include "conn.php";
session_start();
//********************** ajouter tag **************************// 
if(isset($_POST['submit'])){
    $tagName=$_POST['tagname'];
}

$insert= "INSERT INTO tags (tagName) values (?)";
$stmt = $conn->prepare($insert);
$stmt->bind_param("s", $tagName);
$stmt->execute();
$stmt->close();

//********* update tag *************//
if(isset($_GET['tagId'])){
    $tagId = $_GET['tagId'];  
    $tagName = $_POST['newname'];
    $update = "UPDATE tags SET tagName = ? WHERE tagId = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("si", $tagName, $tagId);
    $stmt->execute();
    $stmt->close();
}

//*********delete tag ***********/
if (isset($_GET['tagId'])){
        $tagId = $_GET['tagid']; 
        $delete = "DELETE FROM tags WHERE tagId = ?";
        $stmt = $conn->prepare($delete);
        $stmt->bind_param("i", $tagId);
        $stmt->execute();
        $stmt->close();
}
?>