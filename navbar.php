<?php
$curr_page = basename($_SERVER['PHP_SELF']);
?>

<div class="navbar">
    <div class="brand">Students Management System</div>
    <a href="home.php" class="<?= $curr_page=='home.php' ? 'navbar-selected' : ''?>">Home</a>
    <a href="etudiants.php" class="<?= $curr_page=='etudiants.php' ? 'navbar-selected' : ''?>">Liste des étudiants</a>
    <a href="sections.php" class="<?= $curr_page=='sections.php' ? 'navbar-selected' : ''?>">Liste des sections</a>
    <a href="logout.php">Logout</a>
</div>
