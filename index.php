<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Page</title>
    <link href="style.css" rel="stylesheet" />
  </head>
  <body>
	<!--   Display error message if error is set from login.php -->
	<?php if (isset($_GET['error'])): ?>
		<div id="error-msg">
			Vérifier vos crédentiels!
			<span class="close-btn" onclick="document.getElementById('error-msg').style.display='none'">&times;</span>
		</div>
	<?php endif; ?>


    <form method="POST" action="login.php">
      <label for="user_name">
        <p>Username</p>
        <input
          type="text"
          value="user"
          id="user_name"
          placeholder="Enter username"
          required
        />
        <p class="note">Never share you username</p>
      </label>

      <label for="pwd">
        <p>Password</p>
        <input
          type="password"
          value="pwd"
          id="pwd"
          placeholder="Password"
          required
        />
        <p>
          <button type="submit">Login</button>
        </p>
      </label>
    </form>
  </body>
</html>
