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
        <!-- Popup Structure -->
        <div id="popup" class="fixed w-full h-full top-0 left-0  items-center flex justify-center hidden z-50">
            <div class="bg-white w-7/12 h-fit border-2 border-amber-600 flex flex-col justify-start items-center overflow-y-auto rounded-2xl md:h-fit">
                <div class="bg-amber-600 w-7/12 h-8 fixed rounded-tr-2xl rounded-tl-2xl">
                    <div class="flex justify-end">
                        <span onclick="closePopup()" class="text-2xl font-bold cursor-pointer mr-3">&times;</span>
                    </div>
                </div>
                <form method="post" class="flex flex-col justify-between items-center h-full mt-[10vh]">
                    <div class="flex flex-col mb-3">
                        <div class="flex flex-col border-2 border-[#A1A1A1] p-2 rounded-md">
                            <p class="text-xs">Tage name</p>
                            <input required class="placeholder:font-light placeholder:text-xs focus:outline-none" id="categoryname" type="text" name="tagname" placeholder="Name" autocomplete="off">
                        </div>
                        <div id="categorynameERR" class="text-red-600 text-xs pl-3"></div>
                    </div>
                    <div class="flex justify-end mb-4">
                        <input required type="submit" id="addTag" class="cursor-pointer px-8 py-2 bg-[#9fff30] font-semibold rounded-lg border-2 border-[#6da22f]" value="Add categorie">
                    </div>
                </form>
            </div>
        </div>
        <!-- End of Popup -->
        <!-- Popup Structure Edit ver. -->
        <div id="popupEdit" class="fixed w-full h-full top-0 left-0  items-center flex justify-center hidden z-50">
            <div class="bg-white w-7/12 h-fit border-2 border-amber-600 flex flex-col justify-start items-center overflow-y-auto rounded-2xl md:h-fit">
                <div class="bg-amber-600 w-7/12 h-8 fixed rounded-tr-2xl rounded-tl-2xl">
                    <div class="flex justify-end">
                        <span onclick="closePopup()" class="text-2xl font-bold cursor-pointer mr-3">&times;</span>
                    </div>
                </div>
                <form method="post" class="flex flex-col justify-between items-center h-full mt-[10vh]">
                    <div class="flex flex-col mb-3">
                        <div class="flex flex-col border-2 border-[#A1A1A1] p-2 rounded-md">
                            <p class="text-xs">Tage name</p>
                            <input required class="placeholder:font-light placeholder:text-xs focus:outline-none" id="tagname2" type="text" name="category" placeholder="Name" autocomplete="off" value="">
                        </div>
                        <div id="categorynameERR2" class="text-red-600 text-xs pl-3"></div>
                    </div>
                    <div class="flex justify-end mb-4">
                        <input required type="submit" id="modifyTag" class="cursor-pointer px-8 py-2 bg-[#9fff30] font-semibold rounded-lg border-2 border-[#6da22f]" value="Apply changes">
                    </div>
                </form>
            </div>
        </div>
        <!-- End of Popup -->
        <div class="flex flex-col justify-end items-start h-[100vh]">
            <div class="flex justify-between w-full pl-8">
                <p class="border-gray-300 rounded-t-lg p-2 pb-1 text-xl">Tags</p>
                <button onclick="openPopup()" class="p-2 pb-1 bg-green-700 mb-2 rounded-md">Add Tag +</button>
            </div>
            <div class="border-2 border-gray-300 rounded-xl h-[90vh] flex">
                <div id="clients" class="flex flex-col justify-between w-full p-4">
                    <?php
                    $records = $conn->query("SELECT * FROM tags");
                    $rows = $records->num_rows;

                    $start = 0;
                    $rows_per_page = 9;
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'] - 1;
                        $start = $page * $rows_per_page;
                    }
                    $select = "SELECT * FROM tags LIMIT ?,?";
                    $stmt = $conn->prepare($select);
                    $stmt->bind_param("ii", $start, $rows_per_page);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $pages = ceil($rows / $rows_per_page);



                    if ($rows > 0) {
                    ?>
                        <table class="table-fixed w-full ">
                            <thead class="border">
                                <tr class="border-2">
                                    <th class="w-1/5 px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base">Tag Id</th>
                                    <th class="w-2/5 px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base">Name</th>
                                    <th class="w-3/5 px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $name = htmlspecialchars($row['tagName']);
                                    $id = htmlspecialchars($row['tagId']);

                                ?>
                                    <tr>
                                        <td class="px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base">' . $id . '</td>
                                        <td class="px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base">' . $name . '</td>
                                        <td class="px-1 py-2 border-2 border-[#A3A3A3] text-xs md:text-base text-center flex w-full justify-between">
                                            <button onclick="showTagDetails(<?= $id ?>)" class="px-2 rounded-md bg-amber-500"> Modify </button>
                                            <button onclick="deleteTag(<?= $id ?>)" class="px-2 rounded-md bg-red-500"> Delete </button>
                                        </td>
                                    </tr>

                            <?php     }
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
    </body>

    </html>

<?php } else echo "You don't have permission";
exit;

?>