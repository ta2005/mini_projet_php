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
      <link rel="stylesheet" href="style.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
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
	 <button type="submit" class="btn-primary">+ Ajouter un étudiant</button>
      </form>
      <table id="etudiantsTable" class="display" style="width:100%">
	 <thead>
	 <tr>
	    <th>id</th>
	    <th>img</th>
	    <th>name</th>
	    <th>date</th>
	    <th>section</th>
	    <th>action</th>
	 </tr>
	 </thead>
	 <?php 
	    require_once(__DIR__.'/../src/entities/Etudiant.php');
	    require_once(__DIR__.'/../src/repository/EtudiantRepo.php');
	    require_once(__DIR__.'/../src/config.php');
	    $id;
	    if (empty($_GET["id"])){
	       $id=null;
	    }else{
	       $id=(int)$_GET["id"];
	    }
	    $std_db = new EtudiantRepo($conn);
	    $students= $std_db->fetchAll($id);
	    if (!empty($students)){
	       foreach ($students as $student){
		  echo $student->toHtml($_SESSION["role"]??"");
	       }
	    }
	 ?>
      </table>
      </main>




      <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
      <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
      <script>
	 $(document).ready(function() {
	    $('#etudiantsTable').DataTable({
	       "pageLength": 5,
	       "language": {
		  "search": "Rechercher:" // French translation for the search bar
	       }
	    });
	 });
      </script>

   </body>
</html>

