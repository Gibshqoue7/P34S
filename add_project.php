<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = htmlspecialchars($_POST['title']); // Escaping HTML to prevent XSS
    $description = htmlspecialchars($_POST['description']);
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $phase = htmlspecialchars($_POST['phase']);

    try {
        $db = new SQLite3('projects.db'); // Connect to SQLite database
        $stmt = $db->prepare("INSERT INTO projects (title, description, start_date, end_date, phase) VALUES (?, ?, ?, ?, ?)");
        $stmt->bindValue(1, $title, SQLITE3_TEXT);
        $stmt->bindValue(2, $description, SQLITE3_TEXT);
        $stmt->bindValue(3, $start_date, SQLITE3_TEXT);
        $stmt->bindValue(4, $end_date, SQLITE3_TEXT);
        $stmt->bindValue(5, $phase, SQLITE3_TEXT);
        
        $stmt->execute(); // Execute the query
        
        echo "Project added successfully!";
    } catch (Exception $e) {
        error_log("Database error: " . $e->getMessage()); // Log any errors
        echo "An error occurred while adding the project.";
    }
}
?>
