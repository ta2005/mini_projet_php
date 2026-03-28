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
      <p class="affiche">liste des section</p>
      <form methods="tabassi" action="url el tabasii">
	 <input value="filtre" placeholder="Veuillez rensigner votre">
	 <button type="submit">Filtrer</button>
      </form>
      <table id="sectionsTable" class="display" style="width:100%">
	 <thead>
	    <tr>
	       <th>id</th>
	       <th>designation</th>
	       <th>description</th>
	       <th>Action</th>
	    </tr>
	 </thead>
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
      <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
      <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
      <script>
	 $(document).ready(function() {
	    $('#sectionsTable').DataTable({
	       "pageLength": 10,
	       "language": {
		  "search": "Rechercher:" 
	       }
	    });
	 });
      </script>
   </body>
</html>

