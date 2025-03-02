<?php

require_once 'config/Connection.php';

use Config\Connection;

// Create database instance
$database = new Connection();

try {
    // Try to get connection
    $connection = $database->getConnection();
    echo "Database connection successful!";
} catch (Exception $e) {
    echo "Connection failed: " . $e->getMessage();
}