<?php
   declare(strict_types=1);
   error_reporting(E_ALL);
   ini_set('display_errors', '1');
   //this is a wrapper class around the section schema
   //it will have create
   //delete
   require_once('../entities/Etudiant.php');

   class EtudiantRepo{ 
      private PDO $conn;
      public function __construct(PDO $conn){
	 $this->conn=$conn;
      }
      public function fetchAll():?array{
	 $query="SELECT * FROM ETUDIANT";
	 try{
	    $stmt=$this->conn->prepare(query: $query);
	    $stmt->execute();
	    return array_map(fn($row):Etudiant=> new Etudiant(
	       name:$row["name"],
	       date_de_naiss:new DateTimeImmutable($row["date_de_naiss"]),
	       img:$row["img"],
	       section:$row["section"],
	       id:$row["id"],
	    ),
	    $stmt->fetchAll()
	 );

      }catch(PDOException $e){
	 print_r($e->getMessage());
	 return null;
      }
   }
   public function fetchById(int $id):?Etudiant{
      $query='SELECT * FROM ETUDIANT WHERE id=?';
      try{
	 $stmt=$this->conn->prepare(query: $query);
	 $stmt->bindValue(1,$id);
	 $stmt->execute();
	 //php snake case is advice becuase variable are case insentive
	 $result=$stmt->fetch();
	 switch($result){
	    case false:return null;
	       default :return new Etudiant(
		  name:$result["name"],
		  date_de_naiss:new DateTimeImmutable($result["date_de_naiss"]),
		  img:$result["img"],
		  section:$result["section"],
		  id:$result["id"],
	       );
	    }

	 }catch(PDOException $e){
	    print_r($e->getMessage());
	    return null;
	 }
      }
      public function create(string $name,string $date,string $img,int $section):?int{
	 $query=' INSERT INTO Etudiant (name, date_de_naiss, img, section) 
	 VALUES (:name, :date, :img, :section) 
	 RETURNING id;';
	 try{
	    $stmt=$this->conn->prepare(query: $query);
	    $stmt->execute([
	    "name"=>$name, "date"=>$date, "img"=>$img, "section"=>$section 
	    ]);
	    //php snake case is advice becuase variable are case insentive
	    echo "success\n";
	    return $stmt->fetchColumn();
	 }catch(PDOException $e){
	    print_r($e->getMessage());
	    return null;
	 }
      }
      public function delete(int $id):void{
	 $query='DELETE FROM Etudiant WHERE id=?';
	 try{
	    $stmt=$this->conn->prepare(query: $query);
	    //the ? are one indexed because fu
	    $stmt->bindValue(1,$id);
	    $stmt->execute();
	    echo "success\n";
	 }catch(PDOException $e){
	    print_r($e->getMessage());
	 }

      }

   }
   /* $conn =  new PDO("pgsql:host=localhost;dbname=mini_travail_sel","talel",""); */
   /* $test = new EtudiantRepo($conn); */
   /* $test->create("aziz asmi","2006-02-1","tabasi",1); */
   /* foreach ($test->fetchAll() as $etd){ */
   /*    echo $test->delete($etd->getId()); */
   /* } */

?>
