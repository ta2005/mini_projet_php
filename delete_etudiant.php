<?php

require_once 'auth.php';
require_admin();

require_once 'repos/StudentRepo.php';

$studentRepo = new StudentRepo($pdo);

$id = $_GET['id'] ?? null;

if($id) {
    try {
        $studentRepo->deleteStudent($id);

        header("Location: etudiants.php?deleted=".$id);
        exit;
    } catch (PDOException $e) {
        header("Location: etudiants.php?error=db");
        exit;
    }
} else {
    header("Location: etudiants.php?error=id");
    exit;
}

?>
