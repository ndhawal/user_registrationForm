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
require 'dashboard.php';
require 'db/dbconnect.php';
//to fetch name of user
$user=$_SESSION['email'];

$sqli1="SELECT * FROM users WHERE user_email='$user'";

$result = mysqli_query($conn, $sqli1);
// echo $result['user_name'];
if ($result == true) {
    while ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['user_name']=$row['user_name'];
    }
} else {
    echo "error";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    
</head>

<body>
        <section class="main">
            <h1><?php echo "Welcome " .$_SESSION['user_name']?></h1>
        </section>

</body>

</html>
