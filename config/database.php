<?php

// Load environment variables from a separate configuration file
$config = parse_ini_file('config.ini', true);

// Database configuration
$dbHost = $config['database']['host'];
$dbName = $config['database']['dbname'];
$dbUser = $config['database']['username'];
$dbPass = $config['database']['password'];

try {
    // Establish a secure database connection using PDO
    $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=utf8";
    $conn = new PDO($dsn, $dbUser, $dbPass);

    // Set PDO error mode to exception for better error handling
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Proceed with database operations using the $conn object
} catch (PDOException $e) {
    // Handle any database connection errors
    die("Connection Failed: " . $e->getMessage());
}
