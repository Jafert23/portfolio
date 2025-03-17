<?php
require_once 'includes/db.php';

try {
    $db = Database::getInstance()->getConnection();
    
    // Read and execute the SQL file
    $sql = file_get_contents('database/contact_submissions.sql');
    $db->exec($sql);
    
    echo "Table created successfully!\n";
    
    // Test the table
    $result = $db->query("SHOW TABLES LIKE 'contact_submissions'");
    if ($result->rowCount() > 0) {
        echo "Verified: contact_submissions table exists.\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
} 