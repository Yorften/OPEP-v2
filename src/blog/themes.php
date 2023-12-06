<?php
include("../includes/conn.php");
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("../includes/head.html") ?>
    <title>Themes Home | OPEP</title>
</head>

<body class=" h-[84vh]">
    <?php include("../includes/nav_blog.php"); ?>
    <h1 class="text-center m-4 text-xl">THE HOUSEPLANT & URBAN JUNGLE BLOG</h1>
    <div class="container flex justify-center align-middle  h-[84vh]">
        <div class="h-96 w-11/12">
            <?php
            // Put The loop below This Section
            ?>
            <div class=" bg-white shadow-lg shadow-gray-300 m-7 p-4  align-middle w-11/12 rounded-lg">
                <h3 class="flex justify-between text-white-50"> <a href="./articles.php">Title</a> <span class=" text-xl cursor-pointer hover:text-green-300 "><i class='bx bx-bookmark w-6'></i></span>
                </h3>
            </div>
            <?php
            // This Tag of Php For End the loop 
            ?>
            <div class=" bg-white shadow-lg shadow-gray-300 m-7 p-4  align-middle w-11/12 rounded-lg">
                <h3 class="flex justify-between text-white-50">Title <span class=" text-xl cursor-pointer hover:text-green-300 "><i class='bx bx-bookmark w-6'></i></span>
                </h3>
            </div>

            <div class=" bg-white shadow-lg shadow-gray-300 m-7 p-4  align-middle w-11/12 rounded-lg">
                <h3 class="flex justify-between text-white-50">Title <span class=" text-xl cursor-pointer hover:text-green-300 "><i class='bx bx-bookmark w-6'></i></span>
                </h3>
            </div>
        </div>
    </div>
    <?php include("../includes/footer_blog.html"); ?>
</body>

</html>