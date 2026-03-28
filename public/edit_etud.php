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
   if ($_SERVER["REQUEST_METHOD"]==="POST" && isset($_POST["submit_update"])){ 
      if (empty($_POST["id"])) {
	 header("Location:home.php");
	 exit();
      }
      $std_db = new EtudiantRepo($conn);
      $sec_db = new SectionRepo($conn);
      $sec_id=null;
      if (!empty($_POST["sec"])){
	 $sec=$sec_db->fetchBydes(des:$_POST["sec"]);
	 if ($sec!==null){
	    $sec_id=$sec->getId();
	 }
      }
      $std_db->update(id:(int)$_POST["id"],
      name:empty($_POST["name"])?null:$_POST["name"],
      date_de_naiss:empty($_POST["date_de_naiss"])?null:$_POST["date_de_naiss"],
      section:$sec_id
   );
   header("Location:home.php");
   exit();
}

?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Home</title>
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
      <p class="affiche">modifier un etud</p>
      <form method="POST" action="edit_etud.php">
	 <input type="text" name="name" placeholder="donner un nom">
	 <input type="date" name="date_de_naiss" placeholder="donner votre date de naissance">
	 <input type="text" name="sec" placeholder="donner votre section">
	 <input type="hidden" name="id" value=<?= $_POST["id"]?> >
	 <button type="submit" name="submit_update">modifier</button>
      </form>
      </main>
   </body>
</html>
