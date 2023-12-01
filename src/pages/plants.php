<?php
ini_set('display_errors', 0);
include("../includes/conn.php");
session_start();

if (isset($_POST['submit']) && isset($_FILES['plantimg'])) {

    $name = $_FILES['plantimg']['name'];
    $size = $_FILES['plantimg']['size'];
    $tmp_name = $_FILES['plantimg']['tmp_name'];
    $error = $_FILES['plantimg']['error'];

    $plantName = $_POST['plant'];
    $plantDesc = $_POST['plantdesc'];
    $plantPrice = $_POST['plantprice'];
    $category = $_POST['category'];


    if ($error === 0) {
        if ($size > 4200000) {
            $msg[] = 'Sorry your file is too large. (max 4mb)';
            exit;
        } else {
            $img_ext = pathinfo($name, PATHINFO_EXTENSION);
            $img_ext_lc = strtolower($img_ext);

            $allowed_ext = array("jpg", "jpeg", "png", "webp", "avif");

            if (in_array($img_ext_lc, $allowed_ext)) {
                $new_img_name = uniqid("IMG-", true) . '.' . $img_ext_lc;
                $img_upload_path = '../images/Plants/' . $new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);
            } else {
                echo 'Unsupported format';
                $msg[] = 'Unsupported format. (jpg, jpeg, png, webp)';
                exit;
            }
        }
    } else {
        $msg[] = 'Unkown error occured';
        exit;
    }
    $select = "SELECT * FROM plants WHERE plantName = ?";
    $stmt = $conn->prepare($select);
    $stmt->bind_param("s", $plantName);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if (mysqli_num_rows($result) > 0) {
        $msg[] = 'Plant already exists';
    } else {
        $select2 = "SELECT * FROM categories WHERE categoryName = ?";
        $stmt = $conn->prepare($select2);
        $stmt->bind_param("s", $category);
        $stmt->execute();
        $result2 = $stmt->get_result();
        $stmt->close();
        $row2 = mysqli_fetch_assoc($result2);
        $Idcateg = $row2['categoryId'];

        $insert = "INSERT INTO plants(plantName,plantDesc,plantPrice,plantImage,categoryId) VALUES (?,?,?,?,?)";
        $stmt = $conn->prepare($insert);
        $stmt->bind_param("ssisi", $plantName, $plantDesc, $plantPrice, $new_img_name, $Idcateg);
        $stmt->execute();
        $stmt->close();
    }
}

