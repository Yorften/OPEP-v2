<?php
include("../includes/conn.php");
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("../includes/head.html") ?>
    <title>Themes Home | OPEP</title>
</head>

<body class=" h-[84vh]">
    <?php include("../includes/nav_blog.php"); ?>
    <h1 class="text-center m-4 text-xl">OPEP BLOG</h1>
    <div class="flex flex-col justify-center items-center">
        <div class="flex flex-col items-center w-[90%] mx-auto min-h-[70vh] md:min-h-[90vh] md:min-w-[70%]">
            <?php
            $records = $conn->query("SELECT * FROM themes WHERE themeDeleted = 0");
            $rows = $records->num_rows;

            $start = 0;
            $rows_per_page = 6;
            if (isset($_GET['page'])) {
                $page = $_GET['page'] - 1;
                $start = $page * $rows_per_page;
            }
            $select = "SELECT * FROM themes WHERE themeDeleted = 0 LIMIT ?,?";
            $stmt = $conn->prepare($select);
            $stmt->bind_param("ii", $start, $rows_per_page);
            $stmt->execute();
            $result = $stmt->get_result();
            $pages = ceil($rows / $rows_per_page);
            if ($rows > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $themeId = htmlspecialchars($row['themeId']);
                    $themeName = htmlspecialchars($row['themeName']);
                    $sql = "SELECT COUNT(*) AS articles_count 
                              FROM articles
                              JOIN themes ON articles.themeId = themes.themeId 
                              WHERE themes.themeName = '$themeName' AND isDeleted = 0
                              GROUP BY themes.themeName;";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $result2 = $stmt->get_result();
                    if (mysqli_num_rows($result2) > 0) {
                        $row2 = mysqli_fetch_assoc($result2);
                        $count = $row2['articles_count'];
                    } else $count = 0;
            ?>
                    <div class="w-full bg-white shadow-lg border-t shadow-gray-300 m-4 p-4 items-center rounded-lg">
                        <h3 class="flex justify-between items-center text-white-50"> <a class="hover:text-green-400 text-xl" href="articles.php?theme=<?= $themeId ?>"><?= $themeName ?></a> <span class=" text-xl cursor-pointer hover:text-green-400 ">
                                <a href="articles.php?theme=<?= $themeId ?>"><?= $count ?> Articles</a>
                            </span>
                        </h3>
                    </div>
                <?php } ?>

            <?php } else { ?>
                <div class="flex items-center justify-center text-2xl h-[60vh]">
                    <p>No themes found</p>
                </div>
            <?php } ?>
        </div>
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
    </div>
    <?php include("../includes/footer_blog.html"); ?>
    <script src="../js/burger.js"></script>
</body>

</html>