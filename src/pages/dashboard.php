<?php

include("../includes/conn.php");
session_start();

if (isset($_SESSION['administrator_name'])) {
    header('location:controlpanel.php');
    exit;
}elseif(!isset($_SESSION['admin_name'])){
    echo "You don't have permission";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("../includes/head.html") ?>
    <title>Dashboard</title>
</head>

<body>
    <div class="flex h-[95vh]">
        <!-- Fixed menu -->
        <div class="flex flex-col p-5 w-64 bg-[#bdff72]">
            <div class="block mb-5 w-1/3 sm:w-1/4 md:w-1/12">
                <a href="../../index.php">
                    <p class="text-black text-3xl">OPEP</p>
                </a>
            </div>
            <p class="text-xl font-bold">Navigation</p>
            <div class="flex flex-col justify-evenly h-full">
                <div class="flex flex-col">
                    <p class=" font-semibold">PRODUCTS</p>
                    <a href="dashboard-index.php" target="contentFrame">Commands</a>
                    <a href="categories.php" target="contentFrame">Categories</a>
                    <a href="plants.php" target="contentFrame">Plants</a>
                </div>
                <hr class="border-black w-full">
                <div class="flex flex-col">
                    <p class=" font-semibold">ACCOUNTS</p>
                    <a href="users.php" target="contentFrame">Users</a>
                </div>
                <hr class="border-black w-full">
                <div class="flex flex-col">
                    <p class="font-semibold">BLOG</p>
                    <a href="../blogpages/tags.php" target="contentFrame">Tags</a>
                    <a href="../blogpages/themes.php" target="contentFrame">Themes</a>
                    <a href="../blogpages/articles.php" target="contentFrame">Articles</a>
                </div>
            </div>
        </div>
        <!-- Content -->
        <div class="flex flex-col flex-1 p-5 pt-3 gap-2">
            <div class="self-end child:text-black md:block">
                <a class="border-r border-black pr-[2px] mr-1"><?php echo $_SESSION['admin_name']; ?> </a>
                <a href="../includes/logout.php">Log out</a>
            </div>
            <iframe id="contentFrame" name="contentFrame" src="dashboard-index.php" frameborder="0" width="100%" height="100%"></iframe>
        </div>
    </div>


    <?php include("../includes/footer_admin.html") ?>

</body>

</html>