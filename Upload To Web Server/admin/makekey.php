<?php
include "config.php";

// Check user login or not
if(!isset($_SESSION['uname'])){
    header('Location: https://actvate.aquastreams.org/admin/index.php');
}

// logout
if(isset($_POST['but_logout'])){
    session_destroy();
    header('Location: https://actvate.aquastreams.org/admin/index.php');
}

// get the post records

$txtName = $_POST['txtName'];
$txtEmail = $_POST['txtEmail'];
$txtMessage = $_POST['txtMessage'];
$txtdate = $_POST['txtdate'];
$ActivationId = $_POST['ActivationId'];
$ProductId = $_POST['ProductId'];
// database insert SQL code

function generateRandomString($length = 40) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}

$randomString = sgenerateRandomString();



$sql = "INSERT INTO keys_table (key_value, owner, value, enabled, expire_date, Notes, hwid, ProductId) VALUES ('$randomString', '$txtName', '$txtEmail', '1', '$txtdate','$txtMessage','$ActivationId', '$ProductId')";


// insert in database 
$rs = mysqli_query($con, $sql);
if($rs)
{  
echo $txtdate;

         echo "<script> location.href='home.php'; </script>";
        exit;
}


?>
