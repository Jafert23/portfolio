<?php
// Configuration
$admin_dir = __DIR__ . '/admin';
$source_files = [
    'security.php',
    'login.php',
    'submissions.php',
    'install.php'
];

// Create admin directory if it doesn't exist
if (!file_exists($admin_dir)) {
    mkdir($admin_dir, 0755, true);
}

// Create logout.php
$logout_content = <<<'EOT'
<?php
session_start();
session_destroy();
header('Location: login.php');
exit;
EOT;

file_put_contents($admin_dir . '/logout.php', $logout_content);

// Copy existing files
foreach ($source_files as $file) {
    if (file_exists($admin_dir . '/' . $file)) {
        continue; // Skip if file already exists
    }
    
    // Copy the file
    copy(__DIR__ . '/admin/' . $file, $admin_dir . '/' . $file);
    chmod($admin_dir . '/' . $file, 0644);
}

echo <<<HTML
<html>
<head>
    <title>Admin Setup</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; max-width: 800px; margin: 40px auto; padding: 20px; }
        .message { background: #f5f5f5; padding: 20px; border-radius: 5px; margin: 20px 0; }
        .next-step { margin-top: 20px; }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>Admin Setup</h1>
    <div class="message">
        <p>Admin files have been set up successfully!</p>
    </div>
    <div class="next-step">
        <p>Click the button below to complete the installation and generate your admin credentials:</p>
        <a href="admin/install.php" class="button">Complete Installation</a>
    </div>
</body>
</html>
HTML; 