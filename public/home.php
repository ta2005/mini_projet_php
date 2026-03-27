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
	 <li><a>Liste des etudiant</a></li>
	 <li><a>Liste des section</a></li>
	 <li><a>Logout</a></li>
      </ul>
      </nav>
      <main>
      <p class="affiche">lise des etudiant</p>
      <form methods="tabassi" action="url el tabasii">
	 <input value="filtre" placeholder="Veuillez rensigner votre">
	 <button type="submit">Filtrer</button>
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
	 echo 'hello';
	 foreach ($std_db->fetchAll() as $student){
	    echo $student->toHtml($_SESSION["role"]??"");
	 }
	 
      ?>
      </table>
      </main>
   </body>
</html>

