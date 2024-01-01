<?php
session_start(); // Start the session (ensure this is at the top of your script)
include "../admin/config.php";
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
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="favicon.ico">
<?php
echo '<title>View Actvation Key Info</title>';
?>
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

<div class="topnav">
  <a class="active" href="keysettings.php">Home</a>
  <form method='post' action="logout.php">
  <input style="background: #4c35ae; border: transparent;border-radius: 0pt;position: relative;left: 18pt;color: white;font-size: 15pt;height: 39pt;" type="submit" value="Logout" name="but_logout">

</div>

<div style="padding-left:16px">
</div>

<?php 

$query = "SELECT * FROM keys_table WHERE key_value = '$enteredKey'";
//echo $query;
?>
<b> <center style="padding: 10pt;   font-size: 30px;"  >Actavation Key Information: </center> </b> 
<?php 
 $key = "";
   echo '<center><div class="Top">';
   echo '<table class="table table-hover">';
   echo '<thead>';
   echo '<tr >';
   echo '</tr>';
   echo '</thead>';
   echo $result;
if ($result = $con->query($query)) {

    while ($row = $result->fetch_assoc()) {

        $field2name = $row["owner"];
        $field3name = $row["Notes"];
        $field4name = $row["enabled"];
        $field5name = $row["expire_date"];
        $field6name = $row["value"];
        $field7name = $row["hwid"];
        $key = $field1name;
                $field8name = $row["ProductId"];
        $key = $field1name;
        
          $queryy = "SELECT * FROM products WHERE id = $field8name";
          if ($result = $con->query($queryy)) {
              while ($row = $result->fetch_assoc()) {
                  $fieldd1name = $row["id"];
                  $fieldd2name = $row["productName"];
          
                   echo '<tr>';
                   echo '<td>Program:</td>';
                   echo '<td>'.$fieldd2name.'</td>';
                   echo '</tr>';
              }
              echo '</thead>';
          
              }
        
       
         echo '<tr>';
         echo '<td>Activation Key:</td>';
         echo '<td>'.$enteredKey.'</td>';
         echo '</tr>';
         echo '<tr>';
         echo '<tr>';
         echo '<td>HWID:</td>';
         echo '<td>'.$field7name.'</td>';
         echo '</tr>';
         echo '<tr>';
         echo '<td>Level:</td>';
         
         if ($field6name == 1) echo "<td>$licanceLevle1Name</td>";
         if ($field6name == 2) echo "<td>$licanceLevle2Name</td>";
         if ($field6name == 3) echo "<td>$licanceLevle3Name</td>";
         echo '</tr>';
         echo '<tr>';
         echo '<td>Licanced To:</td>';
         echo '<td>'.$field2name.'</td>';

         echo '<tr>';
         echo '<td>Expires On:</td>';
         echo'<td>';
         if ($field5name == "0001-01-01") {
            echo "Never";
         } else {
            echo $field5name;
         }
    
         echo'</td>';
 
         echo '</tr>';
         echo '<tr>';
         echo '<td>Key Enabled:</td>';
         if ($field4name == 1) echo "<td>True</td>";
         if ($field4name == 0) echo "<td>False</td>";
         echo '</tr>';
    
    
    echo '</thead>';

    }
    echo '</table>';
      echo '</div> ';
/*freeresultset*/
$result->free();
}
// Modal for confirmation

echo '<a class="buttonGreen" href="/client/editkey.php?id=' . htmlspecialchars($_GET["id"]) . '">Edit Key</a>';
echo "     ";
echo '<a class="buttonOrange" href="/client/viewkeyusage.php?key=' . $key . '&id=' . $_GET["id"] . '">View Usage</a>';
echo "     ";
echo '<a class="buttonBlue" href="/client/download.php">Download</a>';
echo "     ";




?>

</body>
</html>