<?php
session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // If the user is logged in, log them out
    $_SESSION['logged_in'] = false;
    session_unset();
    session_destroy();
}

header("Location: index.php"); // Redirect the user back to the login page
exit;
?>
