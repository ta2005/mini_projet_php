<?php

require_once __DIR__.'/../include/auth.php';
require_admin();

require_once __DIR__.'/../repos/StudentRepo.php';

// POST, guard against CSRF
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: /pages/etudiants.php?error=method");
    exit;
}

$id = $_POST['id'] ?? null;

if($id) {
    $studentRepo = new StudentRepo($pdo);
    try {
        $studentRepo->deleteStudent($id);

        header("Location: /pages/etudiants.php?deleted=".$id);
        exit;
    } catch (PDOException $e) {
        header("Location: /pages/etudiants.php?error=db");
        exit;
    }
} else {
    header("Location: /pages/etudiants.php?error=id");
    exit;
}

?>
