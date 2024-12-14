<?php
require_once __DIR__ . '/../controllers/SessionManager.php';

// Start session if not already started
SessionManager::startSession();

// Destroy the session
SessionManager::destroySession();

// Redirect to the homepage or login page
header('Location: ../public_html/index.php');
exit;
?>
