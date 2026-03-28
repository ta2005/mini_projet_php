<?php

session_start();
require_once 'db.php';

// Login requirement
if(!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// Administrative priviliges required
function require_admin() {
    if($_SESSION['role'] !== 'admin') {
        header("Location: home.php");
        exit;
    }
}

?>
