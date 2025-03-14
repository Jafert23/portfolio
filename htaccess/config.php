<?php
// config.php

// SMTP Configuration for PHPMailer
define('SMTP_HOST', 'smtp.ionos.com'); // Your SMTP server
define('SMTP_USERNAME', 'Enter Username'); // Your SMTP username
define('SMTP_PASSWORD', 'Enter Password'); // Your SMTP password
define('SMTP_PORT', 587); // SMTP port (e.g., 587 for TLS, 465 for SSL)
define('SMTP_ENCRYPTION', 'tls'); // Encryption: 'tls' or 'ssl'

// Recipient Email
define('RECIPIENT_EMAIL', 'contact@creativeelliot.com'); // Where to receive contact form emails

// Sender Details
define('SENDER_NAME', 'Creative Elliot'); // Your name or business name
?>
