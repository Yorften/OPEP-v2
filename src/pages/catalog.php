<?php

include("../includes/conn.php");
session_start();

if (!isset($_SESSION['client_name'])) {
    echo "You don't have permission";
    exit;
}

if (isset($_POST['addCart'])) {
    $plantId = $_POST['plantId'];
    $cartId = $_SESSION['client_cart'];
    $commanded = 0;
    $select = "SELECT * FROM plants_carts WHERE plantId = ? AND isCommanded = ? AND cartId = ?";
    $stmt = $conn->prepare($select);
    $stmt->bind_param("iii", $plantId, $commanded, $cartId);
    $stmt->execute();
    $result = $stmt->get_result();
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $quantity = $row['quantity'];
        $quantity += 1;

        $update = "UPDATE plants_carts SET quantity = ? WHERE plantId = ? AND cartId = ?";
        $stmt = $conn->prepare($update);
        $stmt->bind_param("iii", $quantity, $plantId, $cartId);
        $stmt->execute();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    } else {

        $insert = "INSERT INTO plants_carts (cartId, plantId) VALUES (?,?)";
        $stmt = $conn->prepare($insert);
        $stmt->bind_param("ii", $cartId, $plantId);
        $stmt->execute();
        $stmt->close();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("../includes/head.html") ?>
    <title>Catalog | O'PEP</title>
</head>

<body>

    <?php include("../includes/nav.php") ?>
    <div class="w-full text-center my-4">
        <a class="p-2 border-2 filters" href="catalog.php">All</a>
        <?php
        $select = "SELECT * FROM categories";
        $stmt = $conn->prepare($select);
        $stmt->execute();
        $result = $stmt->get_result();

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = htmlspecialchars($row['categoryId']);
                $name = htmlspecialchars($row['categoryName']);
        ?>
                <a class="p-2 border-2 filters" href="?categoryName=<?php echo $name ?>"><?php echo $name ?></a>
        <?php
            }
            echo   '</div>';
        } else {
            echo 'No categories in database';
        } ?>
        <div class="flex flex-col justify-between items-center border-2 border-amber-600 rounded-xl m-2 md:h-fit">
            <div class="grid gap-4 w-[90%] mt-6 rounded-lg mx-auto text-center grid-cols-2 md:w-[95%] md:grid-cols-3">
                <!-- content -->
                <?php

                if (isset($_GET['categoryName'])) {
                    $sql = "SELECT * FROM categories WHERE categoryName = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $_GET['categoryName']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = mysqli_fetch_assoc($result);
                    $categoryId = $row['categoryId'];

                    $records = "SELECT * FROM plants INNER JOIN categories on plants.categoryId = categories.categoryId WHERE plants.categoryId = ?";
                    $stmt = $conn->prepare($records);
                    $stmt->bind_param("s", $categoryId);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $rows = $result->num_rows;

                    $start = 0;
                    $rows_per_page = 6;
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'] - 1;
                        $start = $page * $rows_per_page;
                    }



                    $select = "SELECT * FROM plants INNER JOIN categories ON plants.categoryId = categories.categoryId WHERE plants.categoryId = ? LIMIT ?,?";
                    $stmt = $conn->prepare($select);
                    $stmt->bind_param("iii", $categoryId, $start, $rows_per_page);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $pages = ceil($rows / $rows_per_page);
                } else {
                    $records = $conn->query("SELECT * FROM plants");
                    $rows = $records->num_rows;

                    $start = 0;
                    $rows_per_page = 6;
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
                }
                if ($rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = htmlspecialchars($row['plantId']);
                        $name = htmlspecialchars($row['plantName']);
                        $categorie = htmlspecialchars($row['categoryName']);
                        $desc = htmlspecialchars($row['plantDesc']);
                        $image = htmlspecialchars($row['plantImage']);
                        $price = htmlspecialchars($row['plantPrice']);
                ?>
                        <div class="flex flex-col justify-center items-center gap-4 w-full md:w-[80%] mx-auto">
                            <div class="relative object-contain">
                                <img id="image" src="../images/Plants/<?php echo $image ?>" alt="">
                                <div id="hover" class="absolute bottom-0 left-0 w-full bg-white transition-all duration-500 transform translate-y-full opacity-0">
                                    <p class="p-4"><?php echo $desc ?></p>
                                </div>
                            </div>
                            <div class="flex flex-col justify-between w-full items-center md:flex-row">
                                <div class="flex flex-col child:text-left">
                                    <p><?php echo $name ?></p>
                                    <p class="font-medium"><?php echo $categorie ?></p>
                                </div>
                                <form method="post" class="flex flex-col items-center justify-center gap-1">
                                    <input type="text" name="plantId" value="<?php echo $id ?>" hidden>
                                    <button type="submit" name="addCart" class="z-10 p-2 bg-amber-400 border border-black rounded-lg">Add to cart</button>
                                    <p class="font-bold"><?php echo $price ?>DH</p>
                                </form>
                            </div>
                        </div>
                <?php
                    }
                    echo '</div>';
                } else {
                    echo 'No client accounts in database';
                }
                ?>
                <?php if (!isset($_GET['categoryName'])) { ?>
                    <div class="w-full mt-4 md:mt-8">
                        <div class="pl-2 md:pl-8">
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
                ?>
                    <div class="w-full mt-4 md:mt-8">
                        <div class="pl-2 md:pl-8">
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

                            <a href="?page=1&categoryName=<?php echo $_GET['categoryName'] ?>">First</a>
                            <?php if (isset($_GET['page']) && $_GET['page'] > 1) { ?>

                                <a href="?page=<?php echo $_GET['page'] - 1 ?>&categoryName=<?php echo $_GET['categoryName'] ?>">Previous</a>

                            <?php } else { ?>
                                <a class="cursor-pointer">Previous</a>
                            <?php } ?>

                            <?php
                            for ($i = 1; $i <= $pages; $i++) {
                            ?>
                                <a href="?page=<?php echo $i ?>&categoryName=<?php echo $_GET['categoryName'] ?>" class=""><?php echo $i ?></a>
                            <?php
                            }
                            ?>
                            <?php
                            if (!isset($_GET['page'])) {
                                if ($pages == 1) {
                            ?>
                                    <a class="cursor-pointer">Next</a>
                                <?php } else { ?>
                                    <a href="?page=2&categoryName=<?php echo $_GET['categoryName'] ?>">Next</a>
                                <?php } ?>

                            <?php } elseif ($_GET['page'] >= $pages) { ?>
                                <a class="cursor-pointer">Next</a>
                            <?php } else { ?>
                                <a href="?page=<?php echo $_GET['page'] + 1 ?>&categoryName=<?php echo $_GET['categoryName'] ?>">Next</a>
                            <?php }
                            ?>
                            <a href="?page=<?php echo $pages ?>&categoryName=<?php echo $_GET['categoryName'] ?>">Last</a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php include("../includes/footer.html") ?>

    <script src="../js/burger.js"></script>
    <script src="../js/filter.js"></script>
    <script src="../js/cartmenu.js"></script>
</body>

</html>