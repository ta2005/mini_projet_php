<?php
session_start();
require_once 'autoload.php';

// block anyone who is not admin
if (!isset($_SESSION['user']) || $_SESSION['role'] != 'admin') {
    echo json_encode(['success' => false, 'error' => 'Unauthorized']);
    exit();
}

$bdd    = ConnexionBD::getInstance();
$action = $_POST['action'];

if ($action == 'add') {
   if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
        $ext= pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
        $filename = 'img/' . uniqid() . '.' . $ext;
        move_uploaded_file($_FILES['img']['tmp_name'], $filename);
    } else {
        $filename = 'img/unknown.png'; // default if no image uploaded
    }
    $query = "INSERT INTO students (name, date_de_naiss, img, section) VALUES (?, ?, ?, ?)";
    $stmt  = $bdd->prepare($query);
    $stmt->execute([$_POST['name'], $_POST['date'], $filename, $_POST['section']]);
    echo json_encode(['success' => true]);

} else if ($action == 'edit') {
    $query = "UPDATE students SET name=?, date_de_naiss=?, section=? WHERE id=?";
    $stmt  = $bdd->prepare($query);
    $stmt->execute([$_POST['name'], $_POST['date'], $_POST['section'], $_POST['id']]);
    echo json_encode(['success' => true]);

} else if ($action == 'delete') {
    $query = "DELETE FROM students WHERE id=?";
    $stmt  = $bdd->prepare($query);
    $stmt->execute([$_POST['id']]);
    echo json_encode(['success' => true]);
}
?>