<?php
include("../includes/conn.php");
session_start();

if (isset($_SESSION['administrator_name']) || isset($_SESSION['admin_name'])) {
    //********************** ajouter tag **************************// 
    $data = json_decode(file_get_contents("php://input"), true);

    if (!empty($data['tagName'])) {
        $tagName =  $data['tagName'];

        $insert = "INSERT INTO tags (tagName) VALUES (?)";
        $stmt = $conn->prepare($insert);
        $stmt->bind_param("s", $tagName);
        $stmt->execute();
        $stmt->close();
    }

    //********* update tag *************//
    if (!empty($data['tagId2'])) {
        $tagId =  $data['tagId2'];

        $select = "SELECT * FROM tags WHERE tagId = ?";
        $stmt = $conn->prepare($select);
        $stmt->bind_param("i", $tagId);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        echo json_encode($data);
    }

    if(!empty($data['tagName2'])){
        $tagId = $data['tagId3'];
        $tagName = $data['tagName2'];

        $update = "UPDATE tags SET tagName = ? WHERE tagId = ?";
        $stmt = $conn->prepare($update);
        $stmt->bind_param("si", $tagName, $tagId);
        $stmt->execute();
        $stmt->close();
    }

    //*********delete tag ***********/

    if (!empty($data['tagId'])) {
        $tagId =  $data['tagId'];

        $delete = "DELETE FROM tags WHERE tagId = ?";
        $stmt = $conn->prepare($delete);
        $stmt->bind_param("i", $tagId);
        $stmt->execute();
        $stmt->close();

        $stmt->close();
    }
} else echo "You don't have permission";
exit;
