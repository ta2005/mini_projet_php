<?php 
   session_start();
   if (!isset($_SESSION["role"]) || $_SESSION["role"]!="admin"){
      header("Location:index.php");
      exit();
   }
   require_once(__DIR__.'/../src/entities/Etudiant.php');
   require_once(__DIR__.'/../src/repository/EtudiantRepo.php');
   require_once(__DIR__.'/../src/config.php');
   if ($_SERVER["REQUEST_METHOD"]==="POST"){
      if (empty($_POST["id"])){
	 header("Location:index.php");
	 exit();
      }else{
	 $std_db = new EtudiantRepo($conn);
	 $std_db->delete(id:$_POST["id"]);
      }
      header("Location:home.php");
      exit();
   }else{
      echo '<script>alert("not deleted")</script>';
   }

?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>etud_delete</title>
   </head>
</html>
