<?php
require_once('function.php');
$pdo = dataBase('mysql', 'localhost', 3306, 'root', 'root', 'work');

$user = getUser($email, $pdo);
$urls = getUrlsById($pdo, $user["user_id"]);
// Renvoyer les données au format JSON
header('Content-Type: application/json');
echo json_encode($urls);
