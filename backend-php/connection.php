<?php


$servername = "127.0.0.1:3306";  
$username = "root";  
$password = ""; 
$dbname = "u494108913_auth";

header("Access-Control-Allow-Origin:http://localhost:3000");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
