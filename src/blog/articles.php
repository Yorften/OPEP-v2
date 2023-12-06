<?php
include "../includes/conn.php";
$requetearticles = "SELECT * FROM Articles ";
$stmtt = $conn->query($requetearticles);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("../includes/head.html") ?>
    <title>Document</title>
</head>

<body>
    <?php include("../includes/nav_blog.php"); ?>
    <header class="block justify-center items-center py-16 bg-white shadow-lg text-center">
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores nostrum repellat odit iste tempore
            cupiditate! Pariatur architecto mollitia aliquam molestiae quia ab expedita, nesciunt recusandae, dolorum
            dolorem molestias fuga quam.</p>
        <div class="flex items-center justify-center bg-gray-100 rounded border border-gray-200 m-10">
            <input type="text" name="search" placeholder="Search"
                class="flex items-center align-middle justify-center bg-transparent py-1 text-gray-600 px-4 focus:outline-none w-full" />
            <button
                class="py-2 px-4 bg-[#bdff72] text-black rounded-r border-l border-gray-200 hover:bg-gray-50 active:bg-gray-200 disabled:opacity-50 inline-flex items-center focus:outline-none">
                Search
            </button>
        </div>

    </header>
    <div class="container flex justify-center align-middle  h-[84vh]">
        <div class="h-96 w-11/12 m-5">
            <?php
            // while ($article = mysqli_fetch_assoc($stmtt)) : 
            ?>
            <div class=" bg-white shadow-lg shadow-gray-300 m-7 p-4  align-middle w-11/12 rounded-lg">

                <h3 class="flex justify-between text-white-50"> Title<span
                        class=" text-xl cursor-pointer hover:text-green-300 "><i class='bx bx-bookmark w-6'></i></span>
                </h3>
                <p class="text-gray-800 m-2">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Laudantium,
                    temporibus
                    ullam
                    sequi
                    non
                    sapiente voluptate laboriosam labore nihil, natus excepturi sint. Exercitationem, necessitatibus
                    aliquid? Quis totam vero a consequatur quae?</p>

                <div class="flex justify-between m-1">
                    <small class="text-gray-500 flex"><i
                            class='bx bx-user text-black text-xl rounded-xl border-black'></i>
                        Poted By </small>
                    <h5 class="flex justify-end"><a href="./articlePage.php">Read More</a></h5>
                </div>

            </div>
            <?php
            // This Tag of Php For End the loop 
            // endwhile;
            ?>
        </div>
    </div>
    <?php include("../includes/footer_blog.html"); ?>
</body>

</html>