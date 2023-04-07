<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('WebPage.php');
require_once('function.php');


$pdo = dataBase('mysql', 'localhost', 3306, 'root', 'root', 'work');

$erreur = login($pdo);

$page = new WebPage("Connexion");

$page->appendToHead('<link rel="stylesheet" href="style.css">');

if ($erreur) {
    $page->appendContent(<<<HTML
    
    <div class="error-message">{$erreur}</div>
    
HTML);
}


$page->appendContent(<<<HTML
    
    <h1>QuickLink</h1>
    <form action="" method="POST">
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>

        <div class="action">
            <input type="submit" value="Connexion">
            <a href="index.php">Inscription</a>
        </div>
    </form>

HTML);

echo $page->toHTML();
