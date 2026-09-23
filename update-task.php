<?php
require 'db.php';
session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Not authenticated']);
    exit();
}

$data = json_decode(file_get_contents('php/input'), true);
$taskId = $data['task_id'] ?? null;

if (!$taskId) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing task_id']);
}

$stmt = $db->prepare('SELECT statut FROM Tasks WHERE id = :id AND user_id = :user_id');
$stmt->execute([':id' => $taskId, 'user_id' => $_SESSION['user_id']]);
$task = $stmt->fetch();

if (!$task) {
    http_response_code(404);
    echo json_encode(['error' => 'Task not found']);
    exit();
}

$newStatus = ($task['status'] === 'Done') ? 'To do' : 'Done';

$update = $db->prepare('UPDATE Tasks SET statut = :statut WHERE id = :id AND user_id = :user_id');
$update->execute([':statut' => $newStatus, ':id' => $taskId, 'user_id' => $_SESSION['user_id']]);

echo json_encode(['success' => true, 'new_status' => $newStatus]);
?>