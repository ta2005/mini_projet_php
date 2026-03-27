<?php
session_start();
require_once 'db.php';

if(!isset($_SESSION['user_id'])) {
    // wait, you're not allowed here!
    header("Location: index.php");
    exit;
}

$query = "
    SELECT e.id, e.name, e.date_de_naissance, e.img_url, s.designation as section_dsg
    FROM etudiant e
    LEFT JOIN section s ON e.section_id = s.id
    ORDER BY e.id ASC
";

$students = $pdo->query($query)->fetchAll();

$role = $_SESSION['role'];
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Liste des étudiants</title>
    <link href="style.css" rel="stylesheet" />
    <link href="style_home.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.6/css/buttons.dataTables.min.css" />

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

    <div style="padding: 20px;">
        <h2 style="background-color: #808080;">Liste des étudiants</h2>

        <div style="margin-bottom: 20px;">
            <input type="text" id="customSearch" placeholder="Veuillez renseigner votre recherche">
            <button id="filtrerBtn" style="background-color: red;">Filtrer</button>

            <?php if($role == 'admin'):?>
                <a href="add_etudiant.php" title="Ajouter Etudiant">
                    <i data-lucide="user-plus" style="color: #286cff; cursor: pointer; margin-left: 10px;"></i>
                </a>
            <?php endif; ?>
        </div>

        <table id="studentsTable" class="display">
            <thead>
                <tr>
                    <th>id</th>
                    <th>image</th>
                    <th>name</th>
                    <th>birthday</th>
                    <th>section</th>
                    <?php if ($role === 'admin'): ?>
                        <th>Actions</th>
                    <?php endif; ?>
                </tr>
            </thead>

            <tbody>
                <?php foreach($students as $s):?>
                <tr>
                    <td><?= $s['id'] ?></td>
                    <td><img src="<?= htmlspecialchars($s['img_url'])?>" width="40" height="40" style="border-radius:50%"></td>
                    <td><?= htmlspecialchars($s['name']) ?></td>
                    <td><?= $s['date_de_naissance'] ?></td>
                    <td><?= htmlspecialchars($s['section_dsg'] ?? 'N\A') ?></td>
                    <?php if($role == 'admin'): ?>
                        <td>
                            <div style="display: flex; gap: 10px; color: #286cff;">
                                <a href="details_etudiant.php?id=<?= $s[id] ?>"><i data-lucide="info" size="18"></i></a>

                                <a href="edit_etudiant.php?id=<?= $s[id] ?>"><i data-lucide="edit-3" size="18"></i></a>

                                <a href="#" onclick="confirmDelete(<?= $s['id'] ?>)"><i data-lucide="eraser" size="18"></i></a>
                            </div>
                        </td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-4.0.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.12/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.12/vfs_fonts.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.6/js/buttons.html5.min.js"></script>

    <script>
        lucide.createIcons();

        $(document).ready(function() {
            let table = $('#studentsTable').DataTable({
                // B = buttons, f = filtering, r = processing,
                // t = table, i = info, p = pagination
                dom: 'Bfrtip',
                buttons: ['copy', 'excel', 'csv', 'pdf'],
                pageLength: 5
            });

            $('filtrerBtn').on('click', function() {
                table.search($('#customSearch').val()).draw();
            });
        });
    </script>

</body>
</html>
