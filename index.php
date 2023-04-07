<?php

require_once 'function.php';

$pdo = dataBase('mysql', 'localhost', 3306, 'root', 'root', 'work');


$erreur = register($pdo);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <? if ($erreur) { ?>
        <div class="error-message"><?= $erreur ?></div>
    <? } ?>
    <h1>QuickLink</h1>
    <form action="" method="POST">
        <label for="firstName">Prénom :</label>
        <input type="text" name="firstName" placeholder="John">
        <label for="lastName">Nom :</label>
        <input type="text" name="lastName" placeholder="Doe">
        <label for="email">Email :</label>
        <input type="email" name="email" placeholder="johndoe@example.com">
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" placeholder="********">
        <div class="action">
            <input type="submit" value="Inscription">
            <a href="connexion.php">Connexion</a>
        </div>

    </form>
</body>

</html>