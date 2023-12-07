<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);

include("../includes/conn.php");

session_start();

if (isset($_SESSION['client_name'])) {
    header('location:../../index.php');
    exit;
} elseif (isset($_SESSION['admin_name'])) {
    header('location:dashboard.php');
    exit;
} elseif (isset($_SESSION['administrator_name'])) {
    header('location:controlpanel.php');
    exit;
}

if (isset($_POST['submit'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = trim($_POST['password']);

    $select = "SELECT * FROM users WHERE userEmail = ?";
    $stmt = $conn->prepare($select);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $userId = $row["userId"];
        $userName = $row["userName"];
        $password_db = $row["userPassword"];
        $roleId = $row["roleId"];
        $isVerified = $row["isVerified"];
        if (password_verify($password, $password_db)) {
            switch ($roleId) {
                case 1:
                    if ($isVerified == 1) {
                        $select = "SELECT * FROM carts WHERE userId = ?";
                        $stmt = $conn->prepare($select);
                        $stmt->bind_param("i", $userId);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $row = mysqli_fetch_assoc($result);
                        $cartId = $row['cartId'];

                        $_SESSION['client_cart'] = $cartId;
                        $_SESSION['client_name'] = $userName;
                        $_SESSION['userId'] = $userId;
                        header('location:../../index.php');
                        exit;
                    } else $msg[] = "Your account is locked, please contact support";
                    break;
                case 2:
                    if ($isVerified == 1) {
                        $_SESSION['userId'] = $userId;
                        $_SESSION['admin_name'] = $userName;
                        header('location:dashboard.php');
                        exit;
                    } else
                        $msg[] = "Account locked or disactivated, please contact your supervisor";
                    break;

                case 3:
                    $_SESSION['userId'] = $userId;
                    $_SESSION['administrator_name'] = $userName;
                    header('location:controlpanel.php');
                    exit;
                    break;
                case 4:
                    header('location:role.php?id=' . $userId);
                    exit;
                    break;
            }
        } else $msg[] = 'Incorrect email or password';
    } else {
        $msg[] = 'Incorrect email or password';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("../includes/head.html") ?>
    <title>Log in | O'PEP</title>
</head>

<body>

    <?php include("../includes/nav.php") ?>

    <div class="flex justify-center my-12">
        <div class="flex flex-col justify-center w-[85%] bg-white border border-black rounded-xl md:w-1/2">
            <form class="w-3/4 mx-auto" method="post">
                <div class="flex flex-col mt-8">
                    <div class="capitalize mb-5 font-semibold text-xl">
                        <p>Log in</p>
                    </div>
                    <?php
                    if (isset($msg)) {
                        foreach ($msg as $error) {
                            echo '<div class="bg-red-500 mb-3 rounded-lg">';
                            echo '<p class="text-white text-lg text-center">' . $error . '</p>';
                            echo '</div>';
                        }
                    }

                    ?>
                    <!-- Start of input name -->
                    <div class="flex flex-col mb-3">
                        <div id="nameBorder" class="flex flex-col border-2 border-[#A1A1A1] p-2 rounded-md">
                            <p class="text-xs">Email</p>
                            <input class="placeholder:font-light placeholder:text-xs focus:outline-none" id="email" type="text" name="email" placeholder="example@exm.com" autocomplete="on">
                        </div>
                        <div id="emailERR" class="text-red-600 text-xs pl-3"></div>
                    </div>
                    <!-- End of input name -->
                    <div class="flex flex-col mb-3">
                        <div id="cardnumberBorder" class="flex flex-col border-2 border-[#A1A1A1] p-2 rounded-md">
                            <p class="text-xs">Password</p>
                            <input class="placeholder:font-light placeholder:text-xs focus:outline-none" id="password" type="password" name="password" placeholder="***************">
                        </div>
                        <div id="passwordErr" class="text-red-600 text-xs pl-3"></div>
                    </div>


                </div>
                <div class="flex justify-start mb-8">
                    <a href="signup.php" class="text-sm text-gray-800 underline">Don't have an account yet? Sign Up</a>
                </div>
                <div class="flex justify-end mb-4">
                    <input type="submit" name="submit" class="cursor-pointer px-8 py-2 bg-[#9fff30] font-semibold rounded-lg border-2 border-[#6da22f]" value="Log in">
                </div>
            </form>

        </div>

    </div> <?php include("../includes/footer.html") ?>

    <script src="../js/burger.js"></script>
    <script src="../js/cart.js"></script>
</body>

</html>