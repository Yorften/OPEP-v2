<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

include("src/includes/conn.php");

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/style/output.css">
    <link rel="icon" href="src/images/icon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&family=Lexend&family=Podkova&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        html {
            font-family: poppins;
        }

        #popupContent::-webkit-scrollbar {
            width: 0px;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: rgb(243 244 246 / var(--tw-bg-opacity));
        }

        #displaymenu {
            position: absolute;
            right: 0;
            background-color: white;
        }

        .show {
            display: block;
        }

        html::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            background-color: #F5F5F5;
        }

        html::-webkit-scrollbar {
            width: 15px;
            background-color: #F5F5F5;
        }

        html::-webkit-scrollbar-thumb {
            background-color: #F90;
            background-image: -webkit-linear-gradient(45deg,
                    rgba(255, 255, 255, .2) 25%,
                    transparent 25%,
                    transparent 50%,
                    rgba(255, 255, 255, .2) 50%,
                    rgba(255, 255, 255, .2) 75%,
                    transparent 75%,
                    transparent)
        }

        .popup {
            position: fixed;
            top: 0;
            right: -50%;
            height: 100vh;
            background-color: #fff;
            z-index: 1000;
            transition: right 0.3s ease;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        #popup.open {
            display: block;
            right: 0;
        }

        #popup::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
            background-color: #F5F5F5;
            border-radius: 10px;
        }

        #popup::-webkit-scrollbar {
            width: 10px;
            background-color: #F5F5F5;
        }

        #popup::-webkit-scrollbar-thumb {
            border-radius: 10px;
            background-color: #FFF;
            background-image: -webkit-gradient(linear, 40% 0%, 75% 84%, from(#4D9C41), to(#19911D), color-stop(.6, #54DE5D));
        }
    </style>
    <title>Home | O'PEP</title>
</head>

<body>

    <div class="overflow-y-hidden h-12">
        <?php
        if (isset($_SESSION['client_name'])) {
            $cartId = $_SESSION['client_cart'];
            $notselected = 0;
            $commanded = 0;
            $selected = 1;
            $select = "SELECT * FROM plants_carts JOIN plants ON plants_carts.plantId = plants.plantId WHERE cartId = ? AND isSelected = ? AND isCommanded = ?";
            $stmt = $conn->prepare($select);
            $stmt->bind_param("iii", $cartId, $notselected, $commanded);
            $stmt->execute();
            $result = $stmt->get_result();
            $count = mysqli_num_rows($result);
            $totalPrice = 0;
            $totalPrice2 = 0;

            $select2 = "SELECT * FROM plants_carts JOIN plants ON plants_carts.plantId = plants.plantId WHERE cartId = ? AND isSelected = ? AND isCommanded = ?";
            $stmt2 = $conn->prepare($select2);
            $stmt2->bind_param("iii", $cartId, $selected, $commanded);
            $stmt2->execute();
            $result2 = $stmt2->get_result();
            $count2 = mysqli_num_rows($result2);

            if (isset($_POST['deleteCart'])) {
                $plantId = $_POST['plantId'];
                $delete = "DELETE FROM plants_carts WHERE cartId = ? AND plantId = ?";
                $stmt = $conn->prepare($delete);
                $stmt->bind_param("ii", $cartId, $plantId);
                $stmt->execute();
                $stmt->close();
            }
        }
        ?>

        <nav class="bg-[#bdff72] h-12 flex justify-between items-center px-2 md:px-4">
            <div class="block w-1/3 sm:w-1/4 md:w-1/12">
                <a href="index.php">
                    <p class="text-black text-3xl">OPEP</p>
                </a>
            </div>
            <ul class="font-poppins text-black text-sm list-none [&>*]:inline-block [&>*]:mr-3 hidden md:block">
                <?php if (isset($_SESSION['admin_name'])) : ?>
                    <li>
                        <a href="src/pages/dashboard.php" class="p-2 bg-neutral-600/30 rounded-xl">
                            <span>DASHBOARD</span>
                        </a>
                    </li>
                <?php elseif (isset($_SESSION['administrator_name'])) : ?>
                    <li>
                        <a href="src/pages/controlpanel.php" class="p-2 bg-neutral-600/30 rounded-xl">
                            <span>CONTROL PANEL</span>
                        </a>
                    </li>
                <?php else : ?>
                    <li>
                        <a href="index.php">
                            <span>HOME</span>
                        </a>
                    </li>
                    <li>
                        <a href="src/pages/catalog.php">
                            <span>CATALOG</span>
                        </a>
                    </li>
                    <li>
                        <a href="src/pages/about.php">
                            <span>ABOUT US</span>
                        </a>
                    </li>
                <?php endif  ?>
            </ul>


            <div class="flex items-center justify-end gap-2">

                <div class="flex items-center">
                    <div class="dropdown">

                        <div class="flex items-center justify-center gap-6">
                            <?php if (!isset($_SESSION['client_name']) && !isset($_SESSION['admin_name']) && !isset($_SESSION['administrator_name'])) : ?>
                                <div class="child:text-black hidden md:block">
                                    <a href="src/pages/login.php" class="border-r border-black pr-2 mr-1"> Log in</a>
                                    <a href="src/pages/signup.php"> Sign up</a>
                                </div>
                            <?php else : ?>
                                <?php if (isset($_SESSION['client_name'])) : ?>
                                    <div class="child:text-black hidden md:block">
                                        <a class="border-r border-black pr-[3px] mr-1"><?php echo $_SESSION['client_name']; ?> </a>
                                        <a href="src/includes/logout.php">Log out</a>
                                    </div>
                                <?php elseif (isset($_SESSION['admin_name'])) : ?>
                                    <div class="child:text-black hidden md:block">
                                        <a class="border-r border-black pr-[3px] mr-1"><?php echo $_SESSION['client_name']; ?> </a>
                                        <a href="src/includes/logout.php">Log out</a>
                                    </div>
                                <?php else : ?>
                                    <div class="child:text-black hidden md:block">
                                        <a class="border-r border-black pr-[3px] mr-1"><?php echo $_SESSION['administrator_name']; ?> </a>
                                        <a href="src/includes/logout.php">Log out</a>
                                    </div>
                                <?php endif ?>
                            <?php endif ?>

                            <?php if (!isset($_SESSION['client_name'])) { ?>
                                <!-- <img onclick="window.location.href='src/pages/login.php'" class="open-btn dropbtn color-black cursor-pointer w-9  h-9 object-contain sm:block sm:mr-1  " src="src/images/cart.png" alt="" /> -->
                            <?php } else { ?>
                                <p id="basket-count" class="bg-amber-400 rounded-3xl w-5 h-5 text-center absolute top-2 right-[55px] sm:block sm:right-[55px] md:right-[17px] md:block">
                                    <?php echo $count ?>
                                </p>
                                <img onclick="openPopup()" class="open-btn dropbtn color-black cursor-pointer w-9  h-9 object-contain sm:block sm:mr-1  " src="src/images/cart.png" alt="" />
                            <?php } ?>
                        </div>
                    </div>
                    <div id="burgermenu" onclick="toggleBurgerMenu()" class="md:hidden md:mx-2 cursor-pointer mr-3 ml-3">
                        <span class="block w-6 h-1 my-1 mx-auto bg-white transition-all ease-in-out"></span>
                        <span class="block w-6 h-1 my-1 mx-auto bg-white transition-all ease-in-out"></span>
                        <span class="block w-6 h-1 my-1 mx-auto bg-white transition-all ease-in-out"></span>
                    </div>

                </div>
            </div>
        </nav>
        <div id="popup" class="popup w-full md:w-[30%] overflow-y-auto">
            <!-- Content -->
            <div class="flex flex-col gap-1">
                <div class="fixed w-7/12 h-8 bg-[#19911D]">
                    <div class="flex justify-between h-3 pl-5 pt-2 ">
                        <div onclick="closePopup()" class="text-2xl font-bold cursor-pointer mr-3">
                            <img class="h-12 object-contain" src="src/images/next button.svg" alt="">
                        </div>
                    </div>
                </div>
                <div class="p-3 mt-6">
                    <?php
                    if ($count > 0) {
                    ?>
                        <p class="text-center text-lg font-medium mb-3">Your Items</p>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {    
                            $plantId = $row['plantId'];
                            $plantName = $row['plantName'];
                            $plantImage = $row['plantImage'];
                            $plantPrice = $row['plantPrice'];
                            $quantity = $row['quantity'];
                        ?>
                            <div class="flex flex-col relative border-2 border-gray-400 w-full h-[140px] rounded-md mb-2">
                                <div class="flex items-center justify-end w-full bg-[#19911D] h-4 rounded-tl-[4px] rounded-tr-[4px]">
                                </div>
                                <div class="flex gap-2 flex-col items-center justify-between md:flex-row">
                                    <img class="object-contain h-[124px]" src="src/images/Plants/<?php echo $plantImage ?>" alt="">
                                    <div class="flex flex-col justify-center items-start gap-2">
                                        <p><?php echo $plantName ?></p>
                                        <p>Quantity: <?php echo $quantity ?></p>
                                        <div class="flex gap-1 items-center">
                                            <p>Price: <?php echo $plantPrice ?> DH</p>
                                            <p class=" text-xs">per unit</p>
                                        </div>
                                    </div>
                                    <div class="flex flex-col justify-end h-full gap-2 pr-2 pb-2">
                                        <a href="src/pages/deleteitem.php?plantId=<?php echo $plantId ?>" class="p-1 bg-red-500 border border-black rounded-lg">Remove</a>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        mysqli_data_seek($result, 0);
                    } else {
                        ?>
                        <div class="flex flex-col items-center justify-center h-[90vh] text-xl font-medium">
                            <p>No items in your cart</p>
                        </div>
                    <?php
                    }

                    ?>

                </div>
                <div class="fixed w-[30%] h-14 bottom-0 p-1 bg-white">
                    <div class="flex justify-evenly">
                        <?php if ($count > 0) { ?>
                            <a class="border border-black bg-[#19911D] font-semibold p-1 hover:bg-[#5edb64] rounded-md" href="src/pages/checkout.php">Checkout</a>
                            <a class="border border-black bg-[#19911D] font-semibold p-1 hover:bg-[#5edb64] rounded-md" href="src/pages/emptycart.php">Empty cart</a>
                        <?php } else { ?>

                        <?php  } ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="displaymenu" class="flex flex-col border-2 border-t-0 border-amber-600 items-center justify-center burger-content w-full py-6 hidden md:hidden">
            <div class="flex flex-col items-center divide-y-2 gap-6 w-full divide-amber-600">
                <?php if (!isset($_SESSION['client_name']) && !isset($_SESSION['admin_name']) && !isset($_SESSION['administrator_name'])) : ?>
                    <div class="child:text-black child:text-lg">
                        <a href="src/pages/login.php" class="border-r border-black pr-1"> Log in</a>
                        <a href="src/pages/signup.php"> Sign up</a>
                    </div>
                <?php else : ?>
                    <?php if (isset($_SESSION['client_name'])) : ?>
                        <div class="flex justify-around items-center w-full child:text-black child:text-xl">
                            <p><?php echo $_SESSION['client_name']; ?> </p>
                            <a href="src/includes/logout.php">Log out</a>
                        </div>

                    <?php elseif (isset($_SESSION['admin_name'])) : ?>
                        <div class="flex justify-around items-center w-full child:text-black child:text-lg">
                            <p><?php echo $_SESSION['admin_name']; ?> </p>
                            <a href="src/includes/logout.php">Log out</a>
                        </div>
                    <?php else : ?>
                        <div class="flex justify-around items-center w-full child:text-black child:text-lg">
                            <p><?php echo $_SESSION['administrator_name']; ?> </p>
                            <a href="src/includes/logout.php">Log out</a>
                        </div>
                    <?php endif ?>
                <?php endif ?>
                <?php if (isset($_SESSION['administrator_name'])) : ?>
                    <div class="pt-6 text-xl font-semibold w-[90%] flex justify-center">
                        <a href="src/pages/controlpanel.php">
                            <span>CONTROLPANEL</span>
                        </a>
                    </div>
                <?php elseif (isset($_SESSION['admin_name'])) : ?>
                    <div class="pt-6 text-xl font-semibold w-[90%] flex justify-center">
                        <a href="src/pages/dashboard.php">
                            <span>DASHBOARD</span>
                        </a>
                    </div>
                <?php else : ?>
                    <div class="pt-6 text-xl font-semibold w-[90%] flex justify-center">
                        <a href="index.php">
                            <span>HOME</span>
                        </a>
                    </div>
                    <div class="pt-6 text-xl font-semibold w-[90%] flex justify-center">
                        <a href="src/pages/catalog.php">
                            <span>CATALOG</span>
                        </a>
                    </div>
                    <div class="pt-6 text-xl font-semibold w-[90%] flex justify-center">
                        <a href="src/pages/about.php">
                            <span>ABOUT US</span>
                        </a>
                    </div>
                <?php endif  ?>
            </div>
        </div>
    </div>

    <main class="h-[53.9vh] bg-[url('/OPEP/src/images/hero.webp')] bg-cover bg-no-repeat">
        <div class="flex flex-col items-start justify-center h-full w-[40%] ml-[10%] gap-4">
            <h1 class="text-[42px] text-white font-medium stroke-1 stroke-black">Your online shop for houseplants and more!</h1>
            <a href="src/pages/catalog.php" class="text-md font-medium p-2 w-42 bg-amber-300 border-2 border-amber-400 rounded-2xl">Shop all plants</a>*
        </div>
    </main>
        <div class="bg-[#bdff72] ">
            <div class="flex flex-col gap-10 text-center md:gap-0 md:flex md:flex-row md:items-center md:justify-around md:pt-12">
                <div class=" mt-3 text-black flex flex-col md:mt-0 gap-3">
                    <a href="#">Home</a>
                    <a href="src/pages/catalog.php">Our Catalog</a>
                    <a href="src/pages/about.php">About Us</a>
                </div>
                <div class="text-black flex flex-col gap-5 ">
                    <p>CONTACT</p>
                    <p>Rue Al Medina El Mounawara, Safi</p>
                    <p class="font-bold">TEL:020 7131 3535</p>
                </div>
                <div class="text-black flex flex-col gap-5 items-center md:mt-5 md:gap-10">
                    <a href="index.php" class="h-5">
                        <p class="text-black text-3xl">OPEP</p>
                    </a>
                    <div class="flex space-x-2">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="Social Icons">
                                <path id="BG" opacity="0.1" fill-rule="evenodd" clip-rule="evenodd" d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="black" />
                                <path id="Path" fill-rule="evenodd" clip-rule="evenodd" d="M12.0007 5.59998C10.2625 5.59998 10.0444 5.60758 9.36174 5.63864C8.6804 5.66984 8.21533 5.77771 7.80839 5.93598C7.38745 6.09945 7.03038 6.31812 6.67464 6.67399C6.31864 7.02972 6.09997 7.38679 5.93597 7.8076C5.7773 8.21467 5.6693 8.67987 5.63863 9.36095C5.6081 10.0436 5.6001 10.2619 5.6001 12C5.6001 13.7382 5.60783 13.9557 5.63876 14.6383C5.6701 15.3197 5.77797 15.7847 5.9361 16.1917C6.0997 16.6126 6.31837 16.9697 6.67424 17.3254C7.02985 17.6814 7.38692 17.9006 7.80759 18.0641C8.21479 18.2224 8.68 18.3302 9.3612 18.3614C10.0439 18.3925 10.2619 18.4001 11.9999 18.4001C13.7382 18.4001 13.9557 18.3925 14.6383 18.3614C15.3197 18.3302 15.7853 18.2224 16.1925 18.0641C16.6133 17.9006 16.9698 17.6814 17.3254 17.3254C17.6814 16.9697 17.9001 16.6126 18.0641 16.1918C18.2214 15.7847 18.3294 15.3195 18.3614 14.6385C18.3921 13.9558 18.4001 13.7382 18.4001 12C18.4001 10.2619 18.3921 10.0438 18.3614 9.36108C18.3294 8.67974 18.2214 8.21467 18.0641 7.80773C17.9001 7.38679 17.6814 7.02972 17.3254 6.67399C16.9694 6.31798 16.6134 6.09931 16.1921 5.93598C15.7841 5.77771 15.3187 5.66984 14.6374 5.63864C13.9547 5.60758 13.7374 5.59998 11.9987 5.59998H12.0007ZM11.4265 6.7533C11.5969 6.75304 11.7871 6.7533 12.0007 6.7533C13.7095 6.7533 13.912 6.75944 14.5868 6.7901C15.2108 6.81864 15.5495 6.9229 15.7751 7.01051C16.0738 7.12651 16.2867 7.26517 16.5106 7.48918C16.7346 7.71318 16.8733 7.92652 16.9895 8.22518C17.0771 8.45052 17.1815 8.78919 17.2099 9.4132C17.2406 10.0879 17.2473 10.2905 17.2473 11.9986C17.2473 13.7066 17.2406 13.9092 17.2099 14.5839C17.1814 15.2079 17.0771 15.5466 16.9895 15.7719C16.8735 16.0706 16.7346 16.2833 16.5106 16.5071C16.2866 16.7311 16.0739 16.8698 15.7751 16.9858C15.5498 17.0738 15.2108 17.1778 14.5868 17.2063C13.9122 17.237 13.7095 17.2437 12.0007 17.2437C10.2917 17.2437 10.0892 17.237 9.41451 17.2063C8.7905 17.1775 8.45183 17.0733 8.2261 16.9857C7.92743 16.8697 7.71409 16.731 7.49009 16.507C7.26609 16.283 7.12742 16.0702 7.01115 15.7714C6.92355 15.5461 6.81915 15.2074 6.79075 14.5834C6.76008 13.9087 6.75395 13.706 6.75395 11.997C6.75395 10.2879 6.76008 10.0863 6.79075 9.4116C6.81928 8.78759 6.92355 8.44892 7.01115 8.22332C7.12715 7.92465 7.26609 7.71131 7.49009 7.48731C7.71409 7.26331 7.92743 7.12464 8.2261 7.00837C8.4517 6.92037 8.7905 6.81637 9.41451 6.7877C10.0049 6.76104 10.2337 6.75304 11.4265 6.7517V6.7533ZM15.417 7.81598C14.993 7.81598 14.649 8.15959 14.649 8.58372C14.649 9.00773 14.993 9.35173 15.417 9.35173C15.841 9.35173 16.185 9.00773 16.185 8.58372C16.185 8.15972 15.841 7.81598 15.417 7.81598ZM12.0007 8.71332C10.1856 8.71332 8.71401 10.1849 8.71401 12C8.71401 13.8151 10.1856 15.2861 12.0007 15.2861C13.8158 15.2861 15.2869 13.8151 15.2869 12C15.2869 10.1849 13.8158 8.71332 12.0007 8.71332ZM12.0007 9.86667C13.1788 9.86667 14.134 10.8217 14.134 12C14.134 13.1782 13.1788 14.1334 12.0007 14.1334C10.8224 14.1334 9.86733 13.1782 9.86733 12C9.86733 10.8217 10.8224 9.86667 12.0007 9.86667Z" fill="black" />
                            </g>
                        </svg>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="Social Icons">
                                <path id="BG" opacity="0.1" fill-rule="evenodd" clip-rule="evenodd" d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="black" />
                                <path id="Path" fill-rule="evenodd" clip-rule="evenodd" d="M11.6406 9.7537L11.6658 10.1689L11.2461 10.1181C9.71843 9.92318 8.38383 9.26221 7.25067 8.15211L6.69668 7.6013L6.55399 8.00805C6.25181 8.91477 6.44487 9.87234 7.0744 10.5164C7.41015 10.8723 7.33461 10.9231 6.75544 10.7113C6.55399 10.6435 6.37772 10.5926 6.36093 10.6181C6.30218 10.6774 6.50363 11.4485 6.66311 11.7536C6.88134 12.1773 7.32621 12.5925 7.81305 12.8382L8.22434 13.0331L7.73751 13.0416C7.26746 13.0416 7.25067 13.0501 7.30103 13.2281C7.46891 13.7789 8.13201 14.3636 8.87066 14.6178L9.39108 14.7957L8.93781 15.0669C8.26631 15.4567 7.4773 15.677 6.68829 15.694C6.31057 15.7025 6 15.7364 6 15.7618C6 15.8465 7.02404 16.3211 7.61999 16.5075C9.40786 17.0583 11.5315 16.821 13.1263 15.8804C14.2595 15.211 15.3926 13.8806 15.9214 12.5925C16.2068 11.9061 16.4922 10.6519 16.4922 10.0503C16.4922 9.66049 16.5174 9.60964 16.9874 9.14357C17.2644 8.8724 17.5246 8.57581 17.575 8.49107C17.6589 8.33007 17.6505 8.33007 17.2224 8.47412C16.509 8.72834 16.4083 8.69445 16.7608 8.31312C17.021 8.04195 17.3316 7.55046 17.3316 7.4064C17.3316 7.38098 17.2057 7.42335 17.063 7.49961C16.9119 7.58435 16.5761 7.71146 16.3243 7.78773L15.8711 7.93179L15.4598 7.65214C15.2331 7.49961 14.9142 7.33013 14.7463 7.27929C14.3182 7.16065 13.6635 7.1776 13.2774 7.31318C12.2282 7.69451 11.5651 8.6775 11.6406 9.7537Z" fill="black" />
                            </g>
                        </svg>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="Social Icons">
                                <path id="BG" opacity="0.1" fill-rule="evenodd" clip-rule="evenodd" d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="black" />
                                <path id="Path" fill-rule="evenodd" clip-rule="evenodd" d="M17.0009 7.87464C17.5517 8.02577 17.9854 8.47108 18.1326 9.03659C18.4001 10.0615 18.4001 12.2 18.4001 12.2C18.4001 12.2 18.4001 14.3384 18.1326 15.3634C17.9854 15.9289 17.5517 16.3742 17.0009 16.5254C16.0028 16.8 12.0001 16.8 12.0001 16.8C12.0001 16.8 7.99741 16.8 6.99923 16.5254C6.44846 16.3742 6.01472 15.9289 5.86752 15.3634C5.6001 14.3384 5.6001 12.2 5.6001 12.2C5.6001 12.2 5.6001 10.0615 5.86752 9.03659C6.01472 8.47108 6.44846 8.02577 6.99923 7.87464C7.99741 7.59998 12.0001 7.59998 12.0001 7.59998C12.0001 7.59998 16.0028 7.59998 17.0009 7.87464ZM10.8001 10.3999V14.3999L14.0001 12.4L10.8001 10.3999Z" fill="black" />
                            </g>
                        </svg>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="Social Icons">
                                <path id="BG" opacity="0.1" fill-rule="evenodd" clip-rule="evenodd" d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="black" />
                                <path id="Path" fill-rule="evenodd" clip-rule="evenodd" d="M18.4001 11.9911C18.4001 12.4239 18.356 12.8561 18.2695 13.2775C18.1851 13.6888 18.0601 14.0926 17.8963 14.4786C17.7363 14.8578 17.5379 15.2232 17.306 15.5639C17.0776 15.9026 16.8144 16.2202 16.5253 16.5098C16.2356 16.7982 15.9169 17.0606 15.5784 17.29C15.2365 17.5203 14.8706 17.7184 14.4912 17.8792C14.1046 18.0421 13.6999 18.1669 13.2889 18.2511C12.867 18.3379 12.4333 18.3822 11.9998 18.3822C11.566 18.3822 11.1323 18.3379 10.711 18.2511C10.2994 18.1669 9.89471 18.0421 9.50844 17.8792C9.12905 17.7184 8.76277 17.5203 8.42088 17.29C8.08243 17.0606 7.76366 16.7982 7.47458 16.5098C7.1852 16.2202 6.92205 15.9026 6.69329 15.5639C6.46265 15.2232 6.26388 14.8577 6.10326 14.4786C5.93948 14.0926 5.81418 13.6887 5.72948 13.2775C5.64386 12.8561 5.6001 12.4239 5.6001 11.9911C5.6001 11.558 5.64384 11.1248 5.72951 10.7044C5.8142 10.2931 5.9395 9.88869 6.10328 9.5033C6.2639 9.12384 6.46268 8.75811 6.69332 8.41731C6.92207 8.07842 7.18523 7.76134 7.47461 7.47143C7.76369 7.18307 8.08245 6.92127 8.42091 6.69222C8.76279 6.46096 9.12908 6.26282 9.50846 6.10178C9.89474 5.93854 10.2994 5.81342 10.711 5.7298C11.1323 5.64368 11.5661 5.59998 11.9998 5.59998C12.4333 5.59998 12.8671 5.64368 13.2889 5.7298C13.6999 5.81345 14.1046 5.93857 14.4912 6.10178C14.8706 6.2628 15.2366 6.46096 15.5784 6.69222C15.9169 6.92127 16.2357 7.18307 16.5254 7.47143C16.8144 7.76134 17.0776 8.07842 17.306 8.41731C17.5379 8.75811 17.7363 9.12386 17.8963 9.5033C18.0601 9.88869 18.1851 10.2931 18.2695 10.7044C18.356 11.1248 18.4001 11.558 18.4001 11.9911ZM9.66779 7.05451C8.14363 7.77322 7.00607 9.17563 6.65136 10.8658C6.79545 10.867 9.07307 10.8958 11.6973 10.1995C10.7513 8.52121 9.74061 7.15159 9.66779 7.05451ZM12.1501 11.0399C9.33589 11.8812 6.63543 11.8207 6.53856 11.817C6.53698 11.8756 6.53417 11.9324 6.53417 11.9911C6.53417 13.3932 7.06389 14.6714 7.93456 15.6379C7.93268 15.6351 9.4284 12.9853 12.3779 12.0329C12.4492 12.0092 12.5217 11.988 12.5936 11.9674C12.4564 11.6572 12.3067 11.3464 12.1501 11.0399ZM15.6094 7.89491C14.6471 7.04764 13.3836 6.5337 11.9998 6.5337C11.5557 6.5337 11.1247 6.58738 10.7119 6.68661C10.7938 6.79647 11.8204 8.15644 12.7551 9.87028C14.8174 9.09824 15.5959 7.91488 15.6094 7.89491ZM12.9661 12.8717C12.9539 12.8758 12.9418 12.8793 12.9299 12.8836C9.70507 14.0062 8.65196 16.2685 8.64057 16.2932C9.56845 17.0138 10.7323 17.4485 11.9998 17.4485C12.7567 17.4485 13.4777 17.2946 14.1337 17.016C14.0527 16.5391 13.7352 14.8677 12.9661 12.8717ZM15.054 16.5173C16.2812 15.6903 17.1528 14.3772 17.396 12.8561C17.2835 12.8199 15.7543 12.3365 13.9902 12.619C14.7071 14.5862 14.9984 16.1884 15.054 16.5173ZM13.1758 10.6835C13.3027 10.9438 13.4255 11.2087 13.539 11.4749C13.5793 11.5704 13.6187 11.6641 13.6571 11.7577C15.5347 11.5217 17.3845 11.9187 17.4635 11.9349C17.451 10.6411 16.9876 9.45367 16.2207 8.52404C16.2104 8.53867 15.3338 9.80349 13.1758 10.6835Z" fill="black" />
                            </g>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="  md:text-center md:text-black md:pt-16  ">
                <p>© 2023 O'PEP. All Rights Reserved.</p>
            </div>
            <div class="text-center text-black pt-10   md:hidden  ">
                <p>© All Rights Reserved</p>
            </div>
        </div>
    <script src="src/js/burger.js"></script>
    <script src="src/js/cartmenu.js"></script>
</body>

</html>