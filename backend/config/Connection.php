<?php

namespace Config;

/**
 * Database Connection Configuration
 * This class handles the database connection settings for the application
 */
class Connection {
    // Database connection parameters
    private $host = "localhost";         // Database host (usually localhost for local development)
    private $port = "3307";             // MySQL default port
    private $database = "school_management"; // Your database name
    private $username = "root";          // Database username
    private $password = "";              // Database password
    private $connection = null;          // Store the connection instance

    /**
     * Get database connection
     * Creates a new connection if none exists, returns existing connection otherwise
     */
    public function getConnection() {
        try {
            // If no connection exists, create a new one
            if ($this->connection === null) {
                // Create DSN (Data Source Name) with port
                $dsn = "mysql:host=" . $this->host . 
                       ";port=" . $this->port .
                       ";dbname=" . $this->database;
                      
                // Create new PDO instance with error handling options
                $this->connection = new \PDO($dsn, $this->username, $this->password, [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                    \PDO::ATTR_EMULATE_PREPARES => false
                ]);
            }

            return $this->connection;
        } catch (\PDOException $e) {
            // Handle connection errors
            die("Connection failed: " . $e->getMessage());
        }
    }
} 