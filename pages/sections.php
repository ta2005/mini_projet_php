<?php

require_once __DIR__.'/../include/auth.php';

require_once __DIR__.'/../repos/SectionRepo.php';

$sectionRepo = new SectionRepo($pdo);
$sections = $sectionRepo->getSectionAll();

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Liste des sections</title>
    <link href="/css/style.css" rel="stylesheet" />
    <link href="/css/style_home.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.min.css" />
</head>
<body>
    <?php include __DIR__ . '/../include/navbar.php';?>

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
