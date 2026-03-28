<?php 
   session_start();
   if (!isset($_SESSION["role"]) || $_SESSION["role"]!="admin"){
      header("Location:index.php");
      exit();
   }
   require_once(__DIR__.'/../src/entities/Etudiant.php');
   require_once(__DIR__.'/../src/repository/EtudiantRepo.php');
   require_once(__DIR__.'/../src/entities/Section.php');
   require_once(__DIR__.'/../src/repository/SectionRepo.php');
   require_once(__DIR__.'/../src/config.php');
   if ($_SERVER["REQUEST_METHOD"]==="POST"){
      if (empty($_POST["name"]) || empty($_POST["sec"]) || empty($_POST["date_de_naiss"])){
	 header("Location:index.php");
	 exit();
      }
      $std_db = new EtudiantRepo($conn);
      $sec_db = new SectionRepo($conn);
      $sec_id=$sec_db->fetchBydes(des:$_POST["sec"]);
      if ($sec_id!== null){

	 $std_db->create(name:$_POST["name"],
			date:$_POST["date_de_naiss"],
	 		section:$sec_id->getId(),
		  );
      }else{
	 echo '<script>alert("sec not found")</script>';
      }
}

?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Home</title>
      <link rel="stylesheet" href="style.css">
   </head>
   <body>
      <nav class="main_nav">	
      <ul>
	 <li><a>Home</a></li>
	 <li><a href="home.php">Liste des etudiant</a></li>
	 <li><a href="section.php">Liste des section</a></li>
	 <li><a>Logout</a></li>
      </ul>
      </nav>
      <main>
      <p class="affiche">ajouter un etud</p>
      <form method="POST" action="ajouter_etud.php" class="card-form">
	 <input type="text" name="name" required placeholder="donner un nom">
	 <input type="date" name="date_de_naiss" required placeholder="donner votre date de naissance">
	 <input type="text" name="sec" required placeholder="donner votre section">
	 <button type="submit">ajouter</button>
      </form>
      </main>
   </body>
</html>
