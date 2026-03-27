<?php
   declare(strict_types=1);
   error_reporting(E_ALL);
   ini_set('display_errors', '1');
   //this is a wrapper class around the section schema
   //it will have create
   //delete
   require_once('../entities/Section.php');

   class SectionRepo{ 
      private PDO $conn;
      public function __construct(PDO $conn){
	 $this->conn=$conn;
      }
      public function fetchAll():?array{
	 $query="SELECT * FROM section";
	 try{
	    $stmt=$this->conn->prepare(query: $query);
	    $stmt->execute();
	    return $stmt->fetchAll(PDO::FETCH_CLASS,"Section");
	 }catch(PDOException $e){
	    print_r($this->conn->errorInfo());
	    return null;
	 }
      }
      public function fetchById(int $id):?Section{
	 $query='SELECT * FROM SECTION WHERE id=?';
	 try{
	    $stmt=$this->conn->prepare(query: $query);
	    $stmt->bindValue(1,$id);
	    $stmt->execute();
	    //php snake case is advice becuase variable are case insentive
	    $stmt->setFetchMode(PDO::FETCH_CLASS,'Section');
	    $result=$stmt->fetch();
	    return ($result?$result:null);
	 }catch(PDOException $e){
	    print_r($this->conn->errorInfo());
	    return null;
	 }
      }
      public function create($designation,$description):?int{
	 $query='INSERT INTO SECTION(designation,description) 
	 VALUES(:designation,:description)
	 RETURNING id;';
	 try{
	    $stmt=$this->conn->prepare(query: $query);
	    $stmt->execute(["designation"=> $designation,"description"=>$description]);
	    //php snake case is advice becuase variable are case insentive
	    echo "success\n";
	    return $stmt->fetchColumn();
	 }catch(PDOException $e){
	    print_r($this->conn->errorInfo());
	    return null;
	 }
      }
      public function delete(int $id):void{
	 $query='DELETE FROM section WHERE id=?';
	 try{
	    $stmt=$this->conn->prepare(query: $query);
	    //the ? are one indexed because fu
	    $stmt->bindValue(1,$id);
	    $stmt->execute();
	    echo "success\n";
	 }catch(PDOException $e){
	    print_r($this->conn->errorInfo());
	 }

      }

   }
   $conn =  new PDO("pgsql:host=localhost;dbname=mini_travail_sel","talel","");
   /* echo $conn->check_version(); */
   $test = new SectionRepo($conn);
   print_r($test->fetchAll());

?>
