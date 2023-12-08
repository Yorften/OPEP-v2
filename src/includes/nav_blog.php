<nav class="bg-[#bdff72] h-12 flex justify-between items-center px-2 md:px-4">
    <div class="block w-1/3 sm:w-1/4 md:w-1/12">
        <a href="../../index.php">
            <p class="text-black text-3xl">OPEP</p>
        </a>
    </div>
    <ul class="font-poppins text-black text-sm list-none [&>*]:inline-block [&>*]:mr-3 hidden md:block">
        <?php if (isset($_SESSION['admin_name'])) : ?>
        <li>
            <a href="../pages/dashboard.php" class="p-2 bg-neutral-600/30 rounded-xl">
                <span>DASHBOARD</span>
            </a>
        </li>
        <li>
            <a href="themes.php">
                <span>BLOG</span>
            </a>
        </li>
        <?php elseif (isset($_SESSION['administrator_name'])) : ?>
        <li>
            <a href="../pages/controlpanel.php" class="p-2 bg-neutral-600/30 rounded-xl">
                <span>CONTROL PANEL</span>
            </a>
        </li>
        <li>
            <a href="themes.php">
                <span>BLOG</span>
            </a>
        </li>
        <?php else : ?>
        <li>
            <a href="../../index.php">
                <span>HOME</span>
            </a>
        </li>
        <li>
            <a href="../pages/catalog.php">
                <span>CATALOG</span>
            </a>
        </li>
        <li>
            <a href="../pages/about.php">
                <span>ABOUT US</span>
            </a>
        </li>
        <li>
            <a href="themes.php">
                <span>BLOG</span>
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
                        <a href="../pages/login.php" class="border-r border-black pr-2 mr-1"> Log in</a>
                        <a href="../pages/signup.php"> Sign up</a>
                    </div>
                    <?php else : ?>
                    <?php if (isset($_SESSION['client_name'])) : ?>
                    <div class="child:text-black hidden md:block">
                        <a class="border-r border-black pr-[3px] mr-1"><?php echo $_SESSION['client_name']; ?> </a>
                        <a href="../includes/logout.php">Log out</a>
                    </div>
                    <?php elseif (isset($_SESSION['admin_name'])) : ?>
                    <div class="child:text-black hidden md:block">
                        <a class="border-r border-black pr-[3px] mr-1"><?php echo $_SESSION['client_name']; ?> </a>
                        <a href="../includes/logout.php">Log out</a>
                    </div>
                    <?php else : ?>
                    <div class="child:text-black hidden md:block">
                        <a class="border-r border-black pr-[3px] mr-1"><?php echo $_SESSION['administrator_name']; ?>
                        </a>
                        <a href="../includes/logout.php">Log out</a>
                    </div>
                    <?php endif ?>
                    <?php endif ?>
                    <?php if (!isset($_SESSION['client_name'])) { ?>
                    <!-- <img onclick="window.location.href='src/pages/login.php'" class="open-btn dropbtn color-black cursor-pointer w-9  h-9 object-contain sm:block sm:mr-1  " src="src/images/cart.png" alt="" /> -->
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

<div id="displaymenu"
    class="flex flex-col border-2 border-t-0 border-amber-600 items-center justify-center burger-content w-full py-6 hidden md:hidden">
    <div class="flex flex-col items-center divide-y-2 gap-6 w-full divide-amber-600">
        <?php if (!isset($_SESSION['client_name']) && !isset($_SESSION['admin_name']) && !isset($_SESSION['administrator_name'])) : ?>
        <div class="child:text-black child:text-lg">
            <a href="../pages/login.php" class="border-r border-black pr-1"> Log in</a>
            <a href="../pages/signup.php"> Sign up</a>
        </div>
        <?php else : ?>
        <?php if (isset($_SESSION['client_name'])) : ?>
        <div class="flex justify-around items-center w-full child:text-black child:text-xl">
            <p><?php echo $_SESSION['client_name']; ?> </p>
            <a href="../includes/logout.php">Log out</a>
        </div>

        <?php elseif (isset($_SESSION['admin_name'])) : ?>
        <div class="flex justify-around items-center w-full child:text-black child:text-lg">
            <p><?php echo $_SESSION['admin_name']; ?> </p>
            <a href="../includes/logout.php">Log out</a>
        </div>
        <?php else : ?>
        <div class="flex justify-around items-center w-full child:text-black child:text-lg">
            <p><?php echo $_SESSION['administrator_name']; ?> </p>
            <a href="../includes/logout.php">Log out</a>
        </div>
        <?php endif ?>
        <?php endif ?>
        <?php if (isset($_SESSION['administrator_name'])) : ?>
        <div class="pt-6 text-xl font-semibold w-[90%] flex justify-center">
            <a href="../pages/controlpanel.php">
                <span>CONTROLPANEL</span>
            </a>
        </div>
        <div class="pt-6 text-xl font-semibold w-[90%] flex justify-center">
            <a href="themes.php">
                <span>BLOG</span>
            </a>
        </div>
        <?php elseif (isset($_SESSION['admin_name'])) : ?>
        <div class="pt-6 text-xl font-semibold w-[90%] flex justify-center">
            <a href="../pages/dashboard.php">
                <span>DASHBOARD</span>
            </a>
        </div>
        <div class="pt-6 text-xl font-semibold w-[90%] flex justify-center">
            <a href="themes.php">
                <span>BLOG</span>
            </a>
        </div>
        <?php else : ?>
        <div class="pt-6 text-xl font-semibold w-[90%] flex justify-center">
            <a href="../../index.php">
                <span>HOME</span>
            </a>
        </div>
        <div class="pt-6 text-xl font-semibold w-[90%] flex justify-center">
            <a href="../pages/catalog.php">
                <span>CATALOG</span>
            </a>
        </div>
        <div class="pt-6 text-xl font-semibold w-[90%] flex justify-center">
            <a href="../pages/about.php">
                <span>ABOUT US</span>
            </a>
        </div>
        <div class="pt-6 text-xl font-semibold w-[90%] flex justify-center">
            <a href="themes.php">
                <span>BLOG</span>
            </a>
        </div>
        <?php endif  ?>
    </div>
</div>