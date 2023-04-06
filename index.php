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

    <style>
        form {
            background-color: #f5f5f5;
            border: 2px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            max-width: 400px;
            margin: 0 auto;
            font-family: Arial, sans-serif;
        }

        /* Style des labels */
        label {
            display: block;
            margin-bottom: 5px;
        }

        /* Style des champs de saisie */
        input[type="text"],
        input[type="password"] {
            padding: 10px;
            border-radius: 5px;
            border: none;
            width: 100%;
            margin-bottom: 20px;
        }

        /* Style du bouton d'inscription */
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        input[type="submit"]:hover {
            background-color: #3e8e41;
        }

        /* Style des messages d'erreur */
        .error-message {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <form action="" method="POST">
        <label for="firstName">Prénom :</label>
        <input type="text" name="firstName" placeholder="John">
        <label for="lastName">Nom :</label>
        <input type="text" name="lastName" placeholder="Doe">
        <label for="email">Email :</label>
        <input type="text" name="email" placeholder="johndoe@example.com">
        <label for="password">Mot de passe :</label>
        <input type="text" name="password" placeholder="********">
        <input type="submit" value="Inscription">
    </form>
</body>

</html>