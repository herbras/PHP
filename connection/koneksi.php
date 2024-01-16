<?php
$dbname = __DIR__ . '/../database/tes_oshs.db';
$conn = new SQLite3($dbname);

if (!file_exists($dbname)) {
    die("Database file not found at: " . $dbname);
}

?>