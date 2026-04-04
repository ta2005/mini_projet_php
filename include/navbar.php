<?php
$curr_page = basename($_SERVER['PHP_SELF']);
?>

<div class="navbar">
    <div class="brand">Students Management System</div>
    <a href="/pages/home.php" class="<?= $curr_page=='home.php' ? 'navbar-selected' : ''?>">Home</a>
    <a href="/pages/etudiants.php" class="<?= $curr_page=='etudiants.php' ? 'navbar-selected' : ''?>">Liste des étudiants</a>
    <a href="/pages/sections.php" class="<?= $curr_page=='sections.php' ? 'navbar-selected' : ''?>">Liste des sections</a>
    <a href="/pages/logout.php">Logout</a>
</div>
