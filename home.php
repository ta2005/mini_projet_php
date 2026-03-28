<?php 
    session_start();
    include_once __DIR__ . '/autoload.php';
    // Je ne peux accéder à home que si je suis authentifié
    $user = $_SESSION['user'];
    if (!isset($user)) {
        header('location:login.php');
    }?>
    <!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="welcome">
        <h2>Hello, PHP LOVERS! Welcome to your administration Platform</h2>
    </div>

</body>
</html>


