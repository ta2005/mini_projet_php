<?php
session_start();
include_once __DIR__ . '/autoload.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = $_POST['name'];
    $date    = $_POST['date_de_naiss'];
    $section = $_POST['section'];
    $imgPath = 'images/default.jpg';

    //upload image
    if (isset($_FILES['img']) && $_FILES['img']['error'] === 0) {
        $ext     = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
        $imgPath = 'images/' . uniqid() . '.' . $ext;
        move_uploaded_file($_FILES['img']['tmp_name'], $imgPath);
    }

    
    $etudiantRepo = new Repository('etudiant');
    $etudiantRepo->insert($name, $date, $imgPath, $section);
    header('Location: listeDesEtudiants.php');
    exit();
}


$sectionRepo = new Repository('section');
$sections = $sectionRepo->findAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Ajouter un étudiant</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>

  <?php include 'navbar.php'; ?>

  <div class="container">
    <div class="card">

      <div class="card-header">Ajouter un étudiant</div>

      <div class="form-container">
        <form action="ajoutEtudiant.php" method="POST" enctype="multipart/form-data">

          <div class="form-group">
            <label for="name">name</label>
            <input type="text" id="name" name="name" placeholder="Veuillez saisir le nom de l'étudiant" required />
          </div>

          <div class="form-group">
            <label for="date">Date de naissance</label>
            <input type="date" id="date" name="date_de_naiss" required />
          </div>

          <div class="form-group">
            <label for="img">Image</label>
            <input type="file" id="img" name="img" accept="image/*" />
          </div>

          <div class="form-group">
            <label for="section">Section</label>
            <select id="section" name="section">
              <?php foreach ($sections as $section): ?>
              <option value="<?= $section['id'] ?>">
                <?= htmlspecialchars($section['des']) ?>
              </option>
              <?php endforeach; ?>
            </select>
          </div>

          <button type="submit" class="btn-submit">Submit</button>

        </form>
      </div>

    </div>
  </div>

</body>
</html>