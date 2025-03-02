<?php
// Set headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Include autoloader
require_once '../autoload.php';

use Controllers\UserController;

// Handle preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Check if request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
    exit;
}

// Get JSON input
$data = json_decode(file_get_contents("php://input"), true);

// Process registration request
$controller = new UserController();
$result = $controller->register();

// Set response code and return JSON
if ($result['status'] === 'success') {
    // Redirect on success
    header('Location: http://localhost:3000/signin');
    exit;
} else {
    // Return to signup page with error
    header('Location:../src/components/auth/signup?error=' . urlencode($result['message']));
    exit;
} 