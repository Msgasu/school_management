<?php
spl_autoload_register(function ($class) {
    // Convert namespace to file path
    $path = str_replace('\\', '/', $class);
    $file = __DIR__ . '/' . $path . '.php';
    
    // Include file if it exists
    if (file_exists($file)) {
        require_once $file;
        return true;
    }
    return false;
}); 