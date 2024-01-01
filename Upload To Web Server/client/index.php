<?php
include "../admin/config.php";

session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // User is logged in, and you can access the entered key
    
  header("Location: keysettings.php");
    // Now, you can use $enteredKey as needed on this page.
}
// Assuming you have already established a database connection and stored it in $con.
if (isset($_POST['login'])) {
    $enteredKey = $_POST['key']; // The key entered by the user

    // Replace 'keys_table' and 'key_value' with your actual table and column names.
    $query = "SELECT * FROM keys_table WHERE key_value = ?";
    $stmt = mysqli_prepare($con, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $enteredKey);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            // Key found in the database, set the session variable to mark the user as logged in.
            $_SESSION['logged_in'] = true;
                $_SESSION['entered_key'] = $enteredKey; // Store the entered key in the session

            header("Location: keysettings.php");
            exit(); // Redirect and exit to prevent further output.
        } else {
            // Key is incorrect, display an error message.
            $error = "Incorrect key. Please try again.";
        }

        mysqli_stmt_close($stmt);
    } else {
        // Handle the case where the statement could not be prepared.
        // You may want to log an error or display an error message.
    }

    mysqli_close($con);
}


if (isset($error)) {
    echo "<p style='color: red;'>$error</p>";
}

?>

<html>
    <head>
    <link rel="shortcut icon" href="favicon.ico">
        <title><?php echo $appName; ?> Licence Manager</title>
        <link href="style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="container">
            <form method="post" action="index.php">
                <div id="div_login">
                    <h1><?php echo $appName; ?> Licence Manager</h1>
                    <center><small>Enter you actvation key To change setting on it.</small></center>
                    <div>
                        <input type="password" class="textbox" id="key" name="key" placeholder="Actvation Key"/>
                    </div>
                    <div>
                      <center> <input type="submit" value="login" name="login" id="but_submit" /> <center/>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>


<?php
// User is not logged in, display the login form with an error message if it exists.



?>
