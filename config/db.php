<?php

$config = parse_ini_file(__DIR__ . '/env.ini');

if(!$config) {
    die("Couldn't find config file.");
}

$host   = $config['DB_HOST'];
$db     = $config['DB_NAME'];
$user   = $config['DB_USER'];
$pass   = $config['DB_PASS'];
$port   = $config['DB_PORT'];

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
