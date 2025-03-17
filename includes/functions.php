<?php
// includes/functions.php

function get_project_by_id($projects, $id) {
    foreach ($projects as $project) {
        if ($project['id'] === $id) {
            return $project;
        }
    }
    return null;
}

// Add CSRF token functions
function generate_csrf_token() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verify_csrf_token($token) {
    if (!isset($_SESSION['csrf_token']) || empty($token)) {
        return false;
    }
    return hash_equals($_SESSION['csrf_token'], $token);
}
