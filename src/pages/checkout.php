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
    <title>Checkout | O'PEP</title>
</head>

<body>

    <?php include("../includes/nav.php");


    ?>
    <div class="flex justify-evenly mx-auto mt-6 mb-[15.5vh]">
        <div class="flex flex-col gap-1 h-full border-2 border-gray-400 rounded-md p-3 w-[40%]">
            <p class="text-center text-lg font-medium">Your Items</p>
            <?php if ($count === 0) { ?>
                <div class="flex flex-col relative border-2 border-gray-400 md:h-[140px] rounded-md mb-2">
                    <div class="flex gap-2 flex-col items-center justify-center h-full md:flex-row">
                        <p>No items in cart</p>
                    </div>
                </div>
                <?php  } else {
                while ($row = mysqli_fetch_assoc($result)) {
                    $plantId = $row['plantId'];
                    $plantName = $row['plantName'];
                    $plantImage = $row['plantImage'];
                    $plantPrice = $row['plantPrice'];
                    $quantity = $row['quantity'];
                    $isSelected = $row['isSelected'];
                    $plantPrice = $plantPrice * $quantity;
                    $totalPrice = $totalPrice + $plantPrice ?>
                    <div class="flex flex-col relative border-2 border-gray-400 w-full h-[140px] rounded-md mb-2">
                        <div class="flex items-center justify-end w-full bg-[#19911D] h-4 rounded-tl-[4px] rounded-tr-[4px]">
                        </div>
                        <div class="flex gap-2 flex-col items-center justify-between md:flex-row">
                            <img class="object-contain h-[124px]" src="../images/Plants/<?php echo $plantImage ?>" alt="">
                            <div class="flex flex-col justify-center items-start w-2/5 h-full gap-1 py-4 child:text-lg">
                                <p><?php echo $plantName ?></p>
                                <p>Price: <?php echo $plantPrice ?> DH</p>
                            </div>
                            <div class="flex flex-col justify-center items-center">
                                <p>Quantity: <?php echo $quantity ?></p>
                                <div class="flex justify-between items-center w-full gap-1">
                                    <?php if ($quantity === 1) { ?>
                                        <p class="p-1 text-center font-bold text-xl w-[35px] select-none h-[35px] border-2 border-black rounded-lg">-</p>
                                    <?php } else { ?>
                                        <a href="item_reduction.php?plantId=<?php echo $plantId ?>&quantity=<?php echo $quantity ?>" class="p-1 text-center font-bold text-xl w-[35px] hover:bg-amber-400 h-[35px] select-none border-2 border-black rounded-lg">-</a>
                                    <?php } ?>
                                    <a href="item_increment.php?plantId=<?php echo $plantId ?>&quantity=<?php echo $quantity ?>" class="p-1 text-center font-bold text-xl w-[35px] hover:bg-amber-400 h-[35px] select-none border-2 border-black rounded-lg">+</a>

                                </div>
                            </div>
                            <div class="flex flex-col justify-between items-end h-full gap-2 pr-2 py-2">
                                <a href="cart_checkout.php?plantId=<?php echo $plantId ?>&isSelected=<?php echo $isSelected ?>" class="p-1 text-center font-bold text-xl w-[40px] border-2 border-black rounded-lg hover:bg-amber-400">></a>
                                <a href="deleteitem.php?plantId=<?php echo $plantId ?>" class="p-1 bg-red-500 border border-black rounded-lg">Remove</a>
                            </div>
                        </div>

                    </div>
                <?php }
            }
            if ($totalPrice > 0) { ?>
                <div class="flex items-end justify-between w-full gap-2 pr-1 pt-3">
                    <p class="text-lg">Total: <?php echo $totalPrice ?> DH</p>
                    <a href="check_all_items.php?total=<?php echo $totalPrice ?>" class="p-1 bg-[#bdff72] border border-black rounded-lg">Checkout All</a>
                </div>
            <?php } else { ?>
                <div class="flex items-end justify-between w-full gap-2 pr-1 pt-3">
                </div>
            <?php } ?>
        </div>
        <!-- Wanted Items -->
        <div class="flex flex-col gap-1 h-full border-2 border-gray-400 rounded-md p-3">
            <p class="text-center text-lg font-medium">Selected Items</p>
            <?php if ($count2 === 0) { ?>
                <div class="flex flex-col relative border-2 border-gray-400 md:h-[140px] md:w-[371px] rounded-md mb-2">
                    <div class="flex gap-2 flex-col items-center justify-center h-full md:flex-row">
                        <p>No items to checkout</p>
                    </div>
                </div>
                <?php  } else {
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    $plantId = $row2['plantId'];
                    $plantName = $row2['plantName'];
                    $plantImage = $row2['plantImage'];
                    $plantPrice = $row2['plantPrice'];
                    $quantity = $row2['quantity'];
                    $isSelected = $row2['isSelected'];
                    $plantPrice = $plantPrice * $quantity;
                    $totalPrice2 = $totalPrice2 + $plantPrice ?>
                    <div class="flex flex-col relative border-2 border-gray-400 w-full h-[140px] rounded-md mb-2">
                        <div class="flex items-center justify-end w-full bg-[#19911D] h-4 rounded-tl-[4px] rounded-tr-[4px]">
                        </div>
                        <div class="flex gap-2 flex-col items-center justify-between md:flex-row">
                            <img class="object-contain h-[124px]" src="../images/Plants/<?php echo $plantImage ?>" alt="">
                            <div class="flex flex-col justify-center items-start gap-2">
                                <p><?php echo $plantName ?></p>
                                <p>Quantity: <?php echo $quantity ?></p>
                                <p>Price: <?php echo $plantPrice ?> DH</p>
                                </p>
                            </div>
                            <div class="flex flex-col justify-between items-end h-full gap-2 pr-2 py-2">
                                <a href="cart_checkout.php?plantId=<?php echo $plantId ?>&isSelected=<?php echo $isSelected ?>" class="p-1 text-center font-bold text-xl w-[40px] border-2 border-black rounded-lg hover:bg-amber-400">
                                    < </a>
                                        <a href="deleteitem.php?plantId=<?php echo $plantId ?>" class="p-1 bg-red-500 border border-black rounded-lg">Remove</a>
                            </div>
                        </div>
                    </div>
                <?php }
            }
            if ($totalPrice2 > 0) { ?>
                <div class="flex items-end justify-between w-full gap-2 pr-1 pt-3">
                    <p class="text-lg">Total: <?php echo $totalPrice2 ?> DH</p>
                    <a href="check_selected.php?total=<?php echo $totalPrice2 ?>" class="p-1 bg-[#bdff72] border border-black rounded-lg">Checkout Selected</a>
                </div>
            <?php } else { ?>
                <div class="flex items-end justify-end w-full gap-2 pr-1 pt-3">
                </div>
            <?php } ?>
        </div>
    </div>


    <?php include("../includes/footer.html") ?>

    <script src="../js/burger.js"></script>
    <script src="../js/filter.js"></script>
    <script src="../js/cartmenu.js"></script>
</body>

</html>