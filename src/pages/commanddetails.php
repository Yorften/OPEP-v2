<?php
include("../includes/conn.php");
session_start();

if (isset($_SESSION['client_name'])) {
    echo "You don't have permission";
    exit;
}

$commandId = $_GET['commandId'];
$cartId = $_GET['cartId'];
$total = $_GET['total'];

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("../includes/head.html") ?>
</head>

<body>
    <div class="flex flex-col justify-end items-start h-[100vh]">
        <div class="flex justify-between w-full px-8">
            <p class="border-gray-300 rounded-t-lg p-2 pb-1 text-xl">Command N°: <?php echo $commandId ?></p>
            <p>Total price: <?php echo $total ?> DH</p>
        </div>
        <div class="border-2 border-gray-300 rounded-xl h-[90vh] w-full flex">
            <div class="flex flex-col justify-between w-full p-4">
                <?php

                $records = $conn->query("SELECT * FROM plants_carts WHERE cartId = $cartId AND isCommanded = $commandId");
                $rows = $records->num_rows;

                $start = 0;
                $rows_per_page = 8;
                if (isset($_GET['page'])) {
                    $page = $_GET['page'] - 1;
                    $start = $page * $rows_per_page;
                }

                $select = "SELECT * FROM plants_carts JOIN plants ON plants_carts.plantId = plants.plantId JOIN categories ON plants.categoryId = categories.categoryId WHERE cartId = ? AND isCommanded = ? LIMIT ?,?";
                $stmt = $conn->prepare($select);
                $stmt->bind_param("iiii", $cartId, $commandId, $start, $rows_per_page);
                $stmt->execute();
                $result = $stmt->get_result();
                $pages = ceil($rows / $rows_per_page);
                ?>
                <table class="table-fixed w-full ">
                    <thead class="border">
                        <tr class="border-2">
                            <th class="w-[30%] p-1 md:px-4 md:py-2 border-2 border-[#A3A3A3] text-xs md:text-base">Plant</th>
                            <th class="w-[20%] p-1 md:px-4 md:py-2 border-2 border-[#A3A3A3] text-xs md:text-base">Category</th>
                            <th class="w-[10%] p-1 md:px-4 md:py-2 border-2 border-[#A3A3A3] text-xs md:text-base">Quantity</th>
                            <th class="w-[20%] p-1 md:px-4 md:py-2 border-2 border-[#A3A3A3] text-xs md:text-base">Price /unit</th>
                            <th class="w-[20%] p-1 md:px-4 md:py-2 border-2 border-[#A3A3A3] text-xs md:text-base">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            $plantName = $row['plantName'];
                            $categoryName = $row['categoryName'];
                            $quantity = $row['quantity'];
                            $plantPrice = $row['plantPrice'];
                            $totalPrice = $plantPrice * $quantity;

                        ?>
                            <tr>
                                <td class="px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base text-center"><?php echo $plantName ?></td>
                                <td class="px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base text-center"><?php echo $categoryName ?></td>
                                <td class="px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base text-center"><?php echo $quantity ?></td>
                                <td class="px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base text-center"><?php echo $plantPrice ?></td>
                                <td class="px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base text-center"><?php echo $totalPrice ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
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

                            <a href="?page=<?php echo $_GET['page'] - 1 ?>&commandId=<?php echo $commandId ?>&cartId=<?php echo $cartId ?>&total=<?php echo $total ?>">Previous</a>

                        <?php } else { ?>
                            <a class="cursor-pointer">Previous</a>
                        <?php } ?>

                        <?php
                        for ($i = 1; $i <= $pages; $i++) {
                        ?>
                            <a href="?page=<?php echo $i ?>&commandId=<?php echo $commandId ?>&cartId=<?php echo $cartId ?>&total=<?php echo $total ?>" class=""><?php echo $i ?></a>
                        <?php
                        }
                        ?>
                        <?php
                        if (!isset($_GET['page'])) {
                            if ($pages == 1) {
                        ?>
                                <a class="cursor-pointer">Next</a>
                            <?php } else { ?>
                                <a href="?page=2&commandId=<?php echo $commandId ?>&cartId=<?php echo $cartId ?>&total=<?php echo $total ?>">Next</a>
                            <?php } ?>

                        <?php } elseif ($_GET['page'] >= $pages) { ?>
                            <a class="cursor-pointer">Next</a>
                        <?php } else { ?>
                            <a href="?page=<?php echo $_GET['page'] + 1 ?>&commandId=<?php echo $commandId ?>&cartId=<?php echo $cartId ?>&total=<?php echo $total ?>">Next</a>
                        <?php }
                        ?>
                        <a href="?page=<?php echo $pages ?>&commandId=<?php echo $commandId ?>&cartId=<?php echo $cartId ?>&total=<?php echo $total ?>">Last</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>