<?php
session_start(); // Start the session (ensure this is at the top of your script)
include "../admin/config.php";

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // User is logged in
    $enteredKey = $_SESSION['entered_key'];
    
    $queryy = "SELECT * FROM keys_table WHERE key_value = '".$enteredKey."'";

if ($resultt = $con->query($queryy)) {

    while ($row = $resultt->fetch_assoc()) {
        $field8name = $row["ProductId"];
    }
$resultt->free();
}   
    $query = "SELECT * FROM productInfo WHERE ProductId = $field8name ORDER BY id DESC LIMIT 1"; // Assuming 'files' is your table name

    echo $query;
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $file = '../download/' . $row['file_name']; // Path to the latest file
        $filename = basename($file);

        header('Content-Type: application/octet-stream'); // Change the Content-Type if it's not a PDF
        header("Content-Disposition: attachment; filename=\"$filename\"");
        ob_clean();  // Clean the output buffer before sending the file
        flush();     // Flush the output buffer
        readfile($file);
        exit();
    } else {
        echo "No file found.";
    }
} else {
    header('Location: index.php'); // User is not logged in, handle the case accordingly (e.g., redirect to the login page).
    exit();
}
?>
