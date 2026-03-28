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
      <title>Document</title>
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
      <p class="affiche">liste des section</p>
      <form methods="tabassi" action="url el tabasii">
	 <input value="filtre" placeholder="Veuillez rensigner votre">
	 <button type="submit">Filtrer</button>
      </form>
      <table>
	 <tr>
	    <td>id</td>
	    <td>nom</td>
	    <td>des</td>
	 </tr>
	 <?php 
	 require_once(__DIR__.'/../src/entities/Section.php');
	 require_once(__DIR__.'/../src/repository/SectionRepo.php');
	 require_once(__DIR__.'/../src/config.php');
	 $std_db = new SectionRepo($conn);
	 foreach ($std_db->fetchAll() as $student){
	    echo $student->toHtml();
	 }
	 
      ?>
      </table>
      </main>
   </body>
</html>

