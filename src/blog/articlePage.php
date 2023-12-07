<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

include "../includes/conn.php";
session_start();

$userId = $_SESSION['userId'];

if (isset($_GET['article'])) {
    $articleId = htmlspecialchars($_GET['article']);
    $select = "SELECT * FROM Articles WHERE articleId = $articleId";
    $result = mysqli_query($conn, $select);
    $row = mysqli_fetch_assoc($result);
    $articleTitle = $row['articleTitle'];
    $articleContent = $row['articleContent'];
    $articleUser = $row['userId'];
    $articleTag = $row['articleTag'];
} else {
    header('Location:themes.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("../includes/head.html") ?>
    <title><?= $articleTitle ?> | OPEP</title>
</head>

<body>
    <?php include("../includes/nav_blog.php"); ?>
    <div class="w-4/5 mx-auto flex flex-col gap-2">
        <div class="flex flex-row w-full gap-4 items-end mt-8 pl-4">
            <h1 class="text-3xl font-medium"><?= $articleTitle ?></h1>
            <p class="text-sm p-1 rounded-xl border border-gray-500 text-gray-500"><?= $articleTag ?></p>
        </div>
        <div class="w-full shadow-xl rounded-xl border">
            <p class="p-4">
                <?= $articleContent ?>
            </p>
        </div>
        <div class="flex flex-col">
            <h1 class="text-xl font-medium pl-4">Comments</h1>
        </div>
        <div class="flex flex-col gap-4 w-4/5">
            <textarea name="comment" id="comment" cols="30" rows="5" class="w-full resize-none shadow-xl border-t-2 rounded-xl p-4" placeholder="Leave a comment!"></textarea>
            <div class="self-end">
            <button class="px-8 py-2 bg-gray-400 text-white font-semibold rounded-lg ">Comment</button>
        </div>
        </div>
        <div class="w-full">
            <?php
            $select = "SELECT * FROM comments WHERE articleId = $articleId";
            $result = mysqli_query($conn,$select);
            while($row=mysqli_fetch_assoc($result))
            ?>
            <div class="flex flex-col w-full shadow-md rounded-lg border-t-2">

            </div>
        </div>
    </div>
    <?php include '../includes/footer_blog.html'; ?>
</body>

</html>