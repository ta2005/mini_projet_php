<?php
require_once __DIR__.'/../include/auth.php';

$role = $_SESSION['role'];
?>

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Home - Students Management System</title>
        <link href="/css/style.css" rel="stylesheet" />
        <link href="/css/style_home.css" rel="stylesheet" />
    </head>
    <body>
        <?php include __DIR__ . '/../include/navbar.php';?>

        <div class="content">
            <h1 class="welcome-msg">Hello, PHP LOVERS! Welcome to your administration Platform</h1>
            <p>You are logged in as: <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong> (Role: <?php echo htmlspecialchars($role); ?>)</p>
        </div>
    </body>
</html>
