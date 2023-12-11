<?php
include "../includes/conn.php";
session_start();

$userId = $_SESSION['userId'];

if (!isset($_SESSION['client_name']) && !isset($_SESSION['admin_name']) && !isset($_SESSION['administrator_name'])) {
    header('location:../pages/login.php');
}

if (isset($_GET['theme'])) {
    $themeId = htmlspecialchars($_GET['theme']);
} else {
    header('Location:themes.php');
    exit;
}

if (isset($_POST['submit'])) {

    $articleTitle = $_POST['title'];
    $articleContent = htmlspecialchars($_POST['content']);
    $articleContent = str_replace("\n", '&#10;', $articleContent);
    $articleTag = mysqli_real_escape_string($conn, $_POST['tag']);


    $insert = "INSERT INTO articles (articleTitle,articleContent,userId,themeId,articleTag) VALUES (?,?,?,?,?)";
    $stmt = $conn->prepare($insert);

    if ($stmt) {
        $stmt->bind_param("ssiis", $articleTitle, $articleContent, $userId, $themeId, $articleTag);
        $stmt->execute();
        $articleId = $stmt->insert_id;
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
    header('location:articlePage.php?article=' . $articleId);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("../includes/head.html") ?>
    <title>Add an article</title>
</head>

<body>
    <?php include("../includes/nav_blog.php"); ?>
    <div class="h-[70vh] w-4/5 mx-auto shadow-xl rounded-xl border mt-4">
        <form method="POST" class="flex flex-col justify-around items-center h-full">
            <input type="text" name="title" id="title" placeholder="Title" class="p-1 w-3/4 shadow-lg border-t-2 rounded-lg">
            <textarea name="content" id="content" cols="30" rows="10" placeholder="Article content" class="w-3/4 shadow-md p-1 border-t-2 rounded-lg"></textarea>
            <div class="flex w-3/4 justify-between items-center">
                <select name="tag" id="tag" class="block leading-5 text-gray-700 bg-white border-transparent rounded-md focus:outline-none focus:ring focus:ring-blue-300 focus:border-blue-300 w-[30%] h-[40px]">
                    <option value="" hidden selected>Select tag...</option>
                    <?php
                    $select = "SELECT * FROM tags_themes JOIN tags ON tags_themes.tagId = tags.tagId WHERE themeId = $themeId";
                    $result = mysqli_query($conn, $select);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $tagName = $row['tagName'];
                    ?>
                            <option value="<?= $tagName ?>"><?= $tagName ?></option>
                        <?php }
                    } else { ?>
                        <option value="" disabled selected hidden>No tags available</option>
                    <?php }
                    ?>
                </select>
                <input type="submit" name="submit" value="Add article" class="cursor-pointer px-8 py-2 bg-[#9fff30] font-semibold rounded-lg border-2 border-[#6da22f]">
            </div>
        </form>
    </div>
    <script src="../js/burger.js"></script>
</body>

</html>