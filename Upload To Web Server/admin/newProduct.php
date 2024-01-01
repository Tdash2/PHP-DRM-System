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
?>

<!DOCTYPE html>

<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="favicon.ico">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<title>Make A New Product</title>
<?php
include "Header.php";
?>

<style>
  .button-container {
    display: flex;
       
  }
.button-container .btn:first-child {
    margin-right: 10px; /* Adjust the space between the buttons */
}
  .button-container .btn {
    width: 100px; /* Adjust the width as needed */
  }
</style>

</head>
<body>

<div class="container">
  <div class="py-5 text-center">
    <h2>Make A New Product</h2>
  </div>
  <fieldset>
    <form name="frmContact" class="needs-validation " method="post" action="makeNewProduct.php">
      <p>
        <label for="Name">Product Name</label>
        <input type="text" class="form-control" name="txtName" id="txtName" placeholder="Name" value="" required>
      </p>
      <p>
        <label for="message">Description</label>
        <textarea name="txtMessage" class="form-control"  id="txtMessage"  placeholder="Description" required></textarea>
      </p>
      <p>&nbsp;</p>
      <div class="button-container">
        <input type="submit" name="Submit" id="Submit" value="Submit" class="btn btn-primary btn-lg">
        <a> </a>
        <a class="btn btn-primary btn-lg" href="/admin/home.php">Back</a>
      </div>
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
