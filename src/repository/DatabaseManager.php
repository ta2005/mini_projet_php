<?php
    class DatabaseManager{
	private PDO $conn;
	public function __construct(string $host="localhost",string $dbname="mini_travail_sel",$user="talel",$pwd=""){
	    //i will use snprintf later
	    
	    $this->conn = new PDO("pgsql:host=localhost;dbname=mini_travail_sel","talel","");
	}	
	public function check_version():void{ 
	    $stmt = $this->conn->query("SELECT version()");	
	    var_dump($stmt->fetchall());
	}
    }
?>
