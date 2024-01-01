<?php
include "config.php";

if(isset($_POST['but_submit'])){
    $uname = $_POST['txt_uname'];
    $password = $_POST['txt_pwd'];

    if (!empty($uname) && !empty($password)){
        // Use prepared statement to prevent SQL injection
        $sql_query = "SELECT count(*) as cntUser FROM users WHERE username=? AND password=?";
        $stmt = mysqli_prepare($con, $sql_query);

        if ($stmt){
            // Bind parameters
            mysqli_stmt_bind_param($stmt, "ss", $uname, $password);
            
            // Execute the statement
            mysqli_stmt_execute($stmt);

            // Bind the result
            mysqli_stmt_bind_result($stmt, $count);
            
            // Fetch the result
            mysqli_stmt_fetch($stmt);

            // Check the count
            if($count > 0){
                session_start();
                $_SESSION['uname'] = $uname;
                header('Location: home.php');
            }else{
                echo "Invalid username and password";
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        }
    }
}
?>

<html>
    <head>
    <link rel="shortcut icon" href="favicon.ico">
        <title><?php echo $appName; ?> Actvation Key Manager</title>
        <link href="style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="container">
            <form method="post" action="">
                <div id="div_login">
                    <h1><?php echo $appName; ?> Actvation Key Manager</h1>
                    <div>
                        <input type="text" class="textbox" id="txt_uname" name="txt_uname" placeholder="Username" />
                    </div>
                    <div>
                        <input type="password" class="textbox" id="txt_pwd" name="txt_pwd" placeholder="Password"/>
                    </div>
                    <div>
                      <center>  <input type="submit" value="Submit" name="but_submit" id="but_submit" /> <center/>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>
