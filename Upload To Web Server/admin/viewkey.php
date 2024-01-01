<?php
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

<?php
include "Header.php";
?>

<?php 

$query = "SELECT * FROM keys_table WHERE id = '".$_GET["id"]."'";
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
   
if ($result = $con->query($query)) {

    while ($row = $result->fetch_assoc()) {
        $field1name = $row["key_value"];
        $field2name = $row["owner"];
        $field3name = $row["Notes"];
        $field4name = $row["enabled"];
        $field5name = $row["expire_date"];
        $field6name = $row["value"];
        $field7name = $row["hwid"];
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
         echo '<td>'.$field1name.'</td>';
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
         echo '</tr>';
         echo '<tr>';
         echo '<td>Notes:</td>';
         echo '<td>'.$field3name.'</td>';
         echo '</tr>';
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
echo '<a class="buttonBlue" href="/admin/home.php">Back</a>';
echo "     ";
echo '<a class="buttonGreen" href="/admin/editkey.php?id=' . htmlspecialchars($_GET["id"]) . '">Edit Key</a>';
echo "     ";
echo '<a class="buttonOrange" href="/admin/viewkeyusage.php?key=' . $key . '&id=' . $_GET["id"] . '">View Usage</a>';
echo "     ";
echo '<a class="buttonBlue" href="/admin/download.php?key=' . $key . '">Download Program</a>';
echo "     ";
echo '<a class="buttonRed" href="/admin/deleteKey.php?id='  . htmlspecialchars($_GET["id"]) . '">Delete Key</a> </center>';




?>

</body>
</html>