<?php session_start(); 
include_once 'autoload.php';
$user = $_POST["user"];
$password = $_POST["password"];

$bdd=ConnexionBD::getInstance();
$query="SELECT * FROM users WHERE username=? AND password=?";
$response=$bdd->query($query);
$response->execute([$user,$password]);
$result=$response->fetch();
if(!isset($result)) {
    echo "عاود ثبت";
}
else {
    $query="SELECT role from users where username=$user AND password=$password ";
    $response=$bdd->query($query);
    $response->execute();
    $result=$response->fetch();
    if($resutlt='admin') {
        $_SESSION['user']=$user;
        header('location:admin.php');
    }
    else {
        $_SESSION['user']=$user;
        header('location:normal.php');
    }
}

?>