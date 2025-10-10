<?php
/**
 * Database Connection File
 * -------------------------
 * This file establishes a connection to the MySQL database using MySQLi.
 * Uses environment variables for deployment.
 *
 * Author: Sweet Treats Bakery Dev Team
 * Date: 2025
 */

// Database credentials from environment variables
$host = getenv('DB_HOST') ?: 'localhost';
$db = getenv('DB_NAME') ?: 'bakery_db';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: '';

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: Set character encoding
$conn->set_charset("utf8");

// Now you can use $conn to run queries in your other PHP files
?>
