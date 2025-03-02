-- Create database
CREATE DATABASE IF NOT EXISTS school_management;
USE school_management;

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    role ENUM('student', 'guardian', 'faculty', 'admin') NOT NULL,
    profile_image VARCHAR(255),
    phone_number VARCHAR(20),
    date_of_birth DATE,
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL,
    status ENUM('active', 'inactive', 'suspended') DEFAULT 'active',
    
    -- Role-specific fields
    student_id VARCHAR(20) NULL,           -- For students
    class_year VARCHAR(20) NULL,           -- For students
    department VARCHAR(100) NULL,          -- For faculty
    position VARCHAR(100) NULL,            -- For faculty
    relation_to_student VARCHAR(50) NULL,  -- For guardians
    
    -- Add indexes for frequently queried fields
    INDEX idx_email (email),
    INDEX idx_role (role),
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert some sample data
INSERT INTO users (email, password_hash, first_name, last_name, role, phone_number, status) VALUES
('admin@school.com', '$2a$12$LQv3c1yqBWVHxkd0LHAkCOYz6TtxMQJqhN8/LewdBPj2NXFbs5am2', 'John', 'Doe', 'admin', '+233241234567', 'active'),
('teacher@school.com', '$2a$12$LQv3c1yqBWVHxkd0LHAkCOYz6TtxMQJqhN8/LewdBPj2NXFbs5am2', 'Jane', 'Smith', 'faculty', '+233241234568', 'active'),
('student@school.com', '$2a$12$LQv3c1yqBWVHxkd0LHAkCOYz6TtxMQJqhN8/LewdBPj2NXFbs5am2', 'James', 'Wilson', 'student', '+233241234569', 'active'),
('parent@school.com', '$2a$12$LQv3c1yqBWVHxkd0LHAkCOYz6TtxMQJqhN8/LewdBPj2NXFbs5am2', 'Mary', 'Wilson', 'guardian', '+233241234570', 'active'); 