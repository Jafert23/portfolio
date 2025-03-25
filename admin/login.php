<?php
require_once 'security.php';
session_start();

// Check if already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: submissions.php');
    exit;
}

$error = '';

// Process login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Check for CSRF token
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            throw new Exception('Invalid request');
        }

        // Validate login attempts
        Security::checkLoginAttempts();

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Validate credentials
        if (Security::validateLogin($username, $password)) {
            $_SESSION['admin_logged_in'] = true;
            Security::regenerateSession();
            Security::resetLoginAttempts();
            header('Location: submissions.php');
            exit;
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

// Generate CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        .login-form {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .login-form input {
            width: 100%;
            padding: 8px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .error {
            color: red;
            margin-bottom: 10px;
            padding: 10px;
            background-color: #fee;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="login-form">
        <h2>Admin Login</h2>
        <?php if ($error): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form method="post" action="" autocomplete="off">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
    </div>
</body>
</html> 