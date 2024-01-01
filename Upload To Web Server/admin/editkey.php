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

// Initialize variables to store data from the database
$name = "";
$email = "";
$date = "";
$message = "";
$key = "";
$enabled = "";
$ProductId = "";

// Check if an ID is provided in the URL (assuming you have an ID to identify the record)
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Perform a database query to retrieve the data based on the ID
    $sql = "SELECT * FROM keys_table WHERE id = $id"; // Replace your_table_name with your actual table name
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
        $ProductId = $row['ProductId'];
    }
    
    
}
?>

<!DOCTYPE html>
<html lang="en">
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
        <h2>Edit Actvation Key: <?php echo $key; ?> </h2>
    </div>
    <fieldset>
        <form name="frmContact" class="needs-validation " method="post" action="updatekey.php">
            <p>
                <label for="Name">Licence To</label>
                <input type="text" class="form-control" name="txtName" id="txtName" placeholder="Name" value="<?php echo $name; ?>" required>
                <div class="invalid-feedback">
                    Valid name is required.
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
                        <p>
                <label for="Name">HWID</label>
                <input type="text" class="form-control" name="ActivationId" id="ActivationId" placeholder="Name" value="<?php echo $ActivationId; ?>" required>
                <div class="invalid-feedback">
                    Valid Activation Id required.
                </div>
            </p>
            
            
            
            <p>
                <label for="email">Licence Type</label>
                
                <br><select id="txtEmail" name="txtEmail">
    <option value="1" <?php if ($email == 1) echo "selected"; ?>><?php echo $licanceLevle1Name; ?></option>
    <option value="2" <?php if ($email == 2) echo "selected"; ?>><?php echo $licanceLevle2Name; ?></option>
    <option value="3" <?php if ($email == 3) echo "selected"; ?>><?php echo $licanceLevle3Name; ?></option>
</select>
</br>
            </p>
            <p>
                <label for="email">Key Enabled</label>
                <br>
                <select id="txtenabled" name="txtenabled">
                    <option value="0" <?php if ($enabled == 0) echo "selected"; ?>>Dissabled</option>
                    <option value="1" <?php if ($enabled == 1) echo "selected"; ?>>Enabled</option>

                </select></br>
            </p>
            
            
           <label for="date"> Expiration Date (Note: For an Infinite key use 0001-01-01)</label>
    <div class="input-group">
        <input type="text" class="form-control" name="txtdate" id="txtdate" placeholder="Date YYYY-MM-DD" value="<?php echo $date; ?>" required>
        <div class="input-group-append">
            <button type="button" class="btn btn-outline-secondary" id="calendarButton">Pick a Date</button>
        </div>
    </div>
            <p>
                <label for="message">Note</label>
                <textarea name="txtMessage" class="form-control" id="txtMessage" placeholder="Message" required><?php echo $message; ?></textarea>
            </p>
            <p>&nbsp;</p>
            <p>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="button-container">
                <input type="submit" name="Submit" id="Submit" value="Submit" class="btn btn-primary btn-lg">
                
                <a class="btn btn-primary btn-lg btn-block" href="/admin/viewkey.php?id=<?php echo $id; ?>">Back</a>
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
