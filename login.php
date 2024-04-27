<?php
require 'config.php'; // Database configuration
require 'functions.php'; // Utility functions for password verification, etc.

session_start(); // Start the session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize user inputs
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    if (!$username || !$password) {
        die("Invalid input. Please try again.");
    }

    // Query the database for the user
    $db = new SQLite3('projects.db'); // Connect to SQLite database
    $stmt = $db->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
$stmt->bindValue(1, $username, SQLITE3_TEXT); // Email binding
$stmt->bindValue(2, $password, SQLITE3_TEXT); // Password binding
    //$stmt = $db->prepare("SELECT *FROM users username, password WHERE username = ? AND password = ?");
    //$stmt->bind_param('s', $username);
    //$stmt->bindValue(1, $username, SQLITE3_TEXT);
//$stmt->bindValue(2, $email, SQLITE3_TEXT);
//$stmt->bindValue(3, $password, SQLITE3_TEXT);
   // $stmt->execute();
    $result = $stmt->execute();

    if ($result) {
      //  $user = $result->fetch_assoc();
        $user = $result->fetchArray(SQLITE3_ASSOC);
            
        // Verify the password
       // if (password_verify($password, $user['password'])) {
            // Successful login
            if ($user) {
                // If user is found, start session and set session variables
                session_start();
            $_SESSION['user_id'] = $user['UserID'];
            $_SESSION['username'] = $user['username'];

            echo "Login successful!";
        } else {
            echo "Invalid username or password.";
        }
    } else {
        echo "Invalid username or password.";
    }
}
?>
