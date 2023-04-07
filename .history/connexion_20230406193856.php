<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('WebPage.php');
require_once('function.php');


$pdo = dataBase('mysql', 'localhost', 3306, 'root', 'root', 'work');
$user = getUser("toto@work.com", $pdo);

var_dump($user);
exit();


$page = new WebPage("Connexion");

$page->appendToHead('<link rel="stylesheet" href="connexion.css">');

$page->appendContent(<<<HTML

    <h1>Connexion</h1>
    <form action="" method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Log In</button>
    </form>

HTML);
