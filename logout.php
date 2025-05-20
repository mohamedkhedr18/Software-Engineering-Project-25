<?php
require_once 'includes/config.php';
require_once 'includes/db.php';

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Delete remember me cookie if it exists
if (isset($_COOKIE['remember_token'])) {
    setcookie('remember_token', '', time() - 3600, '/');
}

// Redirect to login page
redirect(SITE_URL . '/login.php');
?>