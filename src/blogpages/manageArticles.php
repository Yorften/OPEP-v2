<?php
include("../includes/conn.php");
session_start();

if (isset($_SESSION['administrator_name']) || isset($_SESSION['admin_name'])) { ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include("../includes/head.html") ?>
    </head>

    <body>
        <div class="flex flex-col justify-end items-start h-[100vh]">
            <div class="flex justify-between w-full pl-8">
                <p class="border-gray-300 rounded-t-lg p-2 pb-1 text-xl">Articles</p>
                <a href="../blog/addArticle_admin.php" class="p-2 pb-1 bg-green-700 mb-2 rounded-md">Add Article +</a>
            </div>
            <div class="border-2 border-gray-300 rounded-xl h-[90vh] w-full flex">
                <div id="themes" class="flex flex-col justify-between w-full p-4">
                    <?php
                    $records = $conn->query("SELECT * FROM articles JOIN users ON articles.userId = users.userId JOIN themes ON articles.themeId = themes.themeId");
                    $rows = $records->num_rows;

                    $start = 0;
                    $rows_per_page = 4;
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'] - 1;
                        $start = $page * $rows_per_page;
                    }
                    $select = "SELECT * FROM articles JOIN users ON articles.userId = users.userId JOIN themes ON articles.themeId = themes.themeId LIMIT ?,?";
                    $stmt = $conn->prepare($select);
                    $stmt->bind_param("ii", $start, $rows_per_page);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $pages = ceil($rows / $rows_per_page);



                    if ($rows > 0) {
                    ?>
                        <table class="table-auto w-full ">
                            <thead class="border">
                                <tr class="border-2">
                                    <th class=" px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base">Author</th>
                                    <th class=" px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base">Title</th>
                                    <th class=" px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base">Theme</th>
                                    <th class=" px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base">Tag</th>
                                    <th class=" px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base">Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $articleId = $row['articleId'];
                                    $articleTitle = $row['articleTitle'];
                                    $articleTag = $row['articleTag'];
                                    $isDeleted = $row['isDeleted'];

                                    $userName = $row['userName'];
                                    $themeName = $row['themeName'];
                                    if($articleTag === NULL){
                                        $articleTag = 'None';
                                    }

                                ?>
                                    <tr>
                                        <td class="px-4 py-2 border-2 text-center border-[#A3A3A3] text-xs md:text-base"><?= $userName ?></td>
                                        <td class="px-4 py-2 border-2 text-center border-[#A3A3A3] text-gray-500 hover:text-gray-800 text-xs md:text-base"><a target="_blank" href="../blog/articlePage.php?article=<?= $articleId ?>"><?= $articleTitle ?></a></td>
                                        <td class="px-4 py-2 border-2 text-center border-[#A3A3A3] text-xs md:text-base"><?= $themeName ?></td>
                                        <td class="px-4 py-2 border-2 text-center border-[#A3A3A3] text-xs md:text-base"><?= $articleTag ?></td>
                                        <td class="px-1 py-2 border-2 text-center border-[#A3A3A3] text-xs md:text-base">
                                            <?php if ($isDeleted == 0) { ?>
                                                <a href="../blogpages/deleteArticle.php?articleId=<?= $articleId ?>" class="px-2 rounded-md bg-green-400"> Active </a>
                                            <?php } else { ?>
                                                <a href="../blogpages/deleteArticle.php?articleId=<?= $articleId ?>" class="px-2 rounded-md bg-red-400"> Archived </a>
                                            <?php } ?>
                                        </td>
                                    </tr>

                                <?php     }
                            } else {

                                ?>
                                <div class="w-full h-[100vh] flex items-center justify-center">
                                    <p>No tags in database</p>
                                </div>
                            <?php
                            }
                            ?>
                            </tbody>
                        </table>

                        <?php

                        ?>
                        <div>
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
            </div>
        </div>

        <script src="../js/popup.js"></script>
        <script src="../js/themes_ajax.js"></script>

    </body>

    </html>

<?php } else echo "You don't have permission";
exit;

?>