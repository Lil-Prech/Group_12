<?php
$db = new SQLite3('database/census_data.db');
if (!$db) {
    die("Database connection failed");
}


?>
