<?php
session_start();

if(!isset($_SESSION['user_id'])) {
    // wait, you're not allowed here!
    header("Location: index.php");
    exit;
}

$role = $_SESSION['role'];
?>

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Home - Students Management System</title>
        <link href="style.css" rel="stylesheet" />
        <link href="style_home.css" rel="stylesheet" />
    </head>
    <body>
        <div class="navbar">
            <div class="brand">Students Management System</div>
            <a href="home.php">Home</a>
            <a href="etudiants.php">Liste des étudiants</a>
            <a href="sections.php">Liste des sections</a>
            <a href="logout.php">Logout</a>
        </div>

        <div class="content">
            <h1 class="welcome-msg">Hello, PHP LOVERS! Welcome to your administration Platform</h1>
            <p>You are logged in as: <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong> (Role: <?php echo htmlspecialchars($role); ?>)</p>
        </div>
    </body>
</html>
