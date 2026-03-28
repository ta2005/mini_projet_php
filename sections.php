<?php

require_once 'auth.php';

$stmt = $pdo->query("
    SELECT * FROM section ORDER BY id ASC
");
$sections = $stmt->fetchAll();

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Liste des sections</title>
    <link href="style.css" rel="stylesheet" />
    <link href="style_home.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.min.css" />
</head>
<body>
    <div class="navbar">
        <div class="brand">Students Management System</div>
        <a href="home.php">Home</a>
        <a href="etudiants.php">Liste des étudiants</a>
        <a href="sections.php" class="navbar-selected">Liste des sections</a>
        <a href="logout.php">Logout</a>
    </div>

    <div style="padding: 20px; max-width: 1000px; margin: 0 auto;">
        <h2 style="background-color: #b8b8b8; color: white;">Liste des sections</h2>

        <table id="sectionsTable" class="display" style="width:100%">
            <thead>
                <th style="text-align: left;">ID</th>
                <th style="text-align: left;">Désignation</th>
                <th style="text-align: left;">Description</th>
            </thead>

            <tbody>
                <?php foreach($sections as $sec): ?>
                <tr>
                    <td><?= $sec['id'] ?></td>
                    <td><?= htmlspecialchars($sec['designation'])?></td>
                    <td><?= htmlspecialchars($sec['description'] ?? 'Aucune description.')?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

    <script src="https://code.jquery.com/jquery-4.0.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#sectionsTable').DataTable({
            pageLength: 10,
            language: {
                search: "Rechercher une section"
            }
        });
    });
    </script>
</body>
</html>
