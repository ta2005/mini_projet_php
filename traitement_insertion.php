<?php
session_start();
require_once('connexion.php');

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $birthday = $_POST['birthday'];
    $section = $_POST['section'];
    $image = "";
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image']['name'];
        $target = 'uploads/' . $image;
    }
    try {
        $query = $db_cnx->prepare('
        INSERT INTO etudiants (name, birthday, section, image)
        VALUES (:name, :birthday, :section, :image)
        ');
        $query->execute(array(
            'name' => $name,
            'birthday' => $birthday,
            'section' => $section,
            'image' => $image
        ));
        echo '<meta http-equiv="refresh" content="0;url=etudiants_admin.php">';
        exit();
    }
    catch (PDOException $e) {
        echo "Erreur lors de l'insertion: " . $e->getMessage();
    }
}