<?php

session_start();

//App Info
<<<<<<< HEAD
$appName = "DRM Demo ";
$actvationIssueContact = "This ia a demo drm server";
=======
$appName = "DRM DEV";
$actvationIssueContact = "Name of Contact";
>>>>>>> parent of 84f0735 (Added free trials)
$clientAccess = "https://drm.example.com/client";
$appUrl="https://drm.example.com";
$licanceLevle1Name = "Basic";
$licanceLevle2Name = "Intermediate";
$licanceLevle3Name = "Advanced";


//SQL Info
<<<<<<< HEAD
$servername = "IP Adress";
$username = "Username";
$password = "Password";
$database = "actvationkeys";

//Email Info
$SMTPDebug = 0;
$SMTPHost = "IP adress of mail server";
$SMTPAuth = "true";
$SMTPUsername = "Username";
$SMTPPassword = "password";
$SMTPPort = 587;
$SentfromEmail="example.com";
=======
$servername = "127.0.0.1";
$username = "username";
$password = "Password";
$database = "actvationkeys";




>>>>>>> parent of 84f0735 (Added free trials)


//Do NOT CHANGE ANTHYING ElSE AFTER THIS LINE!!
//___________________________________________________________________________________
// Create a connection to the database
$con = new mysqli($servername, $username, $password, $database);

// Check connection
if (!$con) {
 die("Connection failed: " . mysqli_connect_error());
}