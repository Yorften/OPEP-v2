<?php
include("../includes/conn.php");
session_start();

if (isset($_POST['submit'])) {

    $categoryName = mysqli_real_escape_string($conn, $_POST['category']);

    $select = "SELECT * FROM categories WHERE categoryName = ?";
    $stmt = $conn->prepare($select);
    $stmt->bind_param("s", $categoryName);
    $stmt->execute();
    $result = $stmt->get_result();

    if (mysqli_num_rows($result) > 0) {
        $msg[] = 'Category already exists';
    } else {
        $insert = "INSERT INTO categories (categoryName) VALUES (?)";
        $stmt = $conn->prepare($insert);

        if ($stmt) {
            $stmt->bind_param("s", $categoryName);
            $stmt->execute();
            $userId = $stmt->insert_id;
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    }
}

if (isset($_POST['edit'])) {
    $id = $_GET['categoryId'];
    $categoryName = mysqli_real_escape_string($conn, $_POST['category']);

    $select = "SELECT * FROM categories WHERE categoryName = ?";
    $stmt = $conn->prepare($select);
    $stmt->bind_param("s", $categoryName);
    $stmt->execute();
    $result = $stmt->get_result();

    if (mysqli_num_rows($result) > 0) {
        $msg[] = 'Category already exists';
    } else {
        $insert = "UPDATE categories set categoryName = ? WHERE categoryId = ?";
        $stmt = $conn->prepare($insert);

        if ($stmt) {
            $stmt->bind_param("si", $categoryName, $id);
            $stmt->execute();
            $userId = $stmt->insert_id;
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    }
}

?>

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
                        <p class="text-xs">Category name</p>
                        <input required class="placeholder:font-light placeholder:text-xs focus:outline-none" id="categoryname" type="text" name="category" placeholder="Name" autocomplete="off">
                    </div>
                    <div id="categorynameERR" class="text-red-600 text-xs pl-3"></div>
                </div>
                <div class="flex justify-end mb-4">
                    <input required type="submit" name="submit" class="cursor-pointer px-8 py-2 bg-[#9fff30] font-semibold rounded-lg border-2 border-[#6da22f]" value="Add categorie">
                </div>
            </form>
        </div>
    </div>
    <!-- End of Popup -->
    <!-- Popup Structure -->
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
                        <p class="text-xs">Category name</p>
                        <input required class="placeholder:font-light placeholder:text-xs focus:outline-none" id="categoryname2" type="text" name="category" placeholder="Name" autocomplete="off" value="">
                    </div>
                    <div id="categorynameERR2" class="text-red-600 text-xs pl-3"></div>
                </div>
                <div class="flex justify-end mb-4">
                    <input required type="submit" name="edit" class="cursor-pointer px-8 py-2 bg-[#9fff30] font-semibold rounded-lg border-2 border-[#6da22f]" value="Apply changes">
                </div>
            </form>
        </div>
    </div>
    <!-- End of Popup -->
    <div class="flex flex-col justify-end items-start h-[100vh]">
        <div class="flex justify-between w-full px-8">
            <p class="border-gray-300 rounded-t-lg p-2 pb-1 text-xl">Categories</p>
            <?php
            if (isset($msg)) {
                foreach ($msg as $error) {
                    echo '<div class="bg-red-500 mb-3 px-2 rounded-lg">';
                    echo '<p class="text-white text-lg text-center">' . $error . '</p>';
                    echo '</div>';
                }
            }

            ?>
            <button onclick="openPopup()" class="p-2 pb-1 bg-green-700 mb-2 rounded-md">Add Category +</button>
        </div>
        <div class="border-2 border-gray-300 rounded-xl h-[90vh] flex">
            <div id="clients" class="flex flex-col justify-between w-full p-4">
                <?php
                $records = $conn->query("SELECT * FROM categories");
                $rows = $records->num_rows;

                $start = 0;
                $rows_per_page = 8;
                if (isset($_GET['page'])) {
                    $page = $_GET['page'] - 1;
                    $start = $page * $rows_per_page;
                }
                $select = "SELECT * FROM categories LIMIT ?,?";
                $stmt = $conn->prepare($select);
                $stmt->bind_param("ii", $start, $rows_per_page);
                $stmt->execute();
                $result = $stmt->get_result();
                $pages = ceil($rows / $rows_per_page);
                if ($rows > 0) {
                    echo ' 
        <table class="table-fixed w-full ">
            <thead class="border">
                <tr class="border-2">
                    <th class="w-1/5 px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base">Id</th>
                    <th class="w-3/5 px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base">Categorie</th>
                    <th class="w-1/5 px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base">Action</th>
                </tr>
            </thead>
            <tbody>';
                    while ($row = mysqli_fetch_assoc($result)) {
                        $name = htmlspecialchars($row['categoryName']);
                        $id = htmlspecialchars($row['categoryId']);
                ?>
                        <tr>
                            <td class="px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base text-center"><?php echo $id ?></td>
                            <td class="px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base text-center"><?php echo $name ?></td>
                            <td class="px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base text-center">
                                <button onclick="showDetails(<?php echo $id ?>)" class="px-2 rounded-md bg-amber-500"> Modify </button>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                    </table>

                <?php
                } else {
                    echo 'No categories in database';
                }
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