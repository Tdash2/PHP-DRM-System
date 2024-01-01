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

// Initialize variables to store data from the database
$name = "";
$email = "";
$date = "";
$message = "";
$key = "";
$enabled = "";
// Check if an ID is provided in the URL (assuming you have an ID to identify the record)
if (isset($enteredKey)) {


    // Perform a database query to retrieve the data based on the ID
    $sql = "SELECT * FROM keys_table WHERE key_value = '$enteredKey'";; // Replace your_table_name with your actual table name
    $result = mysqli_query($con, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        // Populate the variables with data from the database
        $name = $row['owner'];
        $email = $row['value'];
        $date = $row['expire_date'];
        $message = $row['Notes'];
        $key = $row['key_value'];
        $enabled = $row['enabled'];
        $ActivationId = $row['hwid'];
    }
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
<title>Edit Actvation Key </title>
<!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<div class="topnav">
  <a class="active" href="keysettings.php">Home</a>
  <a class="active" href="logout.php" style="background: #4c35ae; border: transparent;border-radius: 0pt;position: relative;left: 18pt;color: white;font-size: 15pt;height: 39pt;">Logout</a>
  
  
</div>
<body class="bg-light">

<div class="container">
    <div class="py-5 text-center">
        <h2>Edit Actvation Key: <?php echo $key; ?> </h2>
    </div>
    <fieldset>
        <form name="frmContact" class="needs-validation " method="post" action="/client/updatekey.php">

                        <p>
                <label for="Name">HWID</label>
                <input type="text" class="form-control" name="ActivationId" id="ActivationId" placeholder="Name" value="<?php echo $ActivationId; ?>" required>
                <div class="invalid-feedback">
                    Valid Activation Id required.
                </div>
            </p>
            <p>
                <input type="submit" name="Submit" id="Submit" value="Submit" class="btn btn-primary btn-lg btn-block">
                
                <a class="btn btn-primary btn-lg btn-block" href="/client/keysettings.php">Back</a>
            </p>
        </form>
    </fieldset>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>
