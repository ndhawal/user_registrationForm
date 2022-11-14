<?php
session_start();
if (!isset($_SESSION['email'])) {
    echo "please login first";
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sidebar</title>
    <link rel="stylesheet" href="css/style.css">

    <script src="js/jquery-3.5.1.min.js"></script>
</head>

<body>
    <div class="wrap">


        <div class="sidebar">
            <img src="images/menu.png" alt="" id="menuicon">
            <h1><a href="welcome.php">Dashboard</a></h1>
            <ul>
                <li><a href="usermanage.php">User Management</a></li>
                <li><a href="documentmanage.php">Document Management</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>


    </div>

    <script>
        $(document).ready(function() {

            $("#menuicon").click(function() {
                $(".sidebar").toggleClass("opensidebar")
            });

        });
    </script>


</body>

</html>