if (isset($_POST['edit']) && isset($_FILES['plantimg'])) {
    $plantId = $_GET['plantId'];
    // $plantImage = $_GET['plantImage'];

    $name = $_FILES['plantimg']['name'];
    $size = $_FILES['plantimg']['size'];
    $tmp_name = $_FILES['plantimg']['tmp_name'];
    $error = $_FILES['plantimg']['error'];

    $plantName = $_POST['plant'];
    $plantDesc = $_POST['plantdesc'];
    $plantPrice = $_POST['plantprice'];
    $category = $_POST['category'];


    if ($error === 0) {
        if ($size > 4200000) {
            $msg[] = 'Sorry your file is too large. (max 4mb)';
        } else {
            $img_ext = pathinfo($name, PATHINFO_EXTENSION);
            $img_ext_lc = strtolower($img_ext);

            $allowed_ext = array("jpg", "jpeg", "png", "webp", "afiv");

            if (in_array($img_ext_lc, $allowed_ext)) {
                $new_img_name = uniqid("IMG-", true) . '.' . $img_ext_lc;
                $img_upload_path = '../images/Plants/' . $new_img_name;
            } else {
                echo 'Unsupported format';
                $msg[] = 'Unsupported format. (jpg, jpeg, png, webp)';
                exit;
            }
        }
    } else {
        $msg[] = 'Unkown error occured';
        exit;
    }
    $select = "SELECT * FROM plants WHERE plantName = ?";
    $stmt = $conn->prepare($select);
    $stmt->bind_param("s", $plantName);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if (mysqli_num_rows($result) > 0) {
        $msg[] = 'Plant already exists';
        exit;
    } else {
        // $old_img_path = '../images/Plants/' . $plantImage;
        $select2 = "SELECT * FROM categories WHERE categoryName = ?";
        $stmt = $conn->prepare($select2);
        $stmt->bind_param("s", $category);
        $stmt->execute();
        $result2 = $stmt->get_result();
        $stmt->close();
        $row2 = mysqli_fetch_assoc($result2);
        $Idcateg = $row2['categoryId'];

        $insert = "UPDATE plants SET plantName = ?,plantDesc = ?,plantPrice = ?,plantImage = ?,categoryId = ? WHERE plantId = ?";
        $stmt = $conn->prepare($insert);
        $stmt->bind_param("ssisii", $plantName, $plantDesc, $plantPrice, $new_img_name, $Idcateg, $plantId);
        $stmt->execute();
        $stmt->close();
        move_uploaded_file($tmp_name, $img_upload_path);
        // chown($old_img_path, 666);
        // unlink($old_img_path);
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
            <form method="post" enctype="multipart/form-data" class="flex flex-col justify-between items-center w-full h-full mt-[10vh]">
                <div class="flex flex-col mb-3 w-11/12 md:w-4/6">
                    <div class="flex flex-col border-2 border-[#A1A1A1] p-2 rounded-md">
                        <p class="text-xs">Plant name</p>
                        <input required class="placeholder:font-light placeholder:text-xs focus:outline-none" id="plant" type="text" name="plant" placeholder="Name" autocomplete="off">
                    </div>
                    <div id="plantERR" class="text-red-600 text-xs pl-3"></div>
                </div>
                <div class="flex flex-col mb-3 w-11/12 md:w-4/6">
                    <div class="flex flex-col border-2 border-[#A1A1A1] p-2 rounded-md">
                        <p class="text-xs">Plant description</p>
                        <textarea required name="plantdesc" id="plantdesc" cols="10" rows="3" class=" resize-none p-1"></textarea>
                    </div>
                    <div id="plantdescERR" class="text-red-600 text-xs pl-3"></div>
                </div>
                <div class="flex flex-col mb-3 w-11/12 md:w-4/6">
                    <div class="flex flex-col border-2 border-[#A1A1A1] p-2 rounded-md">
                        <p class="text-xs">Plant price</p>
                        <input required class="placeholder:font-light placeholder:text-xs focus:outline-none" id="plantprice" type="text" name="plantprice" placeholder="Price" autocomplete="off" pattern="[0-9]+" title="Please enter numbers only">
                    </div>
                    <div id="plantpriceERR" class="text-red-600 text-xs pl-3"></div>
                </div>
                <div class="flex flex-col gap-3 mb-3 w-11/12 md:w-4/6 md:flex-row">
                    <div class="flex flex-col md:w-1/2">
                        <div class="flex flex-col border-2 border-[#A1A1A1] p-2 rounded-md">
                            <p class="text-xs">Plant image</p>
                            <input required class="placeholder:font-light placeholder:text-xs focus:outline-none" id="plantimg" type="file" name="plantimg" autocomplete="off">
                        </div>
                        <div id="plantimgERR" class="text-red-600 text-xs pl-3"></div>
                    </div>
                    <div class="flex flex-col md:w-1/2">
                        <div class="flex flex-col border-2 border-[#A1A1A1] p-2 rounded-md md:h-[63.9px]">
                            <p class="text-xs">Plant category</p>
                            <select required class="block leading-5 text-gray-700 bg-white border-transparent rounded-md focus:outline-none focus:ring focus:ring-blue-300 focus:border-blue-300" id=" category" name="category" autocomplete="off">
                                <option value="" hidden disabled selected>Select...</option>
                                <?php
                                $select = "SELECT * FROM categories";
                                $result = mysqli_query($conn, $select);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $categoryName = $row['categoryName'];
                                ?>
                                        <option value="<?php echo $categoryName ?>"><?php echo $categoryName ?></option>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <option value="">No category exists</option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div id="categoryERR" class="text-red-600 text-xs pl-3"></div>
                    </div>
                </div>

                <div class="flex justify-end mb-4">
                    <input required type="submit" name="submit" class="cursor-pointer px-8 py-2 bg-[#9fff30] font-semibold rounded-lg border-2 border-[#6da22f]" value="Add plant">
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
            <form method="post" enctype="multipart/form-data" class="flex flex-col justify-between items-center w-full h-full mt-[10vh]">
                <div class="flex flex-col mb-3 w-11/12 md:w-4/6">
                    <div class="flex flex-col border-2 border-[#A1A1A1] p-2 rounded-md">
                        <p class="text-xs">Plant name</p>
                        <input required class="placeholder:font-light placeholder:text-xs focus:outline-none" id="plant2" type="text" name="plant" placeholder="Name" autocomplete="off">
                    </div>
                    <div id="plantERR2" class="text-red-600 text-xs pl-3"></div>
                </div>
                <div class="flex flex-col mb-3 w-11/12 md:w-4/6">
                    <div class="flex flex-col border-2 border-[#A1A1A1] p-2 rounded-md">
                        <p class="text-xs">Plant description</p>
                        <textarea required name="plantdesc" id="plantdesc2" cols="10" rows="3" class=" resize-none p-1"></textarea>

                    </div>
                    <div id="plantdescERR2" class="text-red-600 text-xs pl-3"></div>
                </div>
                <div class="flex flex-col mb-3 w-11/12 md:w-4/6">
                    <div class="flex flex-col border-2 border-[#A1A1A1] p-2 rounded-md">
                        <p class="text-xs">Plant price</p>
                        <input required class="placeholder:font-light placeholder:text-xs focus:outline-none" id="plantprice2" type="text" name="plantprice" placeholder="Price" autocomplete="off" pattern="[0-9]+" title="Please enter numbers only">
                    </div>
                    <div id="plantpriceERR2" class="text-red-600 text-xs pl-3"></div>
                </div>
                <div class="flex flex-col gap-3 mb-3 w-11/12 md:w-4/6 md:flex-row">
                    <div class="flex flex-col md:w-1/2">
                        <div class="flex flex-col border-2 border-[#A1A1A1] p-2 rounded-md">
                            <p class="text-xs">Plant image</p>
                            <input required class="placeholder:font-light placeholder:text-xs focus:outline-none" id="plantimg2" type="file" name="plantimg" autocomplete="off">
                        </div>
                        <div id="plantimgERR2" class="text-red-600 text-xs pl-3"></div>
                    </div>
                    <div class="flex flex-col md:w-1/2">
                        <div class="flex flex-col border-2 border-[#A1A1A1] p-2 rounded-md md:h-[63.9px]">
                            <p class="text-xs">Plant category</p>
                            <select required class="block leading-5 text-gray-700 bg-white border-transparent rounded-md focus:outline-none focus:ring focus:ring-blue-300 focus:border-blue-300" id=" category2" name="category" autocomplete="off">
                                <option value="" hidden disabled selected>Select...</option>
                                <?php
                                $select = "SELECT * FROM categories";
                                $result = mysqli_query($conn, $select);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $categoryId = $row['categoryId'];
                                        $categoryName = $row['categoryName'];
                                ?>
                                        <option value="<?php echo $categoryName ?>"><?php echo $categoryName ?></option>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <option value="">No category exists</option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div id="categoryERR2" class="text-red-600 text-xs pl-3"></div>
                    </div>
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
            <p class="border-gray-300 rounded-t-lg p-2 pb-1 text-xl">Plants</p>
            <?php
            if (isset($msg)) {
                foreach ($msg as $error) {
                    echo '<div class="bg-red-500 mb-3 px-2 rounded-lg">';
                    echo '<p class="text-white text-lg text-center">' . $error . '</p>';
                    echo '</div>';
                }
            }

            ?>
            <button onclick="openPopup()" class="p-2 pb-1 bg-green-700 mb-2 rounded-md">Add Plant +</button>
        </div>
        <div class="border-2 border-gray-300 rounded-xl h-[90vh] flex">
            <div id="clients" class="flex flex-col justify-between w-full p-4">
                <?php
                $records = $conn->query("SELECT * FROM plants");
                $rows = $records->num_rows;

                $start = 0;
                $rows_per_page = 5;
                if (isset($_GET['page'])) {
                    $page = $_GET['page'] - 1;
                    $start = $page * $rows_per_page;
                }
                $select = "SELECT plantId, plantName, plantDesc, plantPrice, plantImage, categoryName FROM plants INNER JOIN categories ON plants.categoryId = categories.categoryId LIMIT ?,?";
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
                    <th class="w-[20%] p-1 md:px-4 md:py-2 border-2 border-[#A3A3A3] text-xs md:text-base">Plant</th>
                    <th class="w-[14%] p-1 md:px-4 md:py-2 border-2 border-[#A3A3A3] text-xs md:text-base">Category</th>
                    <th class="w-[40%] p-1 md:px-4 md:py-2 border-2 border-[#A3A3A3] text-xs md:text-base">Description</th>
                    <th class="w-[8%] p-1 md:px-4 md:py-2 border-2 border-[#A3A3A3] text-xs md:text-base">Price</th>
                    <th class="w-[20    %] p-1 md:px-4 md:py-2 border-2 border-[#A3A3A3] text-xs md:text-base">Action</th>
                </tr>
            </thead>
            <tbody>';
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = htmlspecialchars($row['plantId']);
                        $categories = htmlspecialchars($row['categoryName']);
                        $name = htmlspecialchars($row['plantName']);
                        $desc = htmlspecialchars($row['plantDesc']);
                        $image = htmlspecialchars($row['plantImage']);
                        $price = htmlspecialchars($row['plantPrice']);
                ?>
                        <tr>
                            <td class="px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base text-center"><?php echo $name ?></td>
                            <td class="px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base text-center"><?php echo $categories ?></td>
                            <td class="px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base text-center"><?php echo $desc ?></td>
                            <td class="px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base text-center"><?php echo $price ?></td>
                            <td class="px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base text-center">
                                <button onclick="showPlantDetails(<?php echo $id ?>)" class="px-2 mb-2 rounded-md bg-amber-500 md:mb-0"> Modify </button>
                                <a href="deleteplant.php?id=<?php echo $id ?>" class="px-2 rounded-md bg-red-500"> Delete </a>
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