<?php
$servername = "localhost"; //server
$username = "root"; //username
$password = ""; //password
$dbname = "ofdms";  //database

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname); // connecting 
// Check connection
if (!$conn) {       //checking connection to DB	
  die("Connection failed: " . mysqli_connect_error());
}
// $conn=include("connect.php");

if (isset($_POST['submit'])) {
  if (isset($_FILES['FImg']) && $_FILES['FImg']['error'] == 0) {


    $fname = $_FILES['FImg']['name'];
    // $file_extensions = pathinfo($fname, PATHINFO_EXTENSION);
    $temp = $_FILES['FImg']['tmp_name'];
    $target_file = '../images/foods/' . $fname;

    if (move_uploaded_file($temp, $target_file)) {
      header("Location: restaurants.php");
    } else {
      die("File upload unsuccessfull!!");
      header("Location: addrestaurants.php");
    }
  } else {
    switch ($_FILES['FImg']['error']) {
      case UPLOAD_ERR_INI_SIZE:
        echo "The uploaded file exceeds the upload_max_filesize directive in php.ini";
        break;
      case UPLOAD_ERR_FORM_SIZE:
        echo "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
        break;
      case UPLOAD_ERR_PARTIAL:
        echo "The uploaded file was only partially uploaded";
        break;
      case UPLOAD_ERR_NO_FILE:
        echo "No file was uploaded";
        break;
      case UPLOAD_ERR_NO_TMP_DIR:
        echo "Missing a temporary folder";
        break;
      case UPLOAD_ERR_CANT_WRITE:
        echo "Failed to write file to disk";
        break;
      case UPLOAD_ERR_EXTENSION:
        echo "File upload stopped by extension";
        break;
      default:
        echo "Unknown upload error";
        break;
    }
  }



  $query = "INSERT INTO food (RId,FoodName,Description,Price,FImg) VALUE('" . $_POST['RId'] . "','" . $_POST['FoodName'] . "','" . $_POST['Description'] . "','" . $_POST['Price'] . "','" . $target_file . "')";
  $run = mysqli_query($conn, $query);
  header("location:food.php");
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OFDMS: Add Restaurant</title>
  <link rel="icon" href="../images/icons/online-delivery.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="./stylesheet/res.css">

</head>


<body>
  <header>
    <nav class="navbar navbar-dark bg-dark">
    <?php
            include("header.php");
            ?>
    </nav>
  </header>
  <div class="cards">
    <div class="container-fluid">
      <form action="#" method="post" enctype="multipart/form-data">
        <div class="row input-group mx-auto mb-3">
          <select name='RId' class="form-select form-select-lg mb-3 text-black">
            <option selected disabled>Select a restaurant</option>
            <?php
            $sql = "SELECT RId, RName FROM restaurant";
            $exec = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($exec)) {
              echo '<option value=' . $row['RId'] . '>' . $row['RName'] . '</option>';
            }
            ?>
          </select>

        </div>
        <div class="row input-group mx-auto mb-3">
          <div class="form-floating">
            <input type="text" class="form-control" id="FoodName" name="FoodName" placeholder="Food Name">
            <label for="FoodName">Food Name</label>
          </div>
        </div>
        <div class="row input-group mx-auto mb-3">
          <div class="form-floating">
            <input type="text" class="form-control" id="Description" placeholder="Description" name="Description" value="Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quibusdam dolorum nihil quasi animi consequuntur, corrupti repellat cupiditate nemo esse laboriosam ullam dolorem. Distinctio accusantium ducimus tempore dolore fugit facere mollitia">
            <label for="Description">Description</label>
          </div>
        </div>
        <div class="col input-group mx-auto mb-3">
          <span class="input-group-text p-2 text-white"><strong>₹</strong></span>
          <input type="number" class="form-control" id="Price" name="Price" placeholder="0">
          <span class="input-group-text p-2 text-white"><strong>.00</strong></span>
        </div>
        <div class="col input-group mx-auto mb-3">
          <input type="file" class="form-control" id="FImg" name="FImg">
          <label class="input-group-text" for="FImg">Upload</label>
        </div>

        <button type="submit" class="btn btn-primary" name="submit">ADD</button>
      </form>
    </div>
  </div>
</body>



</html>