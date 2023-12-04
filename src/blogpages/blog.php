<?php
if (isset($_SESSION['admin_name'])) {
    header('Location:../pages/dashboard.php');
    exit;
} elseif (isset($_SESSION['administrator_nale'])) {
    header('Location:../pages/controlpanel.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("../includes/head.html") ?>
    <title>Welcome to our blog! | OPEP</title>
</head>

<body>

    <?php include("../includes/nav.php") ?>
    Content
    <?php include("../includes/footer.html") ?>

</body>

</html>