<?php
require 'db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
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
<title>My tasks — Task Manager</title>
<link rel="stylesheet" href="CSS/style.css">
</head>
<body>

  <div class="page-brand">Task.</div>
  <a href="logout.php" class="page-logout">Log out</a>

  <div class="tasks-wrapper">
    <div class="tasks-header">
      <h1 class="tasks-title">My tasks</h1>
      <span class="tasks-count" id="tasksCount"><?= count($tasks) ?> open</span>
    </div>

    <div class="task-list" id="taskList">
      <?php if (empty($tasks)): ?>
        <p class="task-empty">Nothing here yet.</p>
      <?php else: ?>
        <?php foreach ($tasks as $task): ?>
          <?php $isDone = ($task['statut'] === 'Done'); ?>
          <div class="task-row">
            <button type="button" class="task-check <?= $isDone ? 'checked' : '' ?>" data-task-id="<?= $task['id'] ?>">
              <svg viewBox="0 0 24 24"><path d="M4 12l5 5L20 6"/></svg>
            </button>
            <div class="task-content">
              <span class="task-text <?= $isDone ? 'done' : '' ?>">
                <?= htmlspecialchars($task['titre']) ?>
              </span>
              <?php if (!empty($task['description'])): ?>
                <span class="task-description"><?= htmlspecialchars($task['description']) ?></span>
              <?php endif; ?>
            </div>
            <button type="button" class="task-delete" data-task-id="<?= $task['id'] ?>">×</button>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>

  <form id="createForm" class="create-form" novalidate>
    <div class="create-title-row">
      <input type="text" id="newTaskTitle" name="titre" placeholder="Add a task...">
      <button type="submit" class="create-submit" aria-label="Add task">+</button>
    </div>
    <input type="text" id="newTaskDescription" name="description" class="create-description" placeholder="Add a description (optional)">
  </form>

  <div class="page-signature">Basile Monier</div>

<script src="JS/tasks.js"></script>
</body>
</html>