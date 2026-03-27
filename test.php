<?php
    function add(int $x,int $y):int{
	return 2;
    }	

    $x = 'hello';
    $y= 'world';
    echo '$x world';
    echo add(5,3);
    $conn = new PDO("pgsql:host=localhost;dbname=mini_travail_sel","talel","");
    // 2. The Test Query: Ask the database for its version
    $stmt = $conn->query("SELECT version()");
    
    // Fetch the result
    $version = $stmt->fetchColumn();

    // 3. Print the success message!
    /* echo "✅ Connection successful!<br>"; */
    echo " Database Info: " . $version;
?>
