<?php
include "../admin/config.php";

if($allowTrial == "false"){
echo "<script> location.href='trialNotAllowed.php'; </script>";

}
?>
<!DOCTYPE html>
<html lang="en">
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
.table, th, td {
  border:1px solid black;
}
</style>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="favicon.ico">
<title>Make A Trial Key</title>
<!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body class="bg-light">

<div class="container">
    <div class="py-5 text-center">
        <h2>Register For A Trial</h2>
    </div>
    <fieldset>
        <form name="frmContact" class="needs-validation " method="post" action="/trial/trial.php">
            <p>
                <label for="Name">Name</label>
                <input type="text" class="form-control" name="txtName" id="txtName" placeholder="Name" required>
                <div class="invalid-feedback">
                    Valid name is required.
                </div>
            </p>
            <p>
                <label for="Name">Email</label>
                <input type="text" class="form-control" name="txtEmail" id="txtEmail" placeholder="example@example.com"  required>
                <div class="invalid-feedback">
                    Valid email required.
                </div>
            </p>
<?php 
$query = "SELECT * FROM products";
if ($result = $con->query($query)) {


    echo '<p>';
    echo '<label for="email">Product</label>';
    echo '<br><select id="ProductId" name="ProductId">';
    
    while ($row = $result->fetch_assoc()) {
    
    echo '<thead>';
    
        $field1name = $row["id"];
        $field2name = $row["productName"];

        
    if($field1name == $ProductId){
    echo '<option selected value="'.$field1name.'">'.$field2name.'</option>';
    }else{
    echo '<option value="'.$field1name.'">'.$field2name.'</option>';
    }
    
        
    }
    echo '</select>';
    echo '</br>';
    echo '</p>';
    }
/*freeresultset*/
$result->free();
?>

            
            <p>&nbsp;</p>
            <p>
            
                <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary btn-lg btn-block">


            </p>
        </form>
    </fieldset>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>
