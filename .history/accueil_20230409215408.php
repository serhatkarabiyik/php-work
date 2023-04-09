<?php
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

if ($_SESSION['registered'] == 1) {
    $page->appendContent(<<<HTML
    <div class="success-message">Inscription réussie !</div>
HTML);
    $_SESSION['registered'] = 0;
} elseif ($_SESSION['login'] == 1) {
    $page->appendContent(<<<HTML
    <div class="success-message">Connexion réussie !</div>
HTML);
    $_SESSION['login'] = 0;
}
$page->appendJsUrl('<script src="https://kit.fontawesome.com/21e044217e.js" crossorigin="anonymous"></script>');

$page->appendJsUrl('script.js');

$page->appendContent(<<<HTML
    <a href="deconnexion.php" class="logout">Déconnexion</a>
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
    $active = $url['isActive'] === 1 ? "isActive" : "notActive";
    $page->appendContent(<<<HTML
       <tr class="{$active}">  
            <td><a href="go.php?url={$url['url']}&id={$url['url_id']}" target="_blank">{$url["cut_url"]}</a></td>
            <td class="text-align-center">{$url["click"]}</td>
            <td class="text-align-center active pointer">
                <a href="isActive.php?id={$url['url_id']}"></a>
            </td>
            <td class="text-align-center trash pointer">
                <a href="delete.php?id={$url['url_id']}"></a>
            </td>
       </tr>

HTML);
}
$page->appendContent(<<<HTML
           </tbody> 
    </table>

HTML);


echo $page->toHTML();
// <button onclick="deleteUrlById({$url['url_id']})">Delete</button>