<?php
if (isset($_GET['search'])) {
    $search_term = htmlspecialchars($_GET['search']); // Securely get the search term
    
    try {
        $db = new SQLite3('projects.db'); // Connect to SQLite database
        $stmt = $db->prepare("SELECT * FROM projects WHERE title LIKE ? OR start_date = ?");
        $stmt->bindValue(1, '%' . $search_term . '%', SQLITE3_TEXT);
        $stmt->bindValue(2, $search_term, SQLITE3_TEXT);
        
        $result = $stmt->execute(); // Execute the query
        
        $projects = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $projects[] = $row; // Collect matching projects into an array
        }
        
        echo json_encode($projects); // Return the matching projects as JSON or formatted HTML
    } catch (Exception $e) {
        error_log("Database error: " . $e->getMessage());
        echo "An error occurred while searching for projects.";
    }
} else {
    echo "No search term provided.";
}
?>
