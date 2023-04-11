<?php

// Get the form data
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Connect to the database
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'contactdb';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Insert the form data into the database
$stmt = $conn->prepare('INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)');
$stmt->bind_param('sss', $name, $email, $message);
$stmt->execute();

// Close the database connection
$stmt->close();
$conn->close();

// Redirect to the thank-you page
header('Location: thank-you.html');
exit();

?>
