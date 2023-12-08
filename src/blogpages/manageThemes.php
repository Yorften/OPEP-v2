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
                <form id="input_form" class="flex flex-col justify-between items-center h-full mt-[10vh] w-full">
                    <div class="bg-red-500 mb-3 px-2 rounded-lg">
                        <p id="addErr" class="text-white text-lg text-center"></p>
                    </div>
                    <div class="flex flex-col mb-3 w-[80%]">
                        <div class="flex flex-col border-2 border-[#A1A1A1] p-2 rounded-md">
                            <p class="text-xs">Theme name</p>
                            <input required class="placeholder:font-light placeholder:text-xs focus:outline-none" id="themeName" type="text" name="themeName" placeholder="Name" autocomplete="off">
                        </div>
                    </div>
                    <div class="flex flex-col mb-3 w-full">
                        <p class="text-md font-medium text-center mb-4">Theme's tags</p>
                        <div class="flex w-full justify-evenly flex-wrap">
                            <?php
                            $select = "SELECT * FROM tags";
                            $result = mysqli_query($conn, $select);
                            if (mysqli_num_rows($result) > 0) {
                                $i = 0;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $tagId = $row['tagId'];
                                    $tagName = $row['tagName'];

                            ?>
                                    <div class="mb-4">
                                        <input type="checkbox" id="tag<?= $i ?>" class="peer hidden taglist" value="<?= $tagId ?>">
                                        <label for="tag<?= $i ?>" class="w-full p-1 border-2 rounded-xl select-none cursor-pointer peer-checked:border-amber-600 peer-checked:text-amber-600">
                                            <?= $tagName ?>
                                        </label>
                                    </div>
                                <?php
                                    $i++;
                                }
                                $i = 0;
                            } else {
                                ?>
                                <option value="">No category exists</option>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="flex justify-end mb-4">
                        <input required type="submit" id="addTheme" class="cursor-pointer px-8 py-2 bg-[#9fff30] font-semibold rounded-lg border-2 border-[#6da22f]" value="Add theme">
                    </div>
                </form>
            </div>
        </div>
        <!-- End of Popup -->
        <!-- Popup Structure Edit ver. -->
        <div id="popupEditTag" class="fixed w-full h-full top-0 left-0  items-center flex justify-center hidden z-50">
            <div class="bg-white w-7/12 h-fit border-2 border-amber-600 flex flex-col justify-start items-center overflow-y-auto rounded-2xl md:h-fit">
                <div class="bg-amber-600 w-7/12 h-8 fixed rounded-tr-2xl rounded-tl-2xl">
                    <div class="flex justify-end">
                        <span onclick="closePopupEdit()" class="text-2xl font-bold cursor-pointer mr-3">&times;</span>
                    </div>
                </div>
                <form id="modify_form" class="flex flex-col justify-between items-center h-full mt-[10vh] w-full">
                    <div class="bg-red-500 mb-3 px-2 rounded-lg">
                        <p id="modErr" class="text-white text-lg text-center"></p>
                    </div>
                    <div class="flex flex-col mb-3 w-[80%]">
                        <div class="flex flex-col border-2 border-[#A1A1A1] p-2 rounded-md">
                            <p class="text-xs">Theme name</p>
                            <input required class="placeholder:font-light placeholder:text-xs focus:outline-none" id="themeName2" type="text" name="themeName2" placeholder="Name" autocomplete="off" value="">
                        </div>
                    </div>
                    <div class="flex flex-col mb-3 w-full">
                        <p class="text-md font-medium text-center mb-4">Theme's tags</p>
                        <div class="flex w-full justify-evenly flex-wrap">
                            <?php
                            $select = "SELECT * FROM tags";
                            $result = mysqli_query($conn, $select);
                            if (mysqli_num_rows($result) > 0) {
                                $i = 0;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $tagId = $row['tagId'];
                                    $tagName = $row['tagName'];

                            ?>
                                    <div class="mb-4">
                                        <input type="checkbox" id="tagedit<?= $i ?>" class="peer hidden uncheck" value="<?= $tagId ?>">
                                        <label for="tagedit<?= $i ?>" class="w-full p-1 border-2 rounded-xl select-none cursor-pointer peer-checked:border-amber-600 peer-checked:text-amber-600">
                                            <?= $tagName ?>
                                        </label>
                                    </div>
                                <?php
                                    $i++;
                                }
                                $i = 0;
                            } else {
                                ?>
                                <option value="">No category exists</option>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="flex flex-col mb-3 hidden">
                        <div class="flex flex-col border-2 border-[#A1A1A1] p-2 rounded-md">
                            <p class="text-xs">theme id</p>
                            <input required class="placeholder:font-light placeholder:text-xs focus:outline-none" id="themeId" type="text" name="themeId" placeholder="Name" autocomplete="off" value="">
                        </div>
                    </div>
                    <div class="flex justify-end mb-4">
                        <input required type="submit" id="modifyTheme" class="cursor-pointer px-8 py-2 bg-[#9fff30] font-semibold rounded-lg border-2 border-[#6da22f]" value="Apply changes">
                    </div>
                </form>
            </div>
        </div>
        <!-- End of Popup -->
        <div class="flex flex-col justify-end items-start h-[100vh]">
            <div class="flex justify-between w-full pl-8">
                <p class="border-gray-300 rounded-t-lg p-2 pb-1 text-xl">Tags</p>
                <button onclick="openPopup()" class="p-2 pb-1 bg-green-700 mb-2 rounded-md">Add Theme +</button>
            </div>
            <div class="border-2 border-gray-300 rounded-xl h-[90vh] w-full flex">
                <div id="themes" class="flex flex-col justify-between w-full p-4">
                    <?php
                    $records = $conn->query("SELECT * FROM themes");
                    $rows = $records->num_rows;

                    $start = 0;
                    $rows_per_page = 3;
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'] - 1;
                        $start = $page * $rows_per_page;
                    }
                    $select = "SELECT * FROM themes LIMIT ?,?";
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
                                    <th class="w-1/12 px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base">Theme Id</th>
                                    <th class="w-5/12 px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base">Title</th>
                                    <th class="w-4/12 px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base">Tags</th>
                                    <th class="w-2/12 px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base">Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $themeId = htmlspecialchars($row['themeId']);
                                    $themeName = htmlspecialchars($row['themeName']);

                                ?>
                                    <tr>
                                        <td class="px-4 py-2 border-2 text-center border-[#A3A3A3] text-xs md:text-base"><?= $themeId ?></td>
                                        <td class="px-4 py-2 border-2 text-center border-[#A3A3A3] text-xs md:text-base"><?= $themeName ?></td>
                                        <td id="tags<?= $themeId ?>" class="flex flex-wrap items-center justify-center px-4 py-2 text-center border-b-2 border-[#A3A3A3] text-xs md:text-base">
                                            <?php
                                            $select = "SELECT * FROM tags_themes JOIN tags on tags_themes.tagId = tags.tagId WHERE themeId = ?";
                                            $stmt = $conn->prepare($select);
                                            $stmt->bind_param("i", $themeId);
                                            $stmt->execute();
                                            $result2 = $stmt->get_result();
                                            while ($row2 = mysqli_fetch_assoc($result2)) {
                                                $tagName = $row2['tagName'];
                                                $tagId = $row2['tagId'];
                                            ?>
                                                <span class="p-1 border-2 rounded-xl select-none border-amber-600 text-amber-600 mr-[2px]" value="<?= $tagId ?>"><?= $tagName ?></span>
                                            <?php } ?>
                                        </td>
                                        <td class="px-1 py-2 border-2 text-center border-[#A3A3A3] text-xs md:text-base">
                                            <button id="showdetails" onclick="showThemeDetails('<?php echo $themeName; ?>',<?= $themeId ?>)" class="px-2 rounded-md bg-amber-500"> Modify </button>
                                            <button onclick="deleteTheme(<?= $themeId ?>)" class="px-2 rounded-md bg-red-500"> Delete </button>
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