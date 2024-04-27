<?php
require 'config.php'; // Database configuration for MySQL

if (isset($_GET['project_id'])) {
    $project_id = intval($_GET['project_id']); // Securely get project ID from the query parameter

    try {
        // Connect to MySQL/MariaDB using PDO
        $db = new PDO("mysql:host=localhost;dbname=projects_db", "your_username", "your_password"); // Update with your credentials
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Enable exceptions for error handling

        // Prepare an SQL query with a parameterized placeholder
        $stmt = $db->prepare("SELECT * FROM projects WHERE project_id = ?");
        
        // Bind the project ID to the query
        $stmt->bindParam(1, $project_id, PDO::PARAM_INT); // Bind project ID as an integer
        
        $stmt->execute(); // Execute the query

        // Fetch the first row as an associative array
        $row = $stmt->fetch(PDO::FETCH_ASSOC); 
        
        if ($row) {
            // Return the project details as JSON or a formatted response
            echo json_encode($row); // Send data as JSON
        } else {
            echo "Project not found.";
        }
        
    } catch (PDOException $e) {
        error_log("Database error: " . htmlspecialchars($e->getMessage())); // Log database errors
        echo "An error occurred while fetching the project details.";
    }
} else {
    echo "No project ID provided.";
}
?>
