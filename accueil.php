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

$urls = getUrlsById($pdo, $user["user_id"]);

$page = new WebPage("Acceuil");

$page->appendToHead('<link rel="stylesheet" href="style.css">');

if (filter_input(INPUT_GET, "registered") == 1) {
    $page->appendContent(<<<HTML
    <div class="success-message">Inscription réussie !</div>
HTML);
} elseif (filter_input(INPUT_GET, "login") == 1) {
    $page->appendContent(<<<HTML
    <div class="success-message">Connexion réussie !</div>
HTML);
}

$page->appendContent(<<<HTML

    <h1>QuickLink</h1>
    <h2>Bienvenue {$user["first_name"]} {$user["last_name"]} </h2>
    <form action="" method="POST" class="raccourci">
        <div>
            <label for="lien">Lien :</label>
            <input type="url" id="lien" name="lien" required>
        </div>
       
        <div>
            <label for="raccourci">Raccourci :</label>
            <input type="text" id="raccourci" name="raccourci" required>
        </div>
        

        <div class="action">
            <input type="submit" value="Raccourcir">
        </div>
    </form>

    <table>
      <thead> 
        <tr>
          <th>Site</th>
          <th>Clics</th>
          <th colspan=2 >Action</th>
        </tr>
       </thead>
       <tbody>

HTML);

foreach ($urls as $url) {
    $page->appendContent(<<<HTML
       <tr>  
            <td><a href="{$url['url']}" target="_blank">{$url["cut_url"]}</a></td>
            <td class = "text-align-center">{$url["click"]}</td>
            <td class = "text-align-center">{$url["isActive"]}</td>
            <td class = "text-align-center" > <button onclick="deleteUrlById({$url['url_id']})">Delete</button></td>
       </tr>

HTML);
}
$page->appendContent(<<<HTML
           </tbody> 
    </table>

HTML);


echo $page->toHTML();
