<?php
require_once 'config.php';

class Security {
    public static function checkLoginAttempts() {
        if (!isset($_SESSION['login_attempts'])) {
            $_SESSION['login_attempts'] = 0;
            $_SESSION['last_attempt'] = time();
            return true;
        }

        // Check if timeout has passed
        if ($_SESSION['login_attempts'] >= MAX_LOGIN_ATTEMPTS) {
            $timeout_remaining = ($_SESSION['last_attempt'] + LOGIN_TIMEOUT) - time();
            if ($timeout_remaining > 0) {
                throw new Exception("Too many login attempts. Please try again in " . ceil($timeout_remaining / 60) . " minutes.");
            }
            // Reset attempts after timeout
            $_SESSION['login_attempts'] = 0;
        }
        return true;
    }

    public static function incrementLoginAttempts() {
        $_SESSION['login_attempts'] = ($_SESSION['login_attempts'] ?? 0) + 1;
        $_SESSION['last_attempt'] = time();
    }

    public static function resetLoginAttempts() {
        $_SESSION['login_attempts'] = 0;
        $_SESSION['last_attempt'] = null;
    }

    public static function validateLogin($username, $password) {
        if ($username !== ADMIN_USERNAME || !password_verify($password, ADMIN_PASSWORD_HASH)) {
            self::incrementLoginAttempts();
            throw new Exception('Invalid credentials');
        }
        return true;
    }

    public static function regenerateSession() {
        // Regenerate session ID to prevent session fixation
        session_regenerate_id(true);
        $_SESSION['last_activity'] = time();
        $_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'];
        $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
    }

    public static function validateSession() {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header('Location: login.php');
            exit;
        }

        // Check session expiry
        if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > SESSION_LIFETIME)) {
            session_destroy();
            header('Location: login.php?error=expired');
            exit;
        }

        // Validate IP and user agent
        if ($_SESSION['ip_address'] !== $_SERVER['REMOTE_ADDR'] || 
            $_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT']) {
            session_destroy();
            header('Location: login.php?error=invalid');
            exit;
        }

        // Update last activity
        $_SESSION['last_activity'] = time();
    }
} 