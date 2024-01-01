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
<title><?php echo $appName; ?> Actvation Key</title>
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
$query = "SELECT * FROM `keys_table` ORDER BY `id` ASC";
?>
<b> <center style="padding: 15pt;"  >All Actvation Keys: </center> </b> <br> <br>
<?php
if ($result = $con->query($query)) {
  echo '<center><div class="Top">';
  echo '<table class="table table-hover">';
  echo '<thead>';
   echo '<tr >';
   echo '<th>Owner</th>';
   echo '<th>Key</th>';
   echo '<th>Licence Type</th>';
   echo '<th>Program</th>';
   echo '</tr>';
echo '</thead>';

    while ($row = $result->fetch_assoc()) {
    
    echo '<thead>';
    
        $field1name = $row["id"];
        $field2name = $row["key_value"];
        $field3name = $row["owner"];
        $field4name = $row["value"];
        $field8name = $row["ProductId"];
         echo '<tr>';
         echo '<td href="/admin/viewticket.php?id='.$field1name.'"><a href="/admin/viewkey.php?id='.$field1name.'">'.$field3name. '</a> </td>';
         echo '<td href="/admin/viewticket.php?id='.$field1name.'"><a href="/admin/viewkey.php?id='.$field1name.'">'.$field2name. '</a> </td>';
         if ($field4name == 1) echo '<td href="/admin/viewticket.php?id='.$field1name.'"><a href="/admin/viewkey.php?id='.$field1name.'">'.$licanceLevle1Name. '</a> </td>';
         if ($field4name == 2) echo '<td href="/admin/viewticket.php?id='.$field1name.'"><a href="/admin/viewkey.php?id='.$field1name.'">'.$licanceLevle2Name. '</a> </td>';
         if ($field4name == 3) echo '<td href="/admin/viewticket.php?id='.$field1name.'"><a href="/admin/viewkey.php?id='.$field1name.'">'.$licanceLevle3Name. '</a> </td>';
         
         $queryy = "SELECT * FROM products WHERE id = $field8name";
          if ($resultt = $con->query($queryy)) {
              while ($row = $resultt->fetch_assoc()) {
                  $fieldd1name = $row["id"];
                  $fieldd2name = $row["productName"];
                   echo '<td href="/admin/viewticket.php?id='.$field1name.'"><a href="/admin/viewkey.php?id='.$field1name.'">'.$fieldd2name. '</a> </td>';
              } 
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