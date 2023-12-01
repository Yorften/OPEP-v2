<?php

include("../includes/conn.php");
session_start();

if (!isset($_SESSION['client_name'])) {
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

    <?php include("../includes/nav.php") ?>
    <div class="flex justify-around items-center w-[90%] mx-auto">
        <div class="flex gap-8 flex-col w-3/4 mx-auto">
            <h1 class="text-2xl font-medium">OPEP feels like your favourite specialist shop.</h1>
            <p>A nice, warm and green environment where you can feast your eyes on the most extraordinary assortment of plants. At PLNTS.com, you imagine yourself in a shop full of your favourite specimens. A place where you can find exactly the right plant that suits you or where we help you find the right match: a plant that gives your home that extra bit of personality. A plant to challenge yourself and your green thumb with. Or the rarest plant to make your plant collection completely unique.</p>
        </div>
        <div>
            <img class=" object-contain w-full" src="../images/about.avif" alt="">
        </div>
    </div>
    <?php include("../includes/footer.html") ?>

    <script src="../js/burger.js"></script>
    <script src="../js/cart.js"></script>
    <script src="../js/cartmenu.js"></script>
</body>

</html>