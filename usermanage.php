<?php
include 'dashboard.php';
include 'db/dbconnect.php';


?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>


    <h2>List Of Datas</h2>

    <table>
        <tr>
            <th>SNo</th>
            <th>NAME</th>
            <th>Email</th>
            <th>Password</th>
            <th>Company</th>
            <th>Phonenumber</th>
            <th>Operation</th>
        </tr>
        <?php
        $sql = "SELECT * FROM users ";
        $result = mysqli_query($conn, $sql);
        $total_records = mysqli_num_rows($result);
        $num_per_page = 04;
        $total_pages = ceil($total_records / $num_per_page);


        if (isset($_GET["page"])) {
            $page = $_GET["page"];
        } else {
            $page = 1;
        }
        $start_from = ($page - 1) * $num_per_page;
        $sql = "SELECT * FROM users limit $start_from, $num_per_page ";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $i = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                $sn = $row['id'];
                $name = $row['user_name'];
                $email = $row['user_email'];
                $pass = $row['user_password'];
                $company = $row['user_company'];
                $phno = $row['user_phoneno'];
                echo ' <tr>
    <td>' . $sn . '</td>
    <td>' . $name . '</td>
    <td>' . $email . '</td>
    <td>' . $pass . '</td>
    <td>' . $company . '</td>
    <td>' . $phno . '</td>
    <td>
    <button id="button1"><a href="edit.php?editid=' . $sn . '">Edit</a></button>
        <button id ="button2"><a href="delete.php?deleteid=' . $sn . '">Delete</a></button>
    </td>
 
  </tr> ';
   $i++;
            }
            echo "</table>";
        }
        
        echo "<div class='page'>";
        for ($i = 1; $i <= $total_pages; $i++) {
            echo "<a  href='usermanage.php?page= $i' ><button> $i</button>  </a> ";
        }

        ?>
      </div>
  

</body>

</html>