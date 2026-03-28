<?php session_start();
   $error_message;
   if ($_SERVER['REQUEST_METHOD']==='POST'){
      require_once('../src/config.php');
      require_once('../src/repository/UserRepo.php');
      $name=$_POST["name"];
      $pwd=$_POST["pwd"];
      $user_db = new UserRepo($conn);
      $user=$user_db->verfyLogin(name:$name,pwd:$pwd);
      if(isset($pwd) && isset($name) && isset($user)){
	 $_SESSION["name"]=$user["name"];
	 $_SESSION["role"]=$user["role"];
	 header("Location:home.php");
	 exit();
      } else {
	 echo '<script>alert("Inavelid user name of passowrd")</script>';
      }   

   }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
      <link rel="stylesheet" href="style.css">
    </head>
    <body>

       <form method="POST" action="index.php" class="card-form">
	    <label for="user_name">  
		<p>username</p>
		<input type="text" name="name" id="user_name" placeholder="Enter email">
		<p class="note">never share you user name</p>
	    </label>
	    <label for="pwd">
		<p>Password</p>
		<input type="password" name="pwd" id="pwd" placeholder="Password">
	    </label>
	    <p><button type="submit">Login</button></p>
	    <!-- i can make this into a js pop up but tabassi -->
	    <?php 
	       if (isset($error_message)) echo "<p>$error_message</p>";
	    ?>

	</form>
    </body>
</html>
