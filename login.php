<?php

session_start();

require_once 'db.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if(!empty($username) && !empty($password)) {
        try {
            $stmt = $pdo->prepare("
                SELECT id, username, role
                FROM utilisateur
                WHERE username = :username
                AND password = crypt(:password, password)
            ");

            $stmt->execute([
                'username' => $username,
                'password' => $password
            ])

            $user = $stmt->fetch();

            if($user) {
                $_SESSION['user_id']    = $user['id'];
                $_SESSION['username']   = $user['username'];
                $_SESSION['role']       = $user['role'];

                header("HTTP/1.1 501 Not Implemented");
                header("Content-Type: text/plain");

                echo "No home page yet :P";
                exit;
            } else {
                header("Location: index.php?error=creds");
                exit;
            }

        } catch (PDOException $e) {
            header("Location: index.php?error=db");
            exit;
        }
    } else {
        header("Location: index.php?error=vide");
        exit;
    }

} else {
    header("Location: index.php");
    exit;
}




?>
