<?php
session_start();
if(!isset($_SESSION['email']))
{
    echo"please login first";
    header("location:login.php");
}
include 'db/dbconnect.php';
$sn = $_GET['editid'];
$sql="select * from users where id=$sn";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$name=$row['user_name'];
$email=$row['user_email'];
$pass=$row['user_password'];
$company=$row['user_company'];
$phno=$row['user_phoneno'];
 if (isset($_POST['submit'])) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $pass = $_POST["pass"];
        $company = $_POST["company"];
        $phoneno = $_POST["phoneno"];
        $sql = "UPDATE  users set id=$sn, user_name='$name', user_email='$email',user_password='$pass',  
        user_company='$company', user_phoneno='$phoneno' where id=$sn";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "<font color='darkgreen'>" .  "Success update" . " </font>";
            header("location:usermanage.php");
        } else {
            die(mysqli_error($con));
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
    <title>Update Form</title>
</head>

<body>
    <div id="box">
        <form id="SignUpForm" method="post" action="">
            <div style="margin:20px; color:black; font-size:20px" ;>Update Form</div>
            <label>Name</label><input class="text" type="text" name="name" value=<?php echo $name ?>><br><br>
            <label>Email</label> <input class="text" type="email" name="email" value=<?php echo $email ?> ><br><br>
            <label>Password</label><input class="text" type="text" name="pass" value=<?php echo $pass ?> ><br><br>
            <label>Company</label> <input class="text" type="text" name="company" value=<?php echo $company ?> ><br><br>
            <label>Phoneno</label><input class="text" type="tel" name="phoneno" value=<?php echo $phno ?> ><br><br>
            <input id="button" type="submit" name="submit" value="Update"><br><br>


        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="js/jqueryvalidation.js"></script>
</body>

</html>