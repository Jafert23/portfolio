<?php
// config.php

// Load environment variables
if (!function_exists('getenv_docker')) {
    function getenv_docker($env, $default = null) {
        if (($val = getenv($env)) !== false) {
            return $val;
        }
        
        $envFile = __DIR__ . '/../.env';
        if (file_exists($envFile)) {
            $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                if (strpos($line, '=') !== false) {
                    list($key, $value) = explode('=', $line, 2);
                    if (trim($key) === $env) {
                        return trim($value);
                    }
                }
            }
        }
        return $default;
    }
}

// SMTP Configuration for PHPMailer
define('SMTP_HOST', getenv_docker('SMTP_HOST'));
define('SMTP_USERNAME', getenv_docker('SMTP_USERNAME'));
define('SMTP_PASSWORD', getenv_docker('SMTP_PASSWORD'));
define('SMTP_PORT', getenv_docker('SMTP_PORT', 587));
define('SMTP_ENCRYPTION', getenv_docker('SMTP_ENCRYPTION', 'tls'));

// Recipient Email
define('RECIPIENT_EMAIL', getenv_docker('RECIPIENT_EMAIL'));

// Sender Details
define('SENDER_NAME', getenv_docker('SENDER_NAME', 'Creative Elliot'));

// Verify required configuration
if (!SMTP_HOST || !SMTP_USERNAME || !SMTP_PASSWORD || !RECIPIENT_EMAIL) {
    error_log('Missing required SMTP configuration');
    die('Configuration error. Please check server logs.');
}
?>
