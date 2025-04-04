<?php
// Admin credentials
define('ADMIN_USERNAME', 'admin');
// PASTE YOUR NEW PASSWORD HASH HERE FROM generate_password.php
define('ADMIN_PASSWORD_HASH', '$2y$12$AuhAz18r1WjgTG7QmoZvWOSwLiD1a6oXOwFHEA0AZnZosIdJ1EsRi');

// Security settings
define('MAX_LOGIN_ATTEMPTS', 3);
define('LOGIN_TIMEOUT', 900); // 15 minutes in seconds
define('SESSION_LIFETIME', 3600); // 1 hour in seconds

// Configure secure session settings
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1); // Secure cookies for HTTPS
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_samesite', 'Strict');

// Set session garbage collection
ini_set('session.gc_maxlifetime', SESSION_LIFETIME);
session_set_cookie_params([
    'lifetime' => SESSION_LIFETIME,
    'path' => '/admin',
    'domain' => $_SERVER['HTTP_HOST'],
    'secure' => true,  // Require HTTPS
    'httponly' => true,
    'samesite' => 'Strict'  // Strict for production
]);

// Define application URLs
define('PASSWORD_RESET_PAGE', 'https://creativeelliot.com/admin/reset_password.php');
define('LOGIN_PAGE', 'https://creativeelliot.com/admin/login.php');
define('ADMIN_HOME', 'https://creativeelliot.com/admin/submissions.php');

// Login page