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
$txtMessage = $_POST['txtMessage'];
$id = $_POST['id'];



    $sql = "UPDATE products SET 
            productName = '$txtName', 
            Decription = '$txtMessage'
            WHERE id = $id";

// insert in database 
$rs = mysqli_query($con, $sql);
if($rs)
{  
echo $txtdate;

         echo "<script> location.href='viewProducts.php'; </script>";
        exit;
}


?>
