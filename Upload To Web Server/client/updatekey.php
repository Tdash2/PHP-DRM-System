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

// Check if an ID is provided in the form
if (isset($enteredKey) && isset($_POST['ActivationId'])) {
    // Get the updated values from the form
    $ActivationId = $_POST['ActivationId'];
    
    // Prepare the SQL statement with placeholders
    $sql = "UPDATE keys_table SET hwid = ? WHERE key_value = ?";
    
    // Initialize a prepared statement
    $stmt = mysqli_prepare($con, $sql);
    
    if ($stmt) {
        // Bind parameters to the statement
        mysqli_stmt_bind_param($stmt, "ss", $ActivationId, $enteredKey);
        
        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            echo "<script> location.href='/client/keysettings.php';</script>";
            exit;
        } else {
            // Handle update error
            echo "Update failed: " . mysqli_error($con);
        }
        
        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Handle statement preparation error
        echo "Statement preparation failed: " . mysqli_error($con);
    }
} else {
    echo "Invalid input or missing data.";
}
?>