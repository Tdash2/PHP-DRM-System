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
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="favicon.ico">
<title>New Actvation Key</title>
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
        <h2>Make A New Actvation Key</h2>

      </div>
<fieldset>
  
  <form name="frmContact" class="needs-validation " method="post" action="makekey.php">
    <p>
      <label for="Name">Licance To </label>
      <input type="text" class="form-control" name="txtName" id="txtName" placeholder="Name" value="" required>
	  <div class="invalid-feedback">Valid name is required.</div>
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

        

    echo '<option value="'.$field1name.'">'.$field2name.'</option>';
    
        
    }
    echo '</select>';
    echo '</br>';
    echo '</p>';
    }
/*freeresultset*/
$result->free();
?>
                            <p>
                <label for="Name">HWID</label>
                <input type="text" class="form-control" name="ActivationId" id="ActivationId" placeholder="Activation ID">

            </p>
        <p>
                <label for="email">Licence Type</label>
                
                <br><select id="txtEmail" name="txtEmail">
                    <option value="1" >Basic</option>
                    <option value="2" >Intermediate</option>
                    <option value="3" >Advanced</option>
                </select></br>
            </p>
    
    <p>
      <label for="date"> Expiration Date (Note: For an Infinite key use 0001-01-01)</label>
      <div class="input-group">
        <input type="text" class="form-control" name="txtdate" id="txtdate" placeholder="Date YYYY-MM-DD"  required>
        <div class="input-group-append">
        <button type="button" class="btn btn-outline-secondary" id="calendarButton">Pick a Date</button>
      </div>
    </div>

    <p>
      <label for="message">Note</label>
      <textarea name="txtMessage" class="form-control"  id="txtMessage"  placeholder="Message" required></textarea>
    </p>
    <p>&nbsp;</p>
    <p>
    
    <div class="button-container">
      <input type="submit" name="Submit" id="Submit" value="Submit"  class="btn btn-primary btn-lg">
                      <a class="btn btn-primary btn-lg btn-block" href="/admin/home.php">Back</a>
                      
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
