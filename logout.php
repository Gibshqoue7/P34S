<?php
session_start(); // Start the session

// Clear all session variables and destroy the session to log out the user
session_unset(); // Clear all session data
session_destroy(); // Destroy the session

// Redirect the user to the login page or a landing page after logging out
header("Location: login_page.html"); // Change to the appropriate redirect page
exit(); // Ensure no further code is executed after redirect
?>
