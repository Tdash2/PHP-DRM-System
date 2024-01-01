<?php


    $url1=$_SERVER['REQUEST_URI'];
    header("Refresh: 10; URL=$url1");


include "config.php";

// Check user login or not
if(!isset($_SESSION['uname'])){
    header('Location: index.php');
}

// logout
if(isset($_POST['but_logout'])){
    session_destroy();
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $appName; ?>View Current Products</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="favicon.ico">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
.Top {
  width: 85%;

}
</style>
</head>
<body>
<?php
include "Header.php";
?>
<div style="padding-left:16px">
</div>
<?php 
$query = "SELECT * FROM `products` ORDER BY `id` ASC";
?>
<b> <center style="padding: 15pt;"  >View Curent Products</center> </b> <br> <br>
<?php
if ($result = $con->query($query)) {
  echo '<center><div class="Top">';
  echo '<table class="table table-hover">';
  echo '<thead>';
   echo '<tr >';
   echo '<th>Product ID</th>';
   echo '<th>Product Name</th>';
   echo '<th>Product Decription</th>';
   echo '<th>Current Verson</th>';
   echo '</tr>';
echo '</thead>';

    while ($row = $result->fetch_assoc()) {
    
    echo '<thead>';
    
        $field1name = $row["id"];
        $field2name = $row["productName"];
        $field3name = $row["Decription"];
         echo '<tr>';
         echo '<td><a href="/admin/editProduct.php?id='.$field1name.'">'.$field1name. '</a> </td>'; //editProduct.php
         echo '<td><a href="/admin/editProduct.php?id='.$field1name.'">'.$field2name. '</a> </td>';
         echo '<td><a href="/admin/editProduct.php?id='.$field1name.'">'.$field3name. '</a> </td>';       
        $queryy = "SELECT * FROM productInfo WHERE productID = $field1name ORDER BY id DESC";
          if ($resultt = $con->query($queryy)) {
              $row = $resultt->fetch_assoc();
                  $fieldd1name = $row["id"];
                  $fieldd2name = $row["Version"];
                   echo '<td><a href="/admin/editProduct.php?id=test'.$field1name.'">'.$fieldd2name. '</a> </td>'; 
               
          }

        

    echo '</tr>';
    echo '</thead>';
        
    }
    echo '</table>';
      echo '</div> </center>';
/*freeresultset*/
$result->free();
}

?>
</body>
</html>