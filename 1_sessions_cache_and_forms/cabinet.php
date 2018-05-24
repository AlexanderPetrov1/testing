<?php

/**
 * Simple user cabinet
 */
session_start();

if (isset($_GET['do']) && $_GET['do'] == 'logout') {
    unset($_SESSION['is_logged_in']);
}

if (!isset($_SESSION['is_logged_in'])) {
    header('Location: index.php');
}

echo '<a href="?do=logout">Logout</a>';