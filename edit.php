<?php
session_start();
include_once __DIR__ . '/autoload.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: listeDesEtudiants.php');
    exit();
}

$etudiantRepo = new Repository('etudiant');
$sectionRepo  = new Repository('section');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = $_POST['name'];
    $date    = $_POST['date_de_naiss'];
    $section = $_POST['section'];
    $imgPath = $_POST['img_actuelle']; // garder l'image actuelle par défaut

    // upload new image
    if (isset($_FILES['img']) && $_FILES['img']['error'] === 0) {
        $ext     = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
        $imgPath = 'images/' . uniqid() . '.' . $ext;
        move_uploaded_file($_FILES['img']['tmp_name'], $imgPath);
    }

    $etudiantRepo->update($id, $name, $date, $imgPath, $section);

    header('Location: listeDesEtudiants.php');
    exit();
}


$etudiant = $etudiantRepo->findEtudiantById($id);
$sections = $sectionRepo->findAll();

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
  <title>Modifier un étudiant</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
</head>
<body>

  <?php include 'navbar.php'; ?>

  <div class="container">
    <div class="card">

      <div class="card-header">Modifier un étudiant</div>

      <div class="form-container">

        <!-- actuelle -->
        <div class="detail-avatar">
          <img src="<?= htmlspecialchars($etudiant['img']) ?>" alt="<?= htmlspecialchars($etudiant['name']) ?>" />
        </div>

        <form action="edit.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data">

          <!-- Champ cache pour garder l'image actuelle -->
          <input type="hidden" name="img_actuelle" value="<?= htmlspecialchars($etudiant['img']) ?>" />

          <div class="form-group">
            <label for="name">Nom</label>
            <input 
              type="text" 
              id="name" 
              name="name" 
              value="<?= htmlspecialchars($etudiant['name']) ?>" 
              required 
            />
          </div>

          <div class="form-group">
            <label for="date">Date de naissance</label>
            <input 
              type="date" 
              id="date" 
              name="date_de_naiss" 
              value="<?= htmlspecialchars($etudiant['date_de_naiss']) ?>" 
              required 
            />
          </div>

          <div class="form-group">
            <label for="img">Changer l'image</label>
            <input type="file" id="img" name="img" accept="image/*" />
          </div>

          <div class="form-group">
            <label for="section">Section</label>
            <select id="section" name="section">
              <?php foreach ($sections as $section): ?>
              <option 
                value="<?= $section['id'] ?>"
                <?= $section['id'] == $etudiant['section_id'] ? 'selected' : '' ?>
              >
                <?= htmlspecialchars($section['des']) ?>
              </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div style="display:flex; gap:10px;">
            <button type="submit" class="btn-submit">
              <i class="fa-solid fa-floppy-disk"></i> Enregistrer
            </button>
            <a href="listeDesEtudiants.php" class="btn-submit" style="background:var(--muted);">
              <i class="fa-solid fa-arrow-left"></i> Retour
            </a>
          </div>

        </form>
      </div>

    </div>
  </div>

</body>
</html>