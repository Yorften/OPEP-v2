<?php
include "../includes/conn.php";
session_start();

if (isset($_GET['theme'])) {
    $themeId = htmlspecialchars($_GET['theme']);
    $select = "SELECT * FROM themes WHERE themeId = $themeId";
    $result = mysqli_query($conn, $select);
    $row = mysqli_fetch_assoc($result);
    $themeName = $row['themeName'];
} else header('Location:themes.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("../includes/head.html") ?>
    <title>Articles</title>
</head>

<body>
    <?php include("../includes/nav_blog.php"); ?>
    <header class="flex flex-col justify-between items-center h-[40vh] py-8 bg-white shadow-lg text-center">
        <div class="flex justify-between items-center w-[60%] mx-auto">
            <h1 class="text-3xl"><?= $themeName ?></h1>
            <a href="addArticle.php?theme=<?= $themeId ?>" class="px-4 py-2 bg-[#9fff30] font-semibold rounded-lg border-2 border-[#6da22f]">Add article +</a>
        </div>
        <div class="flex flex-wrap mx-auto justify-between w-[60%]">
            <div>
                <input type="radio" id="all" name="tags" class="peer hidden" value="all" checked />
                <label for="all" class="w-full p-1 px-4 border-2 rounded-xl select-none cursor-pointer peer-checked:border-amber-600 peer-checked:text-amber-600">
                    All
                </label>
            </div>
            <?php
            $select = "SELECT * FROM tags_themes JOIN tags ON tags_themes.tagId = tags.tagId WHERE themeId = $themeId";
            $stmt = $conn->prepare($select);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            while ($row = mysqli_fetch_assoc($result)) {
                $tagName = $row['tagName'];
                $tagId = $row['tagId']
            ?>
                <div>
                    <input type="radio" id="Tag<?= $tagId ?>" name="tags" class="peer hidden" value="<?= $tagName ?>" />
                    <label for="Tag<?= $tagId ?>" class="w-full p-1 border-2 rounded-xl select-none cursor-pointer peer-checked:border-amber-600 peer-checked:text-amber-600">
                        <?= $tagName ?>
                    </label>
                </div>
            <?php }
            ?>
        </div>
        <div class="flex items-center justify-center bg-gray-100 rounded border border-gray-200 mt-4 w-1/4 mx-auto">
            <input id="search-bar" type="text" name="search" placeholder="Search" class="flex items-center align-middle justify-center bg-transparent py-1 text-gray-600 px-4 focus:outline-none w-full" />
            <button class="py-2 px-4 bg-[#bdff72] text-black rounded-r border-l border-gray-200 hover:bg-gray-50 active:bg-gray-200 disabled:opacity-50 inline-flex items-center focus:outline-none">
                Search
            </button>
        </div>
    </header>
    <div class="flex flex-col justify-between items-center h-[90vh]">
        <div class="w-11/12 mx-auto article">
            <?php
            $records = $conn->query("SELECT * FROM Articles WHERE themeId = $themeId");
            $rows = $records->num_rows;

            $start = 0;
            $rows_per_page = 10;
            if (isset($_GET['page'])) {
                $page = $_GET['page'] - 1;
                $start = $page * $rows_per_page;
            }

            $select = "SELECT * FROM articles JOIN users ON articles.userId = users.userId WHERE themeId = ? LIMIT ?,?";
            $stmt = $conn->prepare($select);
            $stmt->bind_param("iii", $themeId, $start, $rows_per_page);
            $stmt->execute();
            $result = $stmt->get_result();
            $pages = ceil($rows / $rows_per_page);
            if ($rows > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $articleId = $row['articleId'];
                    $articleTitle = $row['articleTitle'];
                    $articleContent = $row['articleContent'];
                    $userName = $row['userName'];
                    // get first 30 words from article
                    $words = explode(' ', $articleContent);
                    $articleDesc = implode(' ', array_slice($words, 0, 30));

            ?>
                    <div class=" bg-white shadow-lg shadow-gray-300 m-4 p-4 rounded-lg">

                        <a href="articlePage.php?article=<?= $articleId ?>" class="flex justify-between text-white-50 font-medium hover:text-gray-500"><?= $articleTitle ?></a>
                        <p class="text-gray-800 m-2"><?= $articleDesc ?>...<span><a href="articlePage.php?article=<?= $articleId ?>"><span class="hover:text-gray-500 font-medium">Read more</span></a></span></p>
                        <div class="flex justify-between m-1">
                            <small class="text-gray-500 flex items-center">
                                <i class='bx bx-user text-black text-xl rounded-xl border-black'></i>
                                <p>Poted By <?= $userName ?></p>
                            </small>
                        </div>

                    </div>
                <?php
                }
            } else { ?>
                <div class="flex items-center justify-center text-2xl h-[60vh]">
                    <p>No articles found</p>
                </div>
            <?php }
            ?>
        </div>
        <?php if ($rows > 0) { ?>
            <div class="w-[70%] mx-auto">
                <div class="pl-6">
                    <?php
                    if (!isset($_GET['page'])) {
                        $page = 1;
                    } else {
                        $page = $_GET['page'];
                    }
                    ?>
                    Showing <?php echo $page ?> of <?php echo $pages ?>
                </div>
                <div class="flex flex-row justify-center items-center gap-3">

                    <a href="?page=1">First</a>
                    <?php if (isset($_GET['page']) && $_GET['page'] > 1) { ?>

                        <a href="?page=<?php echo $_GET['page'] - 1 ?>">Previous</a>

                    <?php } else { ?>
                        <a class="cursor-pointer">Previous</a>
                    <?php } ?>

                    <?php
                    for ($i = 1; $i <= $pages; $i++) {
                    ?>
                        <a href="?page=<?php echo $i ?>" class=""><?php echo $i ?></a>
                    <?php
                    }
                    ?>
                    <?php
                    if (!isset($_GET['page'])) {
                        if ($pages == 1) {
                    ?>
                            <a class="cursor-pointer">Next</a>
                        <?php } else { ?>
                            <a href="?page=2">Next</a>
                        <?php } ?>

                    <?php } elseif ($_GET['page'] >= $pages) { ?>
                        <a class="cursor-pointer">Next</a>
                    <?php } else { ?>
                        <a href="?page=<?php echo $_GET['page'] + 1 ?>">Next</a>
                    <?php }
                    ?>
                    <a href="?page=<?php echo $pages ?>">Last</a>
                </div>
            </div>
        <?php } else {
            echo '';
        } ?>
    </div>
    <?php include("../includes/footer_blog.html"); ?>
    <script src="../js/burger.js"></script>
    <script src="../js/search.js"></script>
</body>

</html>