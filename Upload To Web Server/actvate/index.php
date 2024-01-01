<?php
// Define your MySQL database connection details
include "../admin/config.php";
 
// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the key and hwid sent by the client
$key = $_GET['key'];
$hwid = $_GET['hwid'];
$clientProductId = $_GET['pid'];
// Validate that the key and hwid only contain alphanumeric characters
if (!ctype_alnum($key) || !ctype_alnum($hwid)) {
    // Return a 400 (Bad Request) response if the key or hwid is invalid
    http_response_code(400);
    echo "Invalid key or hwid format.";
    exit;
}

// Prepare a SQL query using a prepared statement to check if the key exists in the database
$query = "SELECT owner, value, expire_date, enabled, hwid, ProductId  FROM keys_table WHERE key_value = ?";


// Close the result set and the database connection when you're done


$stmt = $con->prepare($query);
$stmt->bind_param("s", $key);
$stmt->execute();
$result = $stmt->get_result();
$outcome="";
    $date = date("Y-m-d");

if ($result->num_rows > 0) {
    // Key exists in the database, fetch the row
    $row = $result->fetch_assoc();
    $owner = $row['owner'];
    $value = $row['value'];
    $expireDate = $row['expire_date'];
    $enabled = $row['enabled'];
    $dbHwid = $row['hwid'];
    $serverProductId = $row["ProductId"];
    
    
$query2 = "SELECT version, Messages FROM productInfo WHERE productID = $serverProductId ORDER BY id DESC LIMIT 1";
$result2 = mysqli_query($con, $query2);
$newestItem = mysqli_fetch_assoc($result2);

$Version = $newestItem['version'];
$message = $newestItem['Messages'];

   // Get the client's IP address considering Cloudflare
if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
    $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

    if ($expireDate != "0001-01-01" && time() > strtotime($expireDate)) {
        echo "License key has expired. Contact " .$actvationIssueContact." for more info";
        $outcome= "License key has expired. ";
    } elseif ($enabled == 0) {
        echo "Key is disabled. Contact " .$actvationIssueContact." for more info";
        $outcome= "Key is disabled.";
    } elseif ($expireDate == "0001-01-01") {
        // Key never expires
        if ($hwid === $dbHwid) {
          if ($clientProductId ===  $serverProductId) {
            http_response_code(201);
            echo "$owner\n";
            echo "$value\n";
            echo "Infinite Days\n";
            $outcome="Successful";
            echo "$Version\n";
            echo "Please update by downloading the newest verson form: " .$clientAccess." to insure you app is up to date.\n";
            echo "$message";
            
            }
            else{
            $outcome= "This key is only for use with different program";
            echo "This key is only for use with different program";
        } }
        else {
            $outcome= "HWID does not match. HWID is: " .$hwid;
            echo "HWID does not match. Go to " .$clientAccess." to update you HWID. Your HWID is: " .$hwid;
        }
    } else {
        // Check if the hwid matches the one in the database
        if ($hwid === $dbHwid) {
          if ($clientProductId ===  $serverProductId) {
<<<<<<< HEAD
            if($istrial == "1"){
            $activationKey = $key;
            
            // Use prepared statement to prevent SQL injection
              $selectSql = "SELECT * FROM UsedTrialHWID WHERE actvationKey != ? AND HWID = ?";
              
              $stmt = mysqli_prepare($con, $selectSql);
              
              if ($stmt) {
                  // Bind parameters to the prepared statement
                  mysqli_stmt_bind_param($stmt, "ss", $activationKey, $hwid);
                  
                  // Execute the statement
                  mysqli_stmt_execute($stmt);
                  
                  // Get result
                  mysqli_stmt_store_result($stmt);
                  
              
                  $amountUsed = mysqli_stmt_num_rows($stmt);
                  // Check if there are any rows in the result set
                  
                  if (mysqli_stmt_num_rows($stmt) > 0) {
                      echo "Trial verson registared to this computer before.";
                          $outcome= "License key is invalid. HWID use on other key";
                      
                  } else {
                      // If no results found, insert the data into the database
                      $insertSql = "INSERT INTO UsedTrialHWID (HWID, actvationKey) VALUES (?, ?)";
                      $insertStmt = mysqli_prepare($con, $insertSql);
              
                      if ($insertStmt) {
                          // Bind parameters to the prepared statement
                          mysqli_stmt_bind_param($insertStmt, "ss", $hwid, $activationKey);
                          
                          // Execute the statement to insert data
                          mysqli_stmt_execute($insertStmt);
              
                          $currentDate = date("Y-m-d");
                          $daysRemaining = ceil((strtotime($expireDate) - strtotime($currentDate)) / 86400); // Calculate days remaining
                          http_response_code(201);
                          echo "$owner\n";
                          echo "$value\n";
                          echo "$daysRemaining days (Trial)\n";
                          $outcome="Successful";
                          echo "$Version\n";
                          echo "Please update by downloading the newest verson form: " .$appUrl."/client to insure you app is up to date.\n";
                          echo "$message";
                        
                          // Close the insert statement
                          
                      } else {
                          echo "Error preparing insert statement: " . mysqli_error($con);
                      }
                  }
              
                  // Close the select statement
                 
              } else {
                  echo "Error preparing statement: " . mysqli_error($con);
              }
              }
              else{
              
                // Key is valid and hwid matches, calculate the remaining days and return a 200 (OK) response with owner and value
                $currentDate = date("Y-m-d");
                $daysRemaining = ceil((strtotime($expireDate) - strtotime($currentDate)) / 86400); // Calculate days remaining
                http_response_code(201);
                echo "$owner\n";
                echo "$value\n";
                echo "$daysRemaining days\n";
                $outcome="Successful";
                echo "$Version\n";
                echo "Please update by downloading the newest verson form: " .$appUrl."/client to insure you app is up to date.\n";
                echo "$message";
            }}
            else{
            $outcome= "This key is only for use with a different program";
            echo "This key is only for use with a different program";
            }
         }else {
=======
            // Key is valid and hwid matches, calculate the remaining days and return a 200 (OK) response with owner and value
            $currentDate = date("Y-m-d");
            $daysRemaining = ceil((strtotime($expireDate) - strtotime($currentDate)) / 86400); // Calculate days remaining
            http_response_code(201);
            echo "$owner\n";
            echo "$value\n";
            echo "$daysRemaining days\n";
            $outcome="Successful";
            echo "$Version\n";
            echo "Please update by downloading the newest verson form: " .$appUrl."/client to insure you app is up to date.\n";
            echo "$message";
          }
            else{
            $outcome= "This key is only for use with different program";
            echo "This key is only for use with different program";
        } }else {
>>>>>>> parent of 84f0735 (Added free trials)
            // Key is correct, but hwid is wrong
            $outcome= "HWID does not match. HWID is: " .$hwid;
            echo "HWID does not match. Contact " .$actvationIssueContact." for assistance. Your HWID is: " .$hwid;
        }
    }
} else {
    echo "License key ($key) is invalid";
    $outcome= "License key is invalid";
}
    $sql = "INSERT INTO activationLog (keyUsed, Code, Date, IP, outcome) VALUES ('$key', '$hwid', '$date', '$ip', '$outcome')";
   $rs = mysqli_query($con, $sql);

// Close the prepared statement and the database connection
$stmt->close();
$con->close();

?>