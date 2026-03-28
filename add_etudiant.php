<?php

require_once 'auth.php';
require_admin();

// Used for combo-box
$sections = $pdo->query("
    SELECT DISTINCT ON(designation) id, designation FROM section
    ORDER BY designation ASC
")->fetchAll();

// Form submission
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name       = trim($_POST['name']);
    $ddn        = $_POST['ddn'];
    $img_url    = trim($_POST['img_url']);
    $section_id = $_POST['section_id'];

    if(!empty($name) && !empty($ddn) && !empty($img_url) && !empty($section_id)) {
        try {
            $stmt = $pdo->prepare("
                INSERT INTO etudiant (name, date_de_naissance, img_url, section_id)
                VALUES (?, ?, ?, ?);
            ");
            $stmt->execute([$name, $ddn, $img_url, $section_id]);

            header("Location: etudiants.php");
            exit;
        } catch(PDOException $e) {
            $err_msg = "Erreur lors de l'ajout: ".$e->getMessage();
        }
    } else {
        $err_msg = "Veuillez remplir les champs.";
    }
}

?>


<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Liste des étudiants</title>
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

    <div style="max-width: 500px; margin: 40px auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; background: #fff;">
        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px; color: var(--accent);">
            <i data-lucide="user-plus"></i>
            <h2 style="margin: 0;">Ajouter un étudiant</h2>
        </div>

        <?php if(isset($err_msg)): ?>
            <p style="color: red;"><?= $err_msg ?></p>
        <?php endif; ?>

        <form method="POST">
            <label>Nom de l'étudiant
                <input type="text" name="name" placeholder="eg: Saul Goodman" required>
            </label>

            <label>Date de naissance
                <input type="date" name="ddn" required>
            </label>

            <label>URL de l'image
                <input type="text" name="img_url" placeholder="https://..." required>
            </label>

            <label>Section
                <select name="section_id" required>
                <option value="">-- Choisir une section --</option>
                <?php foreach ($sections as $sec): ?>
                    <option value="<?= $sec['id'] ?>"><?= htmlspecialchars($sec['designation']) ?></option>
                <?php endforeach; ?>
                </select>
            </label>

            <div style="margin-top: 20px; display: flex; gap: 10px;">
            <button type="submit" style="background-color: var(--accent); color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">Enregistrer</button>
            <a href="etudiants.php" style="text-decoration: none; padding: 10px 20px; background: #eee; color: #333; border-radius: 5px;">Annuler</a>
            </div>
        </form>
    </div>

    <script>lucide.createIcons();</script>
</body>
</html>
