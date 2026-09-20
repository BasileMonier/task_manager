<?php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Inscription — Task Manager</title>
<link rel="stylesheet" href="CSS/style.css">
<script src="JS/script.js"></script>
</head>
<body>

  <div class="auth-card">
    <h1>Créer un compte</h1>
    <p class= substile> Task</p>
    <?php if (isset($error)): ?>
      <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="register.php" novalidate>
      <div class="field">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="toi@exemple.com">
      </div>

      <div class="field">
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" placeholder="••••••••">
      </div>

      <button type="submit">S'inscrire</button>
    </form>

    <p class="footer-link">Déjà un compte ? <a href="login.php">Se connecter</a></p>
  </div>

</body>
</html>