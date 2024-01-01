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

$queryy = "SELECT * FROM keys_table ORDER BY id ASC";

$resultsArray = array(); // Array to store results

if ($result = $con->query($queryy)) {
    while ($row = $result->fetch_assoc()) {
        $resultData = array(
            "owner" => $row["owner"],
            "key_value" => $row["key_value"],
            // Add other fields as needed
        );

        $field4name = $row["value"];
        if ($field4name == 1) $resultData["license_level"] = $licanceLevle1Name;
        elseif ($field4name == 2) $resultData["license_level"] = $licanceLevle2Name;
        elseif ($field4name == 3) $resultData["license_level"] = $licanceLevle3Name;

        $field8name = $row["ProductId"];
        $queryy = "SELECT * FROM products WHERE id = $field8name";
        if ($resultt = $con->query($queryy)) {
            while ($row = $resultt->fetch_assoc()) {
                $resultData["product_name"] = $row["productName"];
            } 
        } 

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
$action = "view_all_actvation_key";

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
