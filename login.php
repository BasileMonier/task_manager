<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Log in — Task Manager</title>
<link rel="stylesheet" href="CSS/style.css">
</head>
<body>

  <div class="page-brand">Task.</div>

  <div class="auth-card">
    <h1>Welcome back</h1>
    <p class="substile">Log in to your account</p>

    <form method="POST" action="login.php" id="loginForm" novalidate>
      <div class="field">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="you@example.com">
        <?php if (isset($error)): ?>
          <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
      </div>

      <div class="field">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="••••••••">
      </div>

      <button type="submit">Log in</button>
      <p class="real_error" id="formError"></p>
    </form>

    <p class="footer-link">Don't have an account? <a href="register.php">Sign up</a></p>
  </div>

  <div class="page-signature">Basile Monier</div>

<script src="JS/login.js"></script>
</body>
</html>