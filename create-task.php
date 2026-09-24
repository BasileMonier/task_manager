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
$titre = trim($data['titre'] ?? '');
if ($titre === '') {
    http_response_code(400);
    echo json_encode(['error' => 'title is required']);
}

$statut = "To do";
$date = date("Y-m'd");

$stmt = $db->prepare('INSERT INTO Tasks (user_id, titre, statut, date_creation) VALUES (:user_id, :titre, :statut, :date)');
$stmt->execute([
    ':user_id' => $_SESSION['user_id'],
    ':titre' => $titre,
    ':statut' => $statut,
    ':date' => $date
]);

$newId = $db->lastInsertId();

echo json_encode([
    'success' => true,
    'task' => [
        'id' => $newId,
        'titre' => $titre,
        'statut' => $statut
    ]
]);
?>