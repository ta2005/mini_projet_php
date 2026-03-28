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
	<style>
*, *::before, *::after {
    /* This stops padding from making boxes wider than you set them */
    margin: 0;
    padding: 0;
}

	body{
	    display:flex;
	    justify-content:center;
	    align-items:center;
	    font-family:sans-serif;
	}

	form{
	    margin:0px auto;
	}

	input{
	    margin:8px 0;
	}
	.note{
	    font-size:8px;
	    margin-top:-8px;
	    margin-bottom:8px;
	}

	button{
	    padding:5px;
	    background-color:blue;
	    border-radius:5px;
	    color:white;
	}
	</style>
    </head>
    <body>

	<form method="POST" action="index.php">
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
