<?php

require_once 'auth.php';
require_admin();

$id = $_GET['id'] ?? null;

if($id) {
    try {
        $stmt = $pdo->prepare("
            DELETE FROM etudiant WHERE id = ?
        ");
        $stmt->execute([$id]);

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
