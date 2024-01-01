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

    $enteredKey = $_GET['key'];
    
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

?>