<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // Not logged in
    header("Location: login.php");
    exit();
}

// Optional: redirect user if they are not admin
function requireAdmin() {
    if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
        header("Location: index.php");
        exit();
    }
}

// Optional: redirect user if they are admin (prevent admin from accessing user-only page)
function requireUserOnly() {
    if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
        header("Location: dashboard.php");
        exit();
    }
}
?>
