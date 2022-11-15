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
 * @license  http://www.gnu.org/copyleft/gpl.html  General Public License
 * @link     http://www.hashbangcode.com/
 */
require 'dashboard.php';
require 'db/dbconnect.php';
if (isset($_POST['submit'])) {
    $name = $_POST["text"];
    if (isset($_FILES['fileToUpload'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $target_name = $_FILES["fileToUpload"]["name"];
        $uploadOk = 1;
        $docFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = $_FILES["fileToUpload"]["tmp_name"];
            if ($check == null) {
                echo " <p class='msg'>File is not there.</p>";
                $uploadOk = 0;

                // Check if file already exists
            } elseif (file_exists($target_file)) {
                echo " <p class='msg'>Sorry, file already exists..</p>";
                $uploadOk = 0;

                // Check file size
            } elseif ($_FILES["fileToUpload"]["size"] > 50000000000) {
                echo " <p class='msg'>Sorry, your file is too large.</p>";
                $uploadOk = 0;

                // Allow certain file formats
            } elseif ($docFileType != "pdf" && $docFileType != "docx") {
                echo " <p class='msg'>Sorry, doc and pdf files are allowed.</p>";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo " <p class='msg'>Sorry, your file was not uploaded.</p>";
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file(
                    $_FILES["fileToUpload"]["tmp_name"], $target_file
                )
                ) {
                    $sql = "INSERT INTO `document` (`doc_name`, `doc_url`)
    VALUES ('$name', '$target_name')";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        echo "                 <p class='msg'> upload success</p>";
                    }
                } else {
                    echo " <p class='msg'>Sorry, there was an error 
                    uploading your file.</p>";
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="css/style.css">

</head>

<body>
  <label class="custom-upload">
    <form id="Docname" action="" method="post" enctype="multipart/form-data">
      <label> EnterDocument Name</label><input class="text1" type="text" 
      name="text" placeholder="Enter document name"><br>
      Select documents to upload:
      <button class="btn1">
        <input class="text2" type="file" name="fileToUpload" id="fileToUpload">
        <input class="text2" type="submit" value="Upload Documents"
         name="submit"></button>

    </form>
  </label>

  <h2>List Of Documents</h2>

  <table>
    <tr>
      <th>SNo</th>
      <th>Document Detail</th>
      <th>View Document</th>
    </tr>
<?php
$sql = "SELECT * FROM document ";
$result = mysqli_query($conn, $sql);
$total_records = mysqli_num_rows($result);
$num_per_page = 03;
$total_pages = ceil($total_records / $num_per_page);
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}
$start_from = ($page - 1) * $num_per_page;
$sql = "SELECT * FROM document limit $start_from, $num_per_page ";
$result = mysqli_query($conn, $sql);
if ($result) {
    $i = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $sn = $row['id'];
        $name = $row['doc_name'];
        $url = $row['doc_url'];

        echo ' <tr>
    <td>' . $sn . '</td>
    <td>' . $name . '</td>
    <td><a href="uploads/' . $url . '">View Attachment</a></td>


  </tr> ';
        $i++;
    }
    echo "</table>";
}

echo "<div class='page'>";
for ($i = 1; $i <= $total_pages; $i++) {
    echo "<a  href='documentmanage.php?page= $i' ><button> $i</button>  </a> ";
}

?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/
    jquery.validate.min.js"></script>
    <script src="js/jqueryvalidation.js"></script>
</body>

</html>
