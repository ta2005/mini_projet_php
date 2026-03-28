<?php
session_start();
include_once __DIR__ . '/autoload.php';

$username = $_POST['username'] ?? '';
$pwd      = $_POST['password'] ?? '';


$userRepo = new Repository('utilisateur');
$user = $userRepo->findByUserName($username);

// Verifier mot de passe
if ($user && hash('sha256', $pwd) === $user['password']) {
    $_SESSION['user'] = $user;
    $_SESSION['role'] = $user['role'];
    header('location: home.php');
    exit();
} else {
   header('location: login.php?error=1');
   exit();
}
?>