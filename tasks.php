<?php
require 'db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header ('Location: login.php');
    exit();
}
    $stmt = $db->prepare('SELECT id, user_id, titre, description, statut, date_creation FROM Tasks WHERE user_id = :user_id');
    $stmt->execute([':user_id' => $_SESSION['user_id']]);
    $tasks = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Task.</title>
<link rel="stylesheet" href="CSS/style.css">
</head>
<body>
 
  <div class="page-brand">Task.</div>
 
  <div class="tasks-wrapper">
    <h1 class="tasks-title">My tasks</h1>
 
    <div class="task-list">
      <?php if (empty($tasks)): ?>
        <p class="task-empty">Nothing here yet.</p>
      <?php else: ?>
        <?php foreach ($tasks as $index => $task): ?>
          <?php
            $angle = (($task['id'] % 5) - 2) * 0.5; 
            $isDone = ($task['statut'] === 'Done');
          ?>
          <div class="task-row">
            <button type="button" class="task-check <?= $isDone ? 'checked' : '' ?>" data-task-id="<?= $task['id'] ?>">
              <svg viewBox="0 0 24 24"><path d="M4 12l5 5L20 6"/></svg>
            </button>
            <span class="task-text <?= $isDone ? 'done' : '' ?>" style="transform: rotate(<?= $angle ?>deg);">
              <?= htmlspecialchars($task['titre']) ?>
            </span>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
 
  <div class="page-signature">Basile Monier</div>
 
<script src="JS/tasks.js"></script>
</body>
</html>
 
