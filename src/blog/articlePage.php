<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

include "../includes/conn.php";
session_start();

$userId = $_SESSION['userId'];

if (isset($_GET['article'])) {
    $articleId = htmlspecialchars($_GET['article']);
    $select = "SELECT * FROM articles JOIN users ON articles.userId = users.userId WHERE articleId = ? AND isDeleted = 0";
    $stmt = $conn->prepare($select);
    $stmt->bind_param("i", $articleId);
    $stmt->execute();
    $result = $stmt->get_result();
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $articleTitle = $row['articleTitle'];
        $articleContent = $row['articleContent'];
        $articleUser = $row['userId'];
        $articleTag = $row['articleTag'];
        $authorName = $row['userName'];
        $authorId = $row['userId'];
    } else {
        header('Location:themes.php');
        exit;
    }
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
    <div class="w-[95%] md:w-4/5 mx-auto flex flex-col gap-2">
        <div class="flex flex-row w-full gap-4 items-end mt-8 pl-4">
            <h1 class="text-2xl md:text-3xl font-medium"><?= $articleTitle ?></h1>
            <p class="text-sm p-1 rounded-xl border border-gray-500 text-gray-500"><?= $articleTag ?></p>
        </div>
        <div class="flex flex-col w-full shadow-xl rounded-xl border">
            <div class="w-full flex justify-between items-center">
                <p class="pl-8 py-4 font-medium text-lg text-gray-600">
                    <?= $authorName ?>
                </p>
                <?php if ($userId == $authorId) { ?>
                    <div class="p-2">
                        <i onclick="editArticle(<?= $articleId ?>)" class="bx bx-edit-alt text-gray-500 text-xl border-gray-500 cursor-pointer"></i>
                        <i onclick="deleteArticle(<?= $articleId ?>)" class="bx bx-message-alt-x text-gray-500 text-xl border-gray-500 cursor-pointer"></i>
                    </div>
                <?php } else if (isset($_SESSION['admin_name']) || isset($_SESSION['administrator_name'])) { ?>
                    <div class="p-2">
                        <i onclick="editArticle(<?= $articleId ?>)" class="bx bx-edit-alt text-gray-500 text-xl border-gray-500 cursor-pointer"></i>
                        <i onclick="deleteArticle(<?= $articleId ?>)" class="bx bx-message-alt-x text-gray-500 text-xl border-gray-500 cursor-pointer"></i>
                    </div>
                <?php } ?>
            </div>
            <p class="p-4 md:p-8 pt-0">
                <?= $articleContent ?>
            </p>
        </div>
        <div class="flex flex-col mt-6">
            <h1 class="text-2xl font-medium pl-4">Comments</h1>
        </div>
        <div class="flex flex-col gap-4 w-[95%] mx-auto md:mx-0 md:w-4/5">
            <div class="bg-red-500 mb-3 px-2 rounded-lg w-full">
                <p id="addErr" class="text-white text-lg text-center"></p>
            </div>
            <textarea name="comment" id="comment" cols="30" rows="5" class="w-full resize-none shadow-xl border-t-2 rounded-xl p-4" placeholder="Leave a comment!"></textarea>
            <input type="hidden" name="sessionid" id="sessionid" value="<?= $userId ?>">
            <input type="hidden" name="articleid" id="articleid" value="<?= $articleId ?>">
            <div class="self-end">
                <button id="addComment" class="px-8 py-2 bg-gray-500 border border-gray-600 text-white font-semibold rounded-lg">Comment</button>
            </div>
        </div>
        <div id="comments" class="flex flex-col gap-4 w-[95%] mx-auto md:mx-0 md:w-4/5 mt-6 p-2 bg-gray-100 rounded-lg">
            <?php
            $select = "SELECT * FROM comments WHERE articleId = $articleId";
            $result = mysqli_query($conn, $select);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $articleId = $row['articleId'];
                    $commentId = $row['commentId'];
                    $userSession = $row['userSession'];
                    $commentContent = htmlspecialchars_decode($row['commentContent']);
                    $isDeleted = $row['isDeleted'];
                    $user = "SELECT * FROM users WHERE userId = $userSession";
                    $result2 = mysqli_query($conn, $user);
                    $row2 = mysqli_fetch_assoc($result2);
                    $userName = $row2['userName'];

                    if (($isDeleted == 1 && $userId == $userSession) || isset($_SESSION['admin_name']) || isset($_SESSION['administrator_name'])) {
            ?>
                        <div id="comment<?= $commentId ?>" class="flex flex-col w-full shadow-md border-t-2 p-2 pl-4 bg-red-500/30">
                            <div class="flex w-full justify-between">
                                <h1 id="user<?= $commentId ?>" class="text-gray-500"><i class='bx bx-user text-gray-500 text-xl border-gray-500'></i><?= $userName ?></h1>
                                <?php if ($userId == $userSession) { ?>
                                    <div>
                                        <p onclick="undoDelete(<?= $commentId ?>,<?= $articleId ?>)" class="cursor-pointer underline text-gray-500">Undo</p>
                                    </div>
                                <?php } else if (isset($_SESSION['admin_name']) || isset($_SESSION['administrator_name'])) { ?>
                                    <div>
                                        <p onclick="undoDelete(<?= $commentId ?>,<?= $articleId ?>)" class="cursor-pointer underline text-gray-500">Undo</p>
                                    </div>
                                <?php } ?>
                            </div>
                            <p id="p<?= $commentId ?>">[Deleted comment]</p>
                        </div>

                    <?php } elseif ($isDeleted == 1) {  ?>

                    <?php  } else { ?>
                        <div id="comment<?= $commentId ?>" class="flex flex-col w-full shadow-lg border-t-2 p-2 pl-4">
                            <div class="flex w-full justify-between">
                                <h1 id="user<?= $commentId ?>" class="text-gray-500"><i class='bx bx-user text-gray-500 text-xl border-gray-500'></i><?= $userName ?></h1>
                                <?php if ($userId == $userSession) { ?>
                                    <div>
                                        <i onclick="editComment(<?= $commentId ?>,<?= $articleId ?>);" class="bx bx-edit-alt text-gray-500 text-xl border-gray-500 cursor-pointer"></i>
                                        <i onclick="deleteComment(<?= $commentId ?>,<?= $articleId ?>)" class="bx bx-message-alt-x text-gray-500 text-xl border-gray-500 cursor-pointer"></i>
                                    </div>
                                <?php } else if (isset($_SESSION['admin_name']) || isset($_SESSION['administrator_name'])) { ?>
                                    <div>
                                        <i onclick="editComment(<?= $commentId ?>,<?= $articleId ?>);" class="bx bx-edit-alt text-gray-500 text-xl border-gray-500 cursor-pointer"></i>
                                        <i onclick="deleteComment(<?= $commentId ?>,<?= $articleId ?>)" class="bx bx-message-alt-x text-gray-500 text-xl border-gray-500 cursor-pointer"></i>
                                    </div>
                                <?php } ?>
                            </div>
                            <p id="p<?= $commentId ?>"><?= $commentContent ?></p>
                        </div>
                <?php }
                }
            } else { ?>
                <div class="flex flex-col w-full shadow-md rounded-lg border-t-2 p-2 pl-4 text-center bg-gray-200">
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