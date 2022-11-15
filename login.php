<?php
/**
 * * MyClass Class Doc Comment
 * php version 7
 * 
 * @var mysqli $conn 
 * 
 * @category Class
 * @package  MyPackage
 * @author   Niraj <nkrneerazz@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */
require 'db/dbconnect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        $email = $_POST["email"];
        $pass = $_POST["pass"];
        //to check email and password
        $sql="select * from users where user_email='$email' 
        AND user_password='$pass'";
        $result=mysqli_query($conn, $sql);
        $num=mysqli_num_rows($result);
        if ($num==1) {
            session_start();
            $_SESSION['email']= $email;
            header("location:welcome.php");
        } else {
            echo "<font color='darkred'>".  "Invalid credentials"." </font>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
</head>
<body>
    <div id="box">
    <form id="LoginForm" method="post" action="">
            <div style="margin:20px; color:black; font-size:20px";>LOGIN FORM </div>
            <input class="text" type="email" name="email" 
            placeholder="Enter your email"><br><br>
            <input class="text" type="password" name="pass" 
            placeholder="Enter your Password"><br><br>
            <input id="button" type="submit" name="submit" value="Login"><br><br>
            <a href="signup.php">Click to Sign up</a>


        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/
    1.19.5/jquery.validate.min.js"></script>
    <script src="js/jqueryvalidation.js"></script>
</body>
</html>