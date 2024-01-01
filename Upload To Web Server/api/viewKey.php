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

$queryy = "SELECT * FROM keys_table WHERE id = '".$_GET["id"]."'";

$resultsArray = array(); // Array to store results

if ($result = $con->query($queryy)) {
    while ($row = $result->fetch_assoc()) {
        $resultData = array(
            "Actvation Key" => $row["key_value"],
            "Owner" => $row["owner"],
            "Notes" => $row["Notes"],
            "enabled" => $row["enabled"],
            "expire_date" => $row["expire_date"],
            "license_level_id" => $row["value"],
            "hwid" => $row["hwid"],
            "Product_Id" => $row["ProductId"],
            // Add other fields as needed
        );
        
        $field1name = $row["key_value"];
        $field2name = $row["owner"];
        $field3name = $row["Notes"];
        $field4name = $row["enabled"];
        $field5name = $row["expire_date"];
        $field6name = $row["value"];
        $field7name = $row["hwid"];
        $field8name = $row["ProductId"];


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
$id = $_GET["id"];
$action = "view_audit_key_for_id_$id";

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
