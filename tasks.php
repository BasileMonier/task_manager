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
    var_dump($tasks);
?>