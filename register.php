<?php
require 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

  $stmt = $db->prepare('SELECT email FROM Users WHERE email = :email');
  $stmt->execute([':email' => $email]);
  $user = $stmt->fetch();
  if ($user) {
    $error = "This email is already taken.";
  } else {
    $password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $db->prepare('INSERT INTO Users (email, password) VALUES (:email, :password)');
    $stmt->execute([':email' => $email, ':password' => $password]);
    header('Location: login.php');
    exit;
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Inscription — Task Manager</title>
<link rel="stylesheet" href="CSS/style.css">
</head>
<body>
  <div class="page-brand">Task.</div>
  <div class="auth-card">
    <h1>Create account</h1>
    <p class= substile> Plan less. Do more.</p>

    <form method="POST" action="register.php" id="formulaire" novalidate>
      <div class="field">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="you@example.com">
      </div>
    <?php if (isset($error)): ?>
      <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
      <div class="field">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="••••••••">
      </div>

      <button type="submit">Sign up</button>
      <p class="real_error" id="formError"></p>
    </form>

    <p class="footer-link">Already have an account ? <a href="login.php">Log in</a></p>
  </div>
  <div class="page-signature">Basile Monier</div>
<script src="JS/script.js"></script>
</body>
</html>