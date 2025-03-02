<?php

require_once 'config/Database.php';

use Config\Database;

// Create database instance
$database = new Database();

try {
    // Try to get connection
    $connection = $database->getConnection();
    echo "Database connection successful!";
} catch (Exception $e) {
    echo "Connection failed: " . $e->getMessage();
} 