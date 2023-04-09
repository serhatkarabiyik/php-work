<?php
require_once('function.php');

$pdo = dataBase('mysql', 'localhost', 3306, 'root', 'root', 'work');
$id = filter_input(INPUT_GET, "id");
setIsActive($pdo, $id);
header('Location: accueil.php');
exit();
