<?php
session_start();

// Check if user is logged in as admin, else redirect
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

// Process booking management actions (e.g., cancel, mark as paid, etc.)
