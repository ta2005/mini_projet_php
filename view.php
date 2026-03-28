<?php
session_start();
include_once __DIR__ . '/autoload.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: listeDesEtudiants.php');
    exit();
}

$etudiantRepo = new Repository('etudiant');
$etudiant = $etudiantRepo->findEtudiantById($id);

if (!$etudiant) {
    header('Location: listeDesEtudiants.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Détail étudiant</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
</head>
<body>

  <?php include 'navbar.php'; ?>

  <div class="container">
    <div class="card">

      <div class="card-header">Détail de l'étudiant</div>

      <div class="form-container">

        <div class="detail-avatar">
          <img src="<?= htmlspecialchars($etudiant['img']) ?>" alt="<?= htmlspecialchars($etudiant['name']) ?>" />
        </div>

        <div class="form-group">
          <label>Nom</label>
          <div class="detail-value"><?= htmlspecialchars($etudiant['name']) ?></div>
        </div>

        <div class="form-group">
          <label>Date de naissance</label>
          <div class="detail-value"><?= htmlspecialchars($etudiant['date_de_naiss']) ?></div>
        </div>

        <div class="form-group">
          <label>Section</label>
          <div class="detail-value"><?= htmlspecialchars($etudiant['section_nom'] ?? 'N/A') ?></div>
        </div>

        <a href="listeDesEtudiants.php" class="btn-submit">
          <i class="fa-solid fa-arrow-left"></i> Retour
        </a>

      </div>

    </div>
  </div>

</body>
</html>