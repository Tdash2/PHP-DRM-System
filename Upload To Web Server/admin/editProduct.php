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

// Check if an ID is provided in the URL (assuming you have an ID to identify the record)
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Perform a database query to retrieve the data based on the ID
    $sql = "SELECT * FROM products WHERE id = $id"; // Replace your_table_name with your actual table name
    $result = mysqli_query($con, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        // Populate the variables with data from the database
        $productName = $row['productName'];
        $Decription = $row['Decription'];

    }
    
    
}
?>


<!DOCTYPE html>
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
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="favicon.ico">
<title>Edit A Product</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<?php
include "Header.php";
?>

<body class="bg-light">

<div class="container">
<div class="py-5 text-center">
        <h2>Edit A Product</h2>

      </div>
<fieldset>
  
  <form name="frmContact" class="needs-validation " method="post" action="updateProduct.php">
    <p>
      <label for="Name">Product Name</label>
      <input type="text" class="form-control" name="txtName" id="txtName" placeholder="Name" value="<?php echo $productName; ?>" required>
	  
    </p>
    <p>
      <label for="message">Decription</label>
      <textarea name="txtMessage" class="form-control"  id="txtMessage"  placeholder="Decription"  required><?php echo $Decription; ?></textarea>
    </p>
    <p>&nbsp;</p>
    <p>
    <input type="hidden" name="id" value="<?php echo $id; ?>">
       <div class="button-container">
        <input type="submit" name="Submit" id="Submit" value="Submit" class="btn btn-primary btn-lg">
        <a> </a>
        <a class="btn btn-primary btn-lg" href="/admin/viewProducts.php">Back</a>
      </div>
                      
                      
    </p>
  </form>
</fieldset>
</div>
<script>
    document.getElementById('calendarButton').addEventListener('click', function() {
        const txtDate = document.getElementById('txtdate');
        txtDate.type = 'date';
        txtDate.focus();
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>
