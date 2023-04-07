<?php

require_once "WepPage.php";

$page = new WebPage("Connexion");

$page->appendToHead('<link rel="stylesheet" href="connexion.css">');

$page->appendContent(<<<HTML

    <h1>Connexion</h1>
    
    <a href="acceuil.php"><button>Acceuil</button></a>


HTML);
