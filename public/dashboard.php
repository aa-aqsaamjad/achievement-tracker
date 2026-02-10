<?php
session_start();

// block unauthenticated users
if (!isset($_SESSION['student_id'])) {
    header("Location: /achievement-tracker/public/auth.php");
    exit;
}

require __DIR__ . '/../src/views/dashboard.php';
