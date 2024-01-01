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
      .buttonRed {
        display: inline-block;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        color: #ffffff;
        background-color: #ff0000;
        border-radius: 6px;
        outline: none;
      }
      .buttonBlue {
        display: inline-block;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        color: #ffffff;
        background-color: #0085ff;
        border-radius: 6px;
        outline: none;
      }
      .buttonGreen {
        display: inline-block;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        color: #ffffff;
        background-color: #00ba0e; 
        border-radius: 6px;
        outline: none;
      } 
      
      .buttonOrange {
        display: inline-block;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        color: #ffffff;
        background-color: #ff9900; 
        border-radius: 6px;
        outline: none;
      }          
      .Top {
        width: 80%;
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
$query = "SELECT * FROM `usedTrialEmails` ORDER BY `id` ASC";
?>
<b> <center style="padding: 15pt;"  >Emails Used For Trials: </center> </b> <br> <br>
<?php
if ($result = $con->query($query)) {
  echo '<center><div class="Top">';
  echo '<table class="table table-hover">';
  echo '<thead>';
   echo '<tr >';
   echo '<th>Email</th>';
   echo '<th>key</th>';
   echo '<th>         </th>';
   echo '</tr>';
echo '</thead>';

    while ($row = $result->fetch_assoc()) {
    
    echo '<thead>';
    
        $email = $row["email"];
        $actvationKey = $row["actvationKey"];
        $id = $row["id"];

         echo '<tr>';
         echo '<td><a>'.$email. '</a> </td>';
         echo '<td><a>'.$actvationKey. '</a> </td>';
echo '<td><a class="buttonRed" href="/admin/deleteTrialEmail.php?id='  . $id . '">Delete email</a> </center></td>';
        
        

        

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