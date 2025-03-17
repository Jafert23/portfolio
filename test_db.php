<?php
require_once 'includes/db.php';

try {
    // Test database connection
    $db = Database::getInstance()->getConnection();
    echo "Database connection successful!\n";
    
    // Test query
    $stmt = $db->query("SELECT NOW() as server_time");
    $result = $stmt->fetch();
    echo "Server time: " . $result['server_time'] . "\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
} 