<?php

    $url1=$_SERVER['REQUEST_URI'];
    header("Refresh: 5; URL=$url1");

include "../admin/config.php";


session_start(); // Start the session (ensure this is at the top of your script)

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // User is logged in, and you can access the entered key
    $enteredKey = $_SESSION['entered_key'];
  
    // Now, you can use $enteredKey as needed on this page.
} else {
        header('Location: index.php');// User is not logged in, handle the case accordingly (e.g., redirect to the login page).
}

?>
<!DOCTYPE html>
<html>
<head>
<title>View Actvation Key Usage</title>
<link rel="shortcut icon" href="favicon.ico">
<meta name="viewport" content="width=device-width, initial-scale=1">
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

      .button {
        display: inline-block;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        color: #ffffff;
        background-color: #ff0000;
        border-radius: 6px;
        outline: none;
      }
.Top {
  width: 90%;

}      
</style>
</head>
<body>
<div class="topnav">
  <a class="active" href="keysettings.php">Home</a>
  <form method='post' action="logout.php">
     <input style="background: #4c35ae; border: transparent;border-radius: 0pt;position: relative;left: 18pt;color: white;font-size: 15pt;height: 39pt;" type="submit" value="Logout" name="but_logout">
  </form>
  
  
</div>
<div style="padding-left:16px">
</div>
<?php

$query = "SELECT * FROM activationLog WHERE keyUsed = '$enteredKey'";

?>
<b> <center style="padding: 15pt;"  >Actvation Key Usage: </center> </b> <br> 
<?php

if ($result = $con->query($query)) {

   echo '<center><div class="Top">';
   echo '<table class="table table-hover">';
   echo '<thead>';
   echo '<tr >';
   echo '<th>Key Used:</th>';
   echo '<th>Hardware ID</th>';
   echo '<th>IP:</th>';
   echo '<th>Date Used:</th>';
   echo '<th>Outcome:</th>';
   echo '</tr>';
   echo '</thead>';



    while ($row = $result->fetch_assoc()) {
    
    
    echo '<thead>';
        $field1name = $row["keyUsed"];
        $field2name = $row["Code"];
        $field3name = $row["IP"];
        $field4name = $row["date"];
        $field5name = $row["outcome"];
         echo '<tr>';
         echo '<td>'.$field1name. '</td>';
         echo '<td>'.$field2name. '</td>';
         echo '<td>'.$field3name. '</td>';
         echo '<td>'.$field4name. '</td>';
         echo '<td>'.$field5name. '</td>';
        
    
    echo '</tr>';
    echo '</thead>';
        
    }
    echo '</table>';
    echo '</div> </center>';
    echo '<center><a class="button" href="/admin/viewkey.php?id= >Back</a></center>';
/*freeresultset*/
$result->free();
}

?>
</body>
</html>