<?php

require_once 'function.php';

$pdo = dataBase('mysql', 'localhost', 3306, 'root', 'root', 'work');

if (filter_input(INPUT_SERVER, "REQUEST_METHOD") == "POST") {
    $firstName = filter_input(INPUT_POST, "firstName");
    $lastName = filter_input(INPUT_POST, "lastName");
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");
    $erreur = register($firstName, $lastName, $email, $password);
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>

<body>
    <form action="" method="POST">
        <label for="firstName">Prénom :</label>
        <input type="text">
    </form>
</body>

</html>