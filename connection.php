<?php
// Establish database connection
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "dbweb2"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function sanitizeData($data) {
    global $conn;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $conn->real_escape_string($data);
}

function login($email, $password) {
    global $conn;

    $email = sanitizeData($email);
    $password = sanitizeData($password);

    $sql = "SELECT * FROM webuser WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result === false) {
        // Error occurred, return error message
        return "Error: " . $conn->error;
    } elseif ($result->num_rows > 0) {
        // User exists, return true for successful login
        return true;
    } else {
        // Invalid credentials, return error message
        return "Invalid email or password";
    }
}
?>
