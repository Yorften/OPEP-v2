<div class="overflow-y-hidden h-12">
    <nav class="bg-[#bdff72] h-12 flex justify-between items-center px-2 md:px-4">
        <div class="block w-1/3 sm:w-1/4 md:w-1/12">
            <a href="../../index.php">
                <p class="text-black text-3xl">OPEP</p>
            </a>
        </div>
        
        <div class="flex items-center justify-end gap-2">

            <div class="flex items-center">
                <div class="dropdown">

                    <div class="flex items-center justify-center gap-6">
                        <?php if (!isset($_SESSION['client_name']) && !isset($_SESSION['admin_name']) && !isset($_SESSION['administrator_name'])) : ?>
                            <div class="child:text-black hidden md:block">
                                <a href="login.php" class="border-r border-black pr-2 mr-1"> Log in</a>
                                <a href="signup.php"> Sign up</a>
                            </div>
                        <?php else : ?>
                            <?php if (isset($_SESSION['client_name'])) : ?>
                                <div class="child:text-black hidden md:block">
                                    <a class="border-r border-black pr-[3px] mr-1"><?php echo $_SESSION['client_name']; ?> </a>
                                    <a href="../includes/logout.php">Log out</a>
                                </div>
                            <?php elseif (isset($_SESSION['admin_name'])) : ?>
                                <div class="child:text-black hidden md:block">
                                    <a class="border-r border-black pr-[3px] mr-1"><?php echo $_SESSION['admin_name']; ?> </a>
                                    <a href="../includes/logout.php">Log out</a>
                                </div>
                            <?php else : ?>
                                <div class="child:text-black hidden md:block">
                                    <a class="border-r border-black pr-[3px] mr-1"><?php echo $_SESSION['administrator_name']; ?> </a>
                                    <a href="../includes/logout.php">Log out</a>
                                </div>
                            <?php endif ?>
                        <?php endif ?>
                       
                    </div>

                    <div>
                        <div id="cartDropdown" class="z-10 dropdown-content w-full h-[70vh] border-2 border-black pt-1 overflow-y-auto md:w-96 md:mr-2 mt-5 relative">
                            <div id="myDropdown" class="pt-2 bg-black z-10">

                            </div>
                            <div class="flex justify-around py-2 bg-black z-30">
                                <button onclick="location.href='checkout.php'" class="font-bold rounded-[15px] p-2 w-28 flex justify-center bg-[#EFE61E]">Checkout</button>
                                <button class="font-bold rounded-[15px] p-2 w-28 flex justify-center bg-[#EFE61E]">Clear</button>
                            </div>
                        </div>
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
    <div id="displaymenu" class="flex flex-col border-2 border-t-0 border-amber-600 items-center justify-center burger-content w-full py-6 hidden md:hidden">
        <div class="flex flex-col items-center divide-y-2 gap-6 w-full divide-amber-600">
            <?php if (!isset($_SESSION['client_name']) && !isset($_SESSION['admin_name']) && !isset($_SESSION['administrator_name'])) : ?>
                <div class="child:text-black child:text-lg">
                    <a href="login.php" class="border-r border-black pr-1"> Log in</a>
                    <a href="signup.php"> Sign up</a>
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
            <div class="pt-6 text-xl font-semibold w-[90%] flex justify-center">
                <a href="users.php">
                    <span>Accounts</span>
                </a>
            </div>
            <div class="pt-6 text-xl font-semibold w-[90%] flex justify-center">
                <a href="catalog.php">
                    <span>Categories</span>
                </a>
            </div>
            <div class="pt-6 text-xl font-semibold w-[90%] flex justify-center">
                <a href="about.php">
                    <span>Plants</span>
                </a>
            </div>
        </div>
    </div>
</div>