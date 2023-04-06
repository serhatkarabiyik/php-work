<?php

require_once "WepPage.php";

$page = new WebPage("Connexion");

$page->appendToHead('<link rel="stylesheet" href="categorie.css">');

$page->appendContent(<<<HTML

    <h1>Voici les Catégories de Film de Sakila</h1>
    
    <a href="acceuil.php"><button>Acceuil</button></a>


HTML);
