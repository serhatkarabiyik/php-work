<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('WebPage.php');
require_once('function.php');

session_start();
$email = $_SESSION["email"];
$pdo = dataBase('mysql', 'localhost', 3306, 'root', 'root', 'work');
cutLink($pdo);

$user = getUser($email, $pdo);

$page = new WebPage("Acceuil");

$page->appendToHead('<link rel="stylesheet" href="style.css">');


$page->appendContent(<<<HTML

    <h1>QuickLien</h1>
    <p>Bienvenue {$user["first_name"]} {$user["last_name"]} </p>
    <form action="" method="POST">
        <label for="lien">Lien :</label>
        <input type="url" id="lien" name="lien" required>

        <label for="raccourci">Raccourci :</label>
        <input type="text" id="raccourci" name="raccourci" required>

        <div class="action">
            <input type="submit" value="Raccourcir">
        </div>
    </form>

HTML);

echo $page->toHTML();
