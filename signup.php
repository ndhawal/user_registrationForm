<?php
require 'db/dbconnect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $pass = $_POST["pass"];
        $cpass = $_POST["cpass"];
        $company = $_POST["company"];
        $phoneno = $_POST["phoneno"];
        //to check same user exist or not
        $existemail = "select * from users where user_email='$email'";
        $result = mysqli_query($conn, $existemail);
        $numexistrow = mysqli_num_rows($result);
        if ($numexistrow > 0) {
            echo "<font color='darkred'>" .  "User already exists" . " </font>";
        } else {
            if ($pass == $cpass) {
                $sql = "INSERT INTO `users` (`user_name`, `user_email`,
                 `user_password`, `user_company`, `user_phoneno`) 
                VALUES ('$name', '$email', '$pass', '$company', '$phoneno')";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    echo "<font color='darkgreen'>" . "Success! now you can 
                    login" . " </font>";
                }
            } else {
                echo "<font color='darkred'>" .   "Password! 
                entered is not same" . " </font>";
            }
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
    <title>Signup</title>
</head>

<body>
    <div id="box">
        <form id="SignUpForm" method="post" action="">
            <div style="margin:20px; color:black; font-size:20px" ;>Signup Form</div>
            <input class="text" type="text" name="name" 
            placeholder="Enter your Name"><br><br>
            <input class="text" type="email" name="email" 
            placeholder="Enter your Email"><br><br>
            <input class="text" type="password" name="pass" 
            placeholder="Enter your Password"><br><br>
            <input class="text" type="password" name="cpass" 
            placeholder="Conform your Password"><br><br>
            <input class="text" type="text" name="company" 
            placeholder="Enter your company Name"><br><br>
            <input class="text" type="tel" name="phoneno" 
            placeholder="Enter your Phonenumber"><br><br>
            <input id="button" type="submit" name="submit" value="Signup"><br><br>
            <a href="login.php"> Click to Login</a>


        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/
    jquery.validate.min.js"></script>
    <script src="js/jqueryvalidation.js"></script>
</body>

</html>