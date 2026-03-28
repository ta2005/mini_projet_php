<?php
   declare(strict_types=1);
   error_reporting(E_ALL);
   ini_set('display_errors', '1');
   //this is a wrapper class around the section schema
   //it will have create
   //delete
   require_once(__DIR__.'/../entities/Etudiant.php');

   class EtudiantRepo{ 
      private PDO $conn;
      public function __construct(PDO $conn){
	 $this->conn=$conn;
      }
      public function fetchAll(?int $section=null):?array{
	 try{
	    $query;
	    $param = [];
	    if ($section !==null){
	       $query="SELECT * FROM ETUDIANT\nWHERE ETUDIANT.section=:section";
	       $param["section"]=$section;
	    }else{
	       $query="SELECT * FROM ETUDIANT\n";
	    }
	    $stmt=$this->conn->prepare(query: $query);
	    $stmt->execute($param);
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
	 error_log($e->getMessage());
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
	    error_log($e->getMessage());
	    return null;
	 }
      }
      public function create(string $name,string $date,int $section,string $img="none"
   ):?int{
      $query=' INSERT INTO Etudiant (name, date_de_naiss, img, section) 
      VALUES (:name, :date, :img, :section) 
      RETURNING id;';
      try{
	 $stmt=$this->conn->prepare(query: $query);
	 $stmt->execute([
	 "name"=>$name, "date"=>$date, "img"=>$img, "section"=>$section 
	 ]);
	 //php snake case is advice becuase variable are case insentive
	 return $stmt->fetchColumn();
      }catch(PDOException $e){
	 error_log($e->getMessage());
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
      }catch(PDOException $e){
	 error_log($e->getMessage());
      }

   }
   public function update(int $id, ?string $name = null, ?string $date_de_naiss = null, ?int $section = null, ?string $img = null): void {

      $fields = [];
      $params = [];

      // Dynamically build the SET clauses and the parameters array
      if ($name !== null) {
	 $fields[] = "name = :name";
	 $params['name'] = $name;
      }
      if ($date_de_naiss !== null) {
	 $fields[] = "date_de_naiss = :date";
	 $params['date'] = $date_de_naiss;
      }
      if ($section !== null) {
	 $fields[] = "section = :section";
	 $params['section'] = $section;
      }
      if ($img !== null) {
	 $fields[] = "img = :img";
	 $params['img'] = $img;
      }

      // If all fields were null, there is nothing to update!
      if (empty($fields)) {
	 return;
      }

      // implode() joins the array with commas: "name = :name, section = :section"
      $query = "UPDATE Etudiant SET " . implode(", ", $fields) . " WHERE id = :id";
      $params['id'] = $id;

      try {
	 $stmt = $this->conn->prepare($query);
	 $stmt->execute($params);
	 error_log("Update success for ID: $id");
      } catch(PDOException $e) {
	 error_log("Update error: " . $e->getMessage());
      }
   }
}
/* $conn = new PDO("pgsql:host=localhost;dbname=mini_travail_sel","talel",""); */
/* $s = new EtudiantRepo($conn); */
/* $s->update(33,"a;sldfkjjjjjjjjj"); */
?>
