<?php
require_once('function.php');

$pdo = dataBase('mysql', 'localhost', 3306, 'root', 'root', 'work');
$url = filter_input(INPUT_GET, "url");
$id = filter_input(INPUT_GET, "id");
setClick($pdo, $id);
header('Location: ' . $url);
exit();
