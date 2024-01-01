
 <?php
 include "config.php";

// Check user login or not
if (!isset($_SESSION['uname'])) {
    header('Location: index.php');
}

// logout
if (isset($_POST['but_logout'])) {
    session_destroy();
    header('Location: index.php');
}

// Check if the form was submitted
if (isset($_POST['submit'])) {
    // Database connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get file details
    $file_name = $_FILES['file']['name'];
    $file_tmp_name = $_FILES['file']['tmp_name'];

    // Get version and changelog from the form
    $version = $_POST['version'];
    $changelog = $_POST['changelog'];
    $Pid = $_POST['Product'];
    // Construct the new file name with version
    $extension = pathinfo($file_name, PATHINFO_EXTENSION);
    $new_file_name = 'V' . $version . '_' . $file_name;

    // Move the uploaded file to the desired directory with the new file name
    $upload_directory = "../download/";
    $target_file = $upload_directory . basename($new_file_name);

    if (move_uploaded_file($file_tmp_name, $target_file)) {
        // File uploaded successfully, now insert the file information into the database
        $sql = "INSERT INTO productInfo (file_name, Version, Messages, productID) VALUES ('$new_file_name', '$version', '$changelog', '$Pid')";

        if (mysqli_query($con, $sql)) {
            echo "<script> location.href='viewProducts.php'; </script>";
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    } else {
        echo "File upload failed.";
    }

    mysqli_close($con);
}
?>

<!DOCTYPE html>
<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}
.topnav {
  overflow: hidden;
  background-color: #333;
}
.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}
.topnav a:hover {
  background-color: #ddd;
  color: black;
}
.topnav a.active {
  background-color: #04AA6D;
  color: white;
}
.center {
  margin: auto;
}
.table, th, td {
  border:1px solid black;
}
  .button-container {
    display: flex;
       
  }
.button-container .btn:first-child {
    margin-right: 10px; /* Adjust the space between the buttons */
}
  .button-container .btn {
    width: 100px; /* Adjust the width as needed */
  }
</style>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="favicon.ico">
<title>New Actvation Key</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<?php
include "Header.php";
?>
<body class="bg-light">

<div class="container">
<div class="py-5 text-center">
        <h2>Uplaoad A New Update</h2>

</div>
<fieldset>
    <form name="frmContact" class="needs-validation " method="POST" enctype="multipart/form-data">
  
  
<?php 
$query = "SELECT * FROM products";
if ($result = $con->query($query)) {


    echo '<p>';
    echo '<label for="email">Product</label>';
    echo '<br><select id="txtEmail" name="Product">';
    
    while ($row = $result->fetch_assoc()) {
    
    echo '<thead>';
    
        $field1name = $row["id"];
        $field2name = $row["productName"];

        
    
    echo '<option value="'.$field1name.'">'.$field2name.'</option>';
    
        
    }
    echo '</select>';
    echo '</br>';
    echo '</p>';
    }
/*freeresultset*/
$result->free();
?>
    <p>  
        <label for="text">Verson Number</label><br>
        <input class="form-control"  type="text" name="version" placeholder="1.1">
    </p> 
    <p>    
    <label for="changelog">Changelog</label><br>
        <textarea class="form-control" name="changelog" placeholder="Changelog"></textarea>
    </p> 
        <p>
        <label  for="file">Upload File </label><br>
        <input type="file" name="file">
    </p><center>
    <p>    
    <div class="button-container">
              <input type="submit" name="submit" value="Upload"  class="btn btn-primary btn-lg">
                      <a class="btn btn-primary btn-lg btn-block" href="/admin/home.php">Back</a>
                      </div>
    </p> 
    </center>
    </form>
</fieldset>
</div>
</body>
</html>
