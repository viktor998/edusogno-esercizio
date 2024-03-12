<?php
header("Access-Control-Allow-Origin: http://localhost:3000/register");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

// Include the connection.php file
require_once 'connection.php';

// Check if the form data is received
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Process and sanitize the data as needed

    // Check if email already exists
    $checkStmt = $conn->prepare("SELECT * FROM registration WHERE email = ?");
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows) {
        // Email already exists
        $response = array("status" => "error", "message" => "Email already exists. Please choose a different email.");
        echo json_encode($response);
    } else {
        // Prepare the SQL statement
        $insertStmt = $conn->prepare("INSERT INTO registration (firstName, lastName, email, password) VALUES (?, ?, ?, ?)");
        $insertStmt->bind_param("ssss", $firstName, $lastName, $email,  $hashedPassword);

        // Execute the statement
        if ($insertStmt->execute()) {
            $response = array("status" => "success", "message" => "User registered successfully");
            header("Content-Type: application/json");
            echo json_encode($response);
        } else {
            $response = array("status" => "error", "message" => "Error registering user: " . $insertStmt->error);
            header("Content-Type: application/json");
            echo json_encode($response);
        }

        // Close the statement
        $insertStmt->close();
    }

    // Close the check statement
    $checkStmt->close();

    // Close the database connection
    $conn->close();
}
?>
