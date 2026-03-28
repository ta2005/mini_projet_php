<?php session_start();
   if (!isset($_SESSION["name"])){
      header("Location:index.php");
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
      <p class="affiche">lise des etudiant</p>
      <form methods="PUT" action="ajouter_etud.php">
	 <button type="submit">ajouter</button>
      </form>
      <table>
	 <tr>
	    <td>id</td>
	    <td>img</td>
	    <td>name</td>
	    <td>date</td>
	    <td>section</td>
	 </tr>
	 <?php 
	 require_once(__DIR__.'/../src/entities/Etudiant.php');
	 require_once(__DIR__.'/../src/repository/EtudiantRepo.php');
	 require_once(__DIR__.'/../src/config.php');
	 $std_db = new EtudiantRepo($conn);
	 foreach ($std_db->fetchAll() as $student){
	    echo $student->toHtml($_SESSION["role"]??"");
	 }
	 
      ?>
      </table>
      </main>
   </body>
</html>

