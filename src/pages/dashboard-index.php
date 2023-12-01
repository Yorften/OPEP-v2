<?php
include("../includes/conn.php");
session_start();

if (isset($_SESSION['client_name'])) {
    echo "You don't have permission";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("../includes/head.html") ?>
</head>

<body>
    <div class="flex flex-col justify-end items-start h-[100vh]">
        <div class="flex pl-8">
            <p class="border-gray-300 rounded-t-lg p-2 pb-1 text-xl">Commands</p>
        </div>
        <div class="border-2 border-gray-300 rounded-xl h-[90vh] w-full flex">
            <div class="flex flex-col justify-between w-full p-4">
                <?php
                $role = 1;
                $records = $conn->query("SELECT * FROM commands");
                $rows = $records->num_rows;

                $start = 0;
                $rows_per_page = 6;
                if (isset($_GET['page'])) {
                    $page = $_GET['page'] - 1;
                    $start = $page * $rows_per_page;
                }
                $select = "SELECT * FROM commands JOIN carts ON commands.cartId = carts.cartId JOIN users ON carts.userId = users.userId LIMIT ?,?";
                $stmt = $conn->prepare($select);
                $stmt->bind_param("ii", $start, $rows_per_page);
                $stmt->execute();
                $result = $stmt->get_result();
                $pages = ceil($rows / $rows_per_page);


                if ($rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $commandId = $row['commandId'];
                        $cartId = $row['cartId'];
                        $commandDate = $row['commandDate'];
                        $userName = $row['userName'];
                        $total = $row['total'];
                ?>
                        <a href="commanddetails.php?commandId=<?php echo $commandId ?>&cartId=<?php echo $cartId ?>&total=<?php echo $total ?>" class="w-full h-[100px] border-2 rounded-md bg-slate-200 hover:bg-[#bdff72] cursor-pointer">
                            <div class="w-full h-[90%] mx-auto flex items-center justify-around p-3 child:text-xl child:font-medium">
                                <p>N°: <?php echo $commandId ?></p>
                                <p><?php echo $userName ?></p>
                                <p><?php echo $commandDate ?></p>
                                <p><?php echo $total ?> DH</p>
                            </div>
                        </a>
                <?php  }
                } else {
                    echo 'No client accounts in database';
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
</body>

</html>
</body>

</html>