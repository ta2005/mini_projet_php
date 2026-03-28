<?php session_start(); ?>
<!DOCTYPE html>
<?php $mode = $_COOKIE['mode'] ?? 'dark'; ?>
<html data-bs-theme="<?= $mode ?>" lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

<div class="container mt-4">

  <form action="processLogin.php" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="username" class="form-label">username</label>
      <input type="text" name="username" class="form-control" id="username" placeholder="Enter email">
      <div class="form-text">We'll never share your username with anyone else.</div>
    </div>

    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Password</label>
      <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>

    <button type="submit" class="btn btn-primary">Login</button>
  </form>
</div>

<!-- Popup d'erreur caché par défaut -->
<div id="errorPopup" style="
    display: none;
    position: fixed;
    top: 20px;
    right: 20px;
    background: white;
    border: 1px solid #ccc;
    border-radius: 8px;
    padding: 16px 20px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    z-index: 9999;
    min-width: 250px;
">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px;">
        <strong>Bootstrap</strong>
        <span style="color:red; margin: 0 8px;">Error</span>
        <!-- Croix JS pour fermer le popup -->
        <span onclick="document.getElementById('errorPopup').style.display='none'" 
              style="cursor:pointer; font-weight:bold;">✕</span>
    </div>
    <p style="margin:0;">Veuillez vérifier vos credentials</p>
</div>

<!-- Script JS qui affiche le popup si ?error=1 dans l'URL -->
<script>
    const params = new URLSearchParams(window.location.search);
    if (params.get('error') === '1') {
        document.getElementById('errorPopup').style.display = 'block';
    }
</script>

</body>
</html>