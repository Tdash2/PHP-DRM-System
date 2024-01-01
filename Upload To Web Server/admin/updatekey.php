
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
if(isset($_POST['id'])) {
    $id = $_POST['id'];

    // Get the updated values from the form
    $txtName = $_POST['txtName'];
    $txtEmail = $_POST['txtEmail'];
    $txtMessage = $_POST['txtMessage'];
    $txtdate = $_POST['txtdate'];
    $txtenabled = $_POST['txtenabled'];
    $ActivationId = $_POST['ActivationId'];
    $ProductId = $_POST['ProductId'];
    // Update SQL query
    $sql = "UPDATE keys_table SET 
            owner = '$txtName', 
            value = '$txtEmail', 
            enabled = '$txtenabled',
            expire_date = '$txtdate', 
            hwid = '$ActivationId', 
            Notes = '$txtMessage',
            ProductId = '$ProductId' 
            WHERE id = $id";

    // Execute the update query
    $rs = mysqli_query($con, $sql);

    if($rs) {
        echo "<script> location.href='/admin/viewkey.php?id=";
        echo $id;
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