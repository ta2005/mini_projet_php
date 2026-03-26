<?php
$host   = 'localhost';
$db     = 'gestion_etudiants';
$user   = 'tp_user';
$pass   = 'tp_pass';
$port   = '5432'; // PostgreSQL port

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$db";
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false, // defence against SQL injection
    ]);
} catch (PDOException $e) {
    die("DB Connection Error: ".$e->getMessage());
}

?>
