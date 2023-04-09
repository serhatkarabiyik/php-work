<?php
require_once('function.php');

$pdo = dataBase('mysql', 'localhost', 3306, 'root', 'root', 'work');
$id = filter_input(INPUT_GET, "id");
deleteUrlById($pdo, $id);
header('Location: accueil.php');
exit();
