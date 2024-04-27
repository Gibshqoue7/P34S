<?php
require 'config.php'; // Database configuration
require 'functions.php'; // Utility functions for hashing.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize user inputs
    $db = new SQLite3('projects.db'); // Connect to SQLite database
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    if (!$username || !$email || !$password) {
        // Return error if required fields are empty or invalid
        die("Invalid input. Please try again.");
    }

    // Hash the password securely
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    // Store user data in the SQLite database
    try {
        $stmt = $db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
       // $stmt->bindParam('sss', $username, $email, $password);
        // Bind each value to its placeholder (index starts from 1)
$stmt->bindValue(1, $username, SQLITE3_TEXT);
$stmt->bindValue(2, $email, SQLITE3_TEXT);
$stmt->bindValue(3, $password, SQLITE3_TEXT);
        $stmt->execute();
        
        echo "Registration successful! You can now log in.";
    } catch (PDOException $e) {
        if ($e->getCode() === 23000) {
            echo "Error: Username or email already exists.";
        } else {
            echo "An error occurred: " . $e->getMessage();
        }
    }
}
?>
