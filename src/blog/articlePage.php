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
            <p class="p-8">
                <?= $articleContent ?>
            </p>
        </div>
        <div class="flex flex-col mt-6">
            <h1 class="text-xl font-medium pl-4">Comments</h1>
        </div>
        <div class="flex flex-col gap-4 w-4/5">
            <textarea name="comment" id="comment" cols="30" rows="5" class="w-full resize-none shadow-xl border-t-2 rounded-xl p-4" placeholder="Leave a comment!"></textarea>
            <div class="self-end">
                <button id="addComment" class="px-8 py-2 bg-gray-500 border border-gray-600 text-white font-semibold rounded-lg ">Comment</button>
            </div>
        </div>
        <div id="comment" class="w-4/5 mt-6">
            <?php
            $select = "SELECT * FROM comments WHERE articleId = $articleId";
            $result = mysqli_query($conn, $select);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $userSession = $row['userSession'];
                    $commentContent = $row['commentContent'];
                    $user = "SELECT * FROM users WHERE userId = $userSession";
                    $result2 = mysqli_query($conn, $user);
                    $row2 = mysqli_fetch_assoc($result2);
                    $userName = $row2['userName'];
            ?>
                    <div class="flex flex-col w-full shadow-md rounded-lg border-t-2 p-2 pl-4">
                        <h1 class="text-gray-500"><i class='bx bx-user text-gray-500 text-xl rounded-xl border-gray-500'></i><?= $userName ?></h1>
                        <p><?= $commentContent ?></p>
                    </div>
                <?php }
            } else { ?>
                <div class="flex flex-col w-full shadow-md rounded-lg border-t-2 p-2 pl-4 text-center">
                    <p>No comments</p>
                </div>
            <?php    } ?>
        </div>
    </div>
    <?php include '../includes/footer_blog.html'; ?>
    <script src="../js/comments_ajax.js"></script>
    <script src="../js/burger.js"></script>
</body>

</html>