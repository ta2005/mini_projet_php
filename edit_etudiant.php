<?php

require_once 'auth.php';
require_admin();

$id = $_GET['id'] ?? null;

if(!$id) {
    header("Location: etudiants.php?error=id");
    exit;
}

$stmt = $pdo->prepare("
    SELECT * FROM etudiant WHERE id = ?
");
$stmt->execute([$id]);
$etudiant = $stmt->fetch();

if(!$etudiant) {
    header("Location: etudiants.php?error=nf");
    exit;
}

// for combobox
$sections = $pdo->query("
    SELECT DISTINCT ON (designation) id, designation
    FROM section
    ORDER BY designation, id ASC
")->fetchAll();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $ddn = $_POST['ddn'];
    $img_url = trim($_POST['img_url']);
    $section_id = $_POST['section_id'];

    if (!empty($name) && !empty($ddn) && !empty($img_url) && !empty($section_id)) {
        try {
            $updateStmt = $pdo->prepare("
                UPDATE etudiant
                SET name = ?, date_de_naissance = ?, img_url = ?, section_id = ?
                WHERE id = ?
            ");
            $updateStmt->execute([$name, $ddn, $img_url, $section_id, $id]);

            header("Location: etudiants.php");
            exit;
        } catch (PDOException $e) {
            $err_msg = "Erreur de mise à jour: " . $e->getMessage();
        }
    } else {
        $err_msg = "Veuillez remplir les champs.";
    }
}

?>

<!--Do note that data is prefilled for UX-->

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier étudiant</title>
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

    <div style="max-width: 500px; margin: 40px auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px; background: #fff;">
        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px; color: var(--accent);">
            <i data-lucide="edit-3"></i>
            <h2 style="margin: 0;">Modifier l'étudiant</h2>
        </div>

        <?php if (isset($error)): ?>
        <div id="error-msg" style="position: relative; transform: none; left: 0; bottom: 0; margin-bottom: 15px;">
            <span><?= $error ?></span>
        </div>
        <?php endif; ?>

        <form method="POST">
            <label>Nom de l'étudiant
                <input type="text" name="name" value="<?= htmlspecialchars($etudiant['name']) ?>" required>
            </label>

            <label>Date de naissance
                <input type="date" name="ddn" value="<?= htmlspecialchars($etudiant['date_de_naissance']) ?>" required>
            </label>

            <label>URL de l'image
                <input type="text" name="img_url" value="<?= htmlspecialchars($etudiant['img_url']) ?>" required>
            </label>

            <label>Section
                <select name="section_id" required>
                <option value="">-- Choisir une section --</option>
                <?php foreach ($sections as $sec): ?>
                <option value="<?= $sec['id'] ?>" <?= ($etudiant['section_id'] == $sec['id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($sec['designation']) ?>
                </option>
                <?php endforeach; ?>
                </select>
            </label>

            <div style="margin-top: 20px; display: flex; gap: 10px;">
            <button type="submit" style="background-color: var(--accent); color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">Mettre à jour</button>
            <a href="etudiants.php" style="text-decoration: none; padding: 10px 20px; background: #eee; color: #333; border-radius: 5px;">Annuler</a>
            </div>
        </form>
    </div>

    <script>lucide.createIcons();</script>
</body>
</html>
