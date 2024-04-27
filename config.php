<?php
// SQLite database configuration
$db = new PDO('sqlite:PROJECT.db'); // SQLite database path
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Enable exceptions
?>
