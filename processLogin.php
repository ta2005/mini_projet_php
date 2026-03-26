<?php session_start(); 
include_once 'autoload.php';
$user = $_POST["user"];
$password = $_POST["password"];

$bdd=ConnexionBD::getInstance();
$query="SELECT * FROM users WHERE username=? AND password=?";
$response=$bdd->prepare($query);
$response->execute([$user,$password]);
$result=$response->fetch();
if(!$result) {
    echo "عاود ثبت";
}
else {
    $role = $result['role'];
    $_SESSION['user']=$user;
    $_SESSION['role']=$result;

    if($role='admin') {
        header('location:admin.php');
    }
    else {
        header('location:normal.php');
    }
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<?php if ($error): ?>
<div class="alert alert-danger alert-dismissible fade show" style="width: 250px;">
    <strong>Login</strong>
    <button type="button" class="btn-close float-end" data-bs-dismiss="alert"></button>
    <br>
    <small><?php echo $error; ?></small>
</div>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>