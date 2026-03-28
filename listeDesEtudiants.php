<?php
session_start();
include_once __DIR__ . '/autoload.php';

$etudiantRepo = new Repository('etudiant');

$parPage      = 10;
$total        = $etudiantRepo->countEtudiants();
$totalPages   = max(1, ceil($total / $parPage));
$pageCourante = (isset($_GET['page']) && is_numeric($_GET['page'])) ? max(1, min((int)$_GET['page'], $totalPages)) : 1;
$offset       = ($pageCourante - 1) * $parPage;

$etudiants = $etudiantRepo->findEtudiantsAndSectionPagine($parPage, $offset);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Liste des étudiants</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
</head>
<body>

  <?php include 'navbar.php'; ?>

  <div class="container">
    <div class="card">

      <div class="card-header">Liste des étudiants</div>

      <div class="toolbar">
        <input type="text" placeholder="Veuillez renseigner votre …" />
        <button class="btn-filter">Filtrer</button>
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
        <a href="ajoutEtudiant.php" class="btn-add">
          <i class="fa-solid fa-user-plus"></i>
        </a>
        <?php endif; ?>
      </div>
      

      <div class="export-bar">
        <div class="export-buttons">
          <button class="btn-export">Copy</button>
          <button class="btn-export">Excel</button>
          <button class="btn-export">CSV</button>
          <button class="btn-export">PDF</button>
        </div>
        <div class="search-bar">
          <span>Search:</span>
          <input type="text" />
        </div>
      </div>

      <table>
        <thead>
          <tr>
            <th>id</th>
            <th>image</th>
            <th>name</th>
            <th>birthday</th>
            <th>section</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($etudiants as $etudiant): ?>
          <tr>
            <td class="cell-id"><?= $etudiant['id'] ?></td>
            <td>
              <img
                src="<?= htmlspecialchars($etudiant['img']) ?>"
                class="avatar"
                alt="<?= htmlspecialchars($etudiant['name']) ?>"
              />
            </td>
            <td><?= htmlspecialchars($etudiant['name']) ?></td>
            <td><?= htmlspecialchars($etudiant['date_de_naiss']) ?></td>
            <td><?= htmlspecialchars($etudiant['section_nom'] ?? 'N/A') ?></td>
            <td>
              <div class="actions">
                <button class="action-btn btn-info" onclick="window.location='view.php?id=<?= $etudiant['id'] ?>'">
                  <i class="fa-solid fa-circle-info"></i>
                </button>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <button class="action-btn btn-edit" onclick="window.location='edit.php?id=<?= $etudiant['id'] ?>'">
                  <i class="fa-solid fa-pen"></i>
                </button>
                <button class="action-btn btn-del" onclick="window.location='deleteEtudiant.php?id=<?= $etudiant['id'] ?>'">
                  <i class="fa-solid fa-trash"></i>
                </button>
                <?php endif; ?>
              </div>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

  
      <div class="pagination-bar">
        <span>
          Showing <?= $offset + 1 ?>–<?= min($offset + $parPage, $total) ?> of <?= $total ?> entries
        </span>

        <div class="pagination">

          <?php if ($pageCourante > 1): ?>
            <a href="listeDesEtudiants.php?page=<?= $pageCourante - 1 ?>"
               class="page-btn">Previous</a>
          <?php else: ?>
            <button class="page-btn" disabled style="opacity:0.4;cursor:default;">Previous</button>
          <?php endif; ?>

       
          <?php for ($p = 1; $p <= $totalPages; $p++): ?>
            <a href="listeDesEtudiants.php?page=<?= $p ?>"
               class="page-btn <?= $p === $pageCourante ? 'active' : '' ?>">
              <?= $p ?>
            </a>
          <?php endfor; ?>

          <?php if ($pageCourante < $totalPages): ?>
            <a href="listeDesEtudiants.php?page=<?= $pageCourante + 1 ?>"
               class="page-btn">Next</a>
          <?php else: ?>
            <button class="page-btn" disabled style="opacity:0.4;cursor:default;">Next</button>
          <?php endif; ?>

        </div>
      </div>

    </div>
  </div>

</body>
</html>