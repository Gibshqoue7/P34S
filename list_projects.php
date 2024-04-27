<?php
try {
    $db = new SQLite3('projects.db'); // Connect to SQLite database
    $result = $db->query("SELECT * FROM projects"); // Get all projects
    
    $projects = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $projects[] = $row; // Collect projects into an array
    }
    
    // Return the projects as JSON for AJAX or as a list in HTML
    echo json_encode($projects); // Or return HTML content if needed
} catch (Exception $e) {
    error_log("Database error: " . $e->getMessage());
    echo "An error occurred while fetching the projects.";
}
?>
