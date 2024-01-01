
<?php
include "config.php";
// Check user login or not
if (!isset($_SESSION['uname'])) {
    header('Location: https://actvate.aquastreams.org/admin/index.php');
}

// logout
if (isset($_POST['but_logout'])) {
    session_destroy();
    header('Location: https://actvate.aquastreams.org/admin/index.php');
}
// Check if an ID is provided in the form
if(isset($_GET["id"])) {
    $id = $_GET["id"];

    // Update SQL query
    $sql = "DELETE FROM `keys_table` WHERE `keys_table`.`id` = $id";

    // Execute the update query
    $rs = mysqli_query($con, $sql);

    if($rs) {
        echo "<script> location.href='/admin/home.php";
     
        echo "' </script>";
        
        exit;
    } else {
        // Handle update error
        echo "Update failed: " . mysqli_error($con);
        
    }
} else {
echo "weared thinf";

    // If no ID is provided, you can assume it's a new record, and insert logic goes here
}
?>