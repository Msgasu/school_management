<?php

namespace Controllers;

use Models\User;
use Config\Connection;

class UserController {
    private $user;
    private $db;
    
    /**
     * Constructor - initialize database connection and user model
     */
    public function __construct() {
        // Get database connection
        $connection = new Connection();
        $this->db = $connection->getConnection();
        
        // Initialize user model
        $this->user = new User($this->db);
    }
    
    /**
     * Register a new user
     * @return array Response with status and message
     */
    public function register() {
        // Get raw posted data
        $data = json_decode(file_get_contents("php://input"), true);
        
        // Validate required fields
        if(!$this->validateRegistrationData($data)) {
            return [
                'status' => 'error',
                'message' => 'Missing required fields'
            ];
        }
        
        // Check if email already exists
        if($this->user->emailExists($data['email'])) {
            return [
                'status' => 'error',
                'message' => 'Email already exists'
            ];
        }
        
        // Attempt to create user
        if($this->user->create($data)) {
            return [
                'status' => 'success',
                'message' => 'User registered successfully'
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Registration failed'
            ];
        }
    }
    
    /**
     * Validate registration data
     * @return boolean True if valid, false otherwise
     */
    private function validateRegistrationData($data) {
        // Check required fields
        $required = ['email', 'password', 'first_name', 'last_name', 'role'];
        
        foreach($required as $field) {
            if(!isset($data[$field]) || empty($data[$field])) {
                return false;
            }
        }
        
        // Validate email format
        if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        
        // Validate password length
        if(strlen($data['password']) < 6) {
            return false;
        }
        
        // Validate role
        $valid_roles = ['student', 'guardian', 'faculty', 'admin'];
        if(!in_array($data['role'], $valid_roles)) {
            return false;
        }
        
        return true;
    }
} 