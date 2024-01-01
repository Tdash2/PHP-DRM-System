<?php
include "../admin/config.php";

if (isset($_POST['api_key'])) {
    $apiKey = $_POST['api_key'];

    // Use prepared statement to prevent SQL injection
    $queryl = "SELECT * FROM apiKey WHERE apiKey = ?";
    
    // Prepare the statement
    $stmt = mysqli_prepare($con, $queryl);

    // Bind the API key parameter
    mysqli_stmt_bind_param($stmt, 's', $apiKey);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Get the result
    $resultl = mysqli_stmt_get_result($stmt);

    if ($resultl) {
        // Check if any rows were returned
        if (mysqli_num_rows($resultl) > 0) {
            // API key exists, continue with your script logic here

        } else {
            // API key not found, return 401 Unauthorized
            http_response_code(401);
            die("Unauthorized: API key not found");
        }
    } else {
        // Error in the query
        die("Error: " . mysqli_error($con));
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);

    // Close the database connection
   
} else {
    // API key not provided in the request
    http_response_code(400);
    die("Bad Request: API key not provided");
}

$queryy = "SELECT * FROM activationLog WHERE keyUsed = '".$_GET["key"]."'";

$resultsArray = array(); // Array to store results

if ($result = $con->query($queryy)) {
    while ($row = $result->fetch_assoc()) {
        $resultData = array(
            "Actvation Key Used" => $row["keyUsed"],
            "HWID" => $row["Code"],
            "IP" => $row["IP"],
            "date" => $row["date"],
            "outcome" => $row["outcome"],
            // Add other fields as needed
        );
        
        $field1name = $row["keyUsed"];
        $field2name = $row["Code"];
        $field3name = $row["IP"];
        $field4name = $row["date"];
        $field5name = $row["outcome"];

        $resultsArray[] = $resultData;
    }

    $result->free();
}


if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
    $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
$apikey = $_GET["key"];
$key = $apiKey;
$action = "view_audit_keyusage_for_$apikey";

$log = "INSERT INTO `apiLogs` (`id`, `apiKeyUsed`, `action`, `ip`) VALUES (NULL, '$key', '$action', '$ip')";

if (mysqli_query($con, $log)) {
    
} else {
    echo "Error: " . $log . "<br>" . mysqli_error($con);
}

mysqli_close($con);

// Output JSON data directly
header('Content-Type: application/json');
echo json_encode($resultsArray, JSON_PRETTY_PRINT);
?>
