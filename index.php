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
	}

	form{
	    margin:0px auto;
	}

	input{
		font-size:16px;
	    margin:8px 0;
	}
	.note{
	    font-size:14px;
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
        <?php setcookie('mode','light'); ?>
	<form action="processLogin" method="POST" >
	    <label for="user_name">  
		<p>username</p>
		<input type="text" value="" id="user_name" placeholder="Enter Username">
		<p class="note">never share you user name</p>
	    </label>
	    <label for="pwd">
		<p>Password</p>
		<input type="password" value="" id="pwd" placeholder="Password">
		<p><button type="submit">Login</button></p>
		<label>

	</form>
    </body>
</html>
