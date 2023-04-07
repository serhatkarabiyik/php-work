<?php

require_once "WepPage.php";

$page = new WebPage("Connexion");

$page->appendToHead('<link rel="stylesheet" href="connexion.css">');

$page->appendContent(<<<HTML

    <h1>Connexion</h1>
    <form action="/login" method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Log In</button>
    </form>

HTML);
