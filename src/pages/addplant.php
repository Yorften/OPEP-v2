<?php
include("../includes/conn.php");
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (isset($_POST['submit']) && isset($_FILES['plantimg'])) {

    $name = $_FILES['plantimg']['name'];
    $size = $_FILES['plantimg']['size'];
    $tmp_name = $_FILES['plantimg']['tmp_name'];
    $error = $_FILES['plantimg']['error'];

    $plantName = $_POST['plant'];
    $plantDesc = $_POST['plantdesc'];
    $plantPrice = $_POST['plantprice'];
    $category = $_POST['category'];


    if ($error === 0) {
        if ($size > 4200000) {
            $msg[] = 'Sorry your file is too large. (max 4mb)';
        } else {
            $img_ext = pathinfo($name, PATHINFO_EXTENSION);
            $img_ext_lc = strtolower($img_ext);
            $allowed_ext = array("jpg", "jpeg", "png", "webp");

            if (in_array($img_ext_lc, $allowed_ext)) {
                $new_img_name = uniqid("IMG-", true) . '.' . $img_ext_lc;
                $img_upload_path = '../images/Plants/' . $new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);
            } else {
                $msg[] = 'Unsupported format. (jpg, jpeg, png, webp)';
            }
        }
    } else {
        $msg[] = 'Unkown error occured';
    }
    $select2 = "SELECT * FROM categories WHERE categoryName = ?";
    $stmt = $conn->prepare($select2);
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result2 = $stmt->get_result();
    $stmt->close();
    $row2 = mysqli_fetch_assoc($result2);
    $Idcateg = $row2['categoryId'];

    $insert = "INSERT INTO plants(plantName,plantDesc,plantPrice,plantImage,categoryId) VALUES (?,?,?,?,?)";
    $stmt = $conn->prepare($insert);
    $stmt->bind_param("ssisi", $plantName, $plantDesc, $plantPrice, $new_img_name, $Idcateg);
    $stmt->execute();
    $stmt->close();
}


if (isset($msg)) {
    foreach ($msg as $error) {
        echo $error;
    }
}
