<?php
include'db/dbconnect.php';
if(isset($_GET['deleteid'])){
    $sn=$_GET['deleteid'];
    $sql="delete from users where id=$sn";
    $result=mysqli_query($conn,$sql);
    if($result){
        echo"Deleted successfuly";
        header("location:usermanage.php");
    }
        else{
            die(mysqli_error($conn));
        }
    }
