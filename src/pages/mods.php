<?php
include("../includes/conn.php");
session_start();

if (!isset($_SESSION['administrator_name'])) {
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
            <p class="border-gray-300 rounded-t-lg p-2 pb-1 text-xl">Moderators</p>
        </div>
        <div class="border-2 border-gray-300 rounded-xl h-[90vh] flex">

            <div id="mods" class="flex flex-col justify-between w-full p-4">
                <?php
                $role = 2;
                $records = $conn->query("SELECT * FROM users WHERE roleId = $role");
                $rows = $records->num_rows;

                $start = 0;
                $rows_per_page = 8;
                if (isset($_GET['page'])) {
                    $page = $_GET['page'] - 1;
                    $start = $page * $rows_per_page;
                }
                $select = "SELECT * FROM users WHERE roleId = ? LIMIT ?,?";
                $stmt = $conn->prepare($select);
                $stmt->bind_param("iii", $role, $start, $rows_per_page);
                $stmt->execute();
                $result = $stmt->get_result();
                $pages = ceil($rows / $rows_per_page);



                if ($rows > 0) {
                    echo ' 
        <table class="border-collapse table-fixed w-full ">
            <thead class="border">
                <tr class="border-2">
                    <th class="w-1/5 px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base">Client Id</th>
                    <th class="w-1/5 px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base">Name</th>
                    <th class="w-2/5 px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base">Email</th>
                    <th class="w-1/5 px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base">Status</th>
                </tr>
            </thead>
            <tbody>';
                    while ($row = mysqli_fetch_assoc($result)) {
                        $name = htmlspecialchars($row['userName']);
                        $id = htmlspecialchars($row['userId']);
                        $email = htmlspecialchars($row['userEmail']);
                        $status = htmlspecialchars($row['isVerified']);
                        echo '
                <tr>
                    <td class="px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base">' . $id . '</td>
                    <td class="px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base">' . $name . '</td>
                    <td class="px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base">' . $email . '</td>
            ';
                        if ($status == 1) {
                            echo '
                    <td class="px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base text-center">
                        <a href="changestatus.php?id=' . $id . '&status=' . $status . '" class="p px-2 rounded-md bg-green-600"> Active </a>
                    </td>';
                        } else {
                            echo '
                    <td class="px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base text-center">
                        <a href="changestatus.php?id=' . $id . '&status=' . $status . '" class="p px-2 rounded-md bg-red-600"> Disabled </a>
                    </td>';
                        }
                        echo '</tr>';
                    }
                    echo '
            </tbody>
        </table>
        
        ';
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