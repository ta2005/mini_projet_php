<?php

require_once 'auth.php';
require_admin();

$id = $_GET['id'] ?? null;

if(!$id) {
    header("Location: etudiants.php?error=id");
    exit;
}

$stmt = $pdo->prepare("
    SELECT e.*, s.designation, s.description
    FROM etudiant e
    LEFT JOIN section s ON e.section_id = s.id
    WHERE e.id = ?
");
$stmt->execute([$id]);
$etudiant = $stmt->fetch();

if(!$etudiant) {
    header("Location: etudiants.php?error=nf");
    exit;
}

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Détails de l'étudiant'</title>
    <link href="style.css" rel="stylesheet" />
    <link href="style_home.css" rel="stylesheet" />

    <script src="https://unpkg.com/lucide@1.7.0"></script>
</head>
<body>
    <div class="navbar">
        <div class="brand">Students Management System</div>
        <a href="home.php">Home</a>
        <a href="etudiants.php">Liste des étudiants</a>
        <a href="sections.php">Liste des sections</a>
        <a href="logout.php">Logout</a>
    </div>

    <div style="max-width: 500px; margin: 40px auto; padding: 30px; border: 1px solid #ccc; border-radius: 8px; text-align: center; background: #fff;">

        <img src="<?= htmlspecialchars($etudiant['img_url']) ?>" alt="Photo de profil"
        style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 4px solid var(--accent); margin-bottom: 20px;">

        <h2 style="margin-bottom: 20px; color: #333;"><?= htmlspecialchars($etudiant['name']) ?></h2>

        <div style="text-align: left; margin-top: 20px; line-height: 2; font-size: 16px;">
            <p>
                <i data-lucide="hash" size="18" style="color: var(--accent); vertical-align: middle;"></i>
                <strong>ID :</strong> <?= $etudiant['id'] ?>
            </p>
            <p>
                <i data-lucide="calendar" size="18" style="color: var(--accent); vertical-align: middle;"></i>
                <strong>Date de naissance :</strong> <?= date('d/m/Y', strtotime($etudiant['date_de_naissance'])) ?>
            </p>
            <p>
                <i data-lucide="cog" size="18" style="color: var(--accent); vertical-align: middle;"></i>
                <strong>Section :</strong> <?= htmlspecialchars($etudiant['designation'] ?? 'Non assignée') ?>
                <span style="color: #666; font-size: 14px;">(<?= htmlspecialchars($etudiant['description'] ?? '') ?>)</span>
            </p>
        </div>

        <div style="margin-top: 30px;">
            <a href="etudiants.php" style="text-decoration: none; padding: 10px 20px; background-color: var(--accent); color: white; border-radius: 5px; display: inline-flex; align-items: center; gap: 8px;">
                <i data-lucide="arrow-left" size="18"></i> Retour à la liste
            </a>
        </div>
    </div>

    <script>lucide.createIcons();</script>
</body>
</html>
