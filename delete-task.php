<?php
require 'db.php';
session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Not authentificated']);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);
$taskId = $data['task_id'] ?? null;

if (!$taskId) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing task_id']);
    exit();
}

$stmt = $db->prepare('DELETE FROM Tasks WHERE id = :id AND user_id = :user_id');
$stmt->execute([':id' => $taskId, ':user_id' => $_SESSION['user_id']]);

if ($stmt->rowCount() === 0) {
    http_response_code(404);
    echo json_encode(['error' => 'Task not found']);
    exit();
}

echo json_encode(['success' => true]);
?>