<?php

namespace Models;

class User {
    // Database connection
    private $conn;
    
    // User properties
    private $id;
    private $email;
    private $password;
    private $first_name;
    private $last_name;
    private $role;
    private $phone_number;
    private $date_of_birth;
    private $address;
    private $status = 'active';
    
    // Role-specific properties
    private $student_id;
    private $class_year;
    private $department;
    private $position;
    private $relation_to_student;
    
    /**
     * Constructor with database connection
     */
    public function __construct($db) {
        $this->conn = $db;
    }
    
    /**
     * Create new user
     * @return boolean Success or failure
     */
    public function create($data) {
        try {
            // Hash the password
            $password_hash = password_hash($data['password'], PASSWORD_DEFAULT);
            
            // Prepare SQL query
            $query = "INSERT INTO users (
                        email, password_hash, first_name, last_name, 
                        role, phone_number, date_of_birth, address,
                        student_id, class_year, department, position, relation_to_student
                      ) VALUES (
                        :email, :password_hash, :first_name, :last_name,
                        :role, :phone_number, :date_of_birth, :address,
                        :student_id, :class_year, :department, :position, :relation_to_student
                      )";
            
            // Prepare statement
            $stmt = $this->conn->prepare($query);
            
            // Clean and bind data
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':password_hash', $password_hash);
            $stmt->bindParam(':first_name', $data['first_name']);
            $stmt->bindParam(':last_name', $data['last_name']);
            $stmt->bindParam(':role', $data['role']);
            $stmt->bindParam(':phone_number', $data['phone_number'] ?? null);
            $stmt->bindParam(':date_of_birth', $data['date_of_birth'] ?? null);
            $stmt->bindParam(':address', $data['address'] ?? null);
            
            // Bind role-specific fields
            $stmt->bindParam(':student_id', $data['student_id'] ?? null);
            $stmt->bindParam(':class_year', $data['class_year'] ?? null);
            $stmt->bindParam(':department', $data['department'] ?? null);
            $stmt->bindParam(':position', $data['position'] ?? null);
            $stmt->bindParam(':relation_to_student', $data['relation_to_student'] ?? null);
            
            // Execute query
            if($stmt->execute()) {
                return true;
            }
            
            return false;
        } catch (\PDOException $e) {
            // Log error and return false
            error_log("User creation error: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Check if email already exists
     * @return boolean True if exists, false otherwise
     */
    public function emailExists($email) {
        $query = "SELECT id FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        return $stmt->rowCount() > 0;
    }
} 