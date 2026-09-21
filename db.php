<?php

try {
    $dsn = 'mysql:host=localhost;port=8889;dbname=task_manager';
    $user ='root';
    $password='root';
    $db = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
} catch (PDOException $e) {
    $error = $e->getMessage();
    die("Erreur :" . $error);
}

?>