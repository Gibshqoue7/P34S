<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $project_id = intval($_POST['project_id']); // Securely get project ID
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $phase = htmlspecialchars($_POST['phase']);

    try {
        $db = new SQLite3('projects.db'); // Connect to SQLite database
        $stmt = $db->prepare("UPDATE projects SET title = ?, description = ?, start_date = ?, end_date = ?, phase = ? WHERE id = ?");
        $stmt->bindValue(1, $title, SQLITE3_TEXT);
        $stmt->bindValue(2, $description, SQLITE3_TEXT);
        $stmt->bindValue(3, start_date, SQLITE3_TEXT);
        $stmt->bindValue(4, end_date, SQLITE3_TEXT);
        $stmt->bindValue(5, $phase, SQLITE3_TEXT);
        $stmt->bindValue(6, $project_id, SQLITE3_INTEGER);
        
        $stmt->execute(); // Execute the query
        
        echo "Project updated successfully!";
    } catch (Exception $e) {
        error_log("Database error: " . $e->getMessage());
        echo "An error occurred while updating the project.";
    }
}
?>
