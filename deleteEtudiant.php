<?php
session_start();
include_once __DIR__ . '/autoload.php';


if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: listeDesEtudiants.php');
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: listeDesEtudiants.php');
    exit;
}

$id = (int) $_GET['id'];
$etudiantRepo = new Repository('etudiant');

//  existe
$etudiant = $etudiantRepo->findEtudiantById($id);
if (!$etudiant) {
    header('Location: listeDesEtudiants.php');
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmer'])) {
    $etudiantRepo->delete($id);
    header('Location: listeDesEtudiants.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Supprimer un étudiant</title>
  <link rel="stylesheet" href="style.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
</head>
<body>

  <?php include 'navbar.php'; ?>

  <div class="container">
    <div class="card">

      <div class="card-header">Supprimer un étudiant</div>

      <div class="form-container">

        <!-- Avatar + nom -->
        <div class="detail-avatar">
          <img
            src="<?= htmlspecialchars($etudiant['img']) ?>"
            alt="<?= htmlspecialchars($etudiant['name']) ?>"
            style="object-fit: cover;"
          />
        </div>

        <!-- message de confirmation -->
        <p style="text-align:center; font-size:0.95rem; color:var(--text); margin-bottom: 8px;">
          Êtes-vous sûr de vouloir supprimer l'étudiant
          <strong><?= htmlspecialchars($etudiant['name']) ?></strong> ?
        </p>
        <p style="text-align:center; font-size:0.83rem; color:var(--muted); margin-bottom: 28px;">
          <i class="fa-solid fa-triangle-exclamation" style="color:#e07020;"></i>
          Cette action est dangereuseS
        </p>

        <!-- Boutons -->
        <div style="display:flex; justify-content:center; gap:12px;">

          <form method="POST">
            <button type="submit" name="confirmer" class="btn-submit"
              style="background: var(--red); display:flex; align-items:center; gap:8px;">
              <i class="fa-solid fa-trash"></i>
              supprimer
            </button>
          </form>

          <a href="listeDesEtudiants.php"
            style="display:flex; align-items:center; gap:8px;
                   background: var(--navy); color:#fff; border-radius:5px;
                   padding: 9px 24px; font-size:0.9rem; font-weight:600;
                   text-decoration:none; transition: background 0.2s;"
            onmouseover="this.style.background='var(--navy-light)'"
            onmouseout="this.style.background='var(--navy)'">
            <i class="fa-solid fa-arrow-left"></i>
            Annuler
          </a>

        </div>
      </div>

    </div>
  </div>

</body>
</html>