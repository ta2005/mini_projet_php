<?php
   declare(strict_types=1);
   error_reporting(E_ALL);
   ini_set('display_errors', '1');

   //the paper didint' say anyting about adding user so tabssi
   class UserRepo{
      public function __construct(private PDO $conn){ }
      public function verfyLogin(string $name,string $pwd):?array {

	 $query='SELECT * FROM UTILISATEUR WHERE name=:name AND password=:pwd';
	 try{
	    $stmt=$this->conn->prepare(query: $query);
	    $stmt->execute(["name"=>$name,"pwd"=>$pwd]);
	    //php snake case is advice becuase variable are case insentive
	    $result=$stmt->fetch();
	    switch($result){
	       case false:return null;
		  default :return $result;
	       }

	    }catch(PDOException $e){
	       print_r($e->getMessage());
	       return null;
	    }
	 }
      }
   ?>
