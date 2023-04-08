<?php
// Function to create database or connect a database
function dataBase($engine,  $host, $port, $username, $password, $dbname)
{
    $pdo = new PDO("$engine:host=$host:$port;", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    $stmt = $pdo->prepare(
        "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = :dbname"
    );

    $stmt->execute([
        ":dbname" => $dbname,
    ]);


    $db = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($db) > 0) {
        return connexionBDD($engine,  $host, $port, $username, $password, $dbname);
    } else {
        $stmt = $pdo->prepare(
            "CREATE DATABASE IF NOT EXISTS " . $dbname
        );

        $stmt->execute();
        $pdo = connexionBDD($engine,  $host, $port, $username, $password, $dbname);
        createEntity($pdo);
        return $pdo;
    }
}
// Function to connect your database
function connexionBDD($engine,  $host, $port, $username, $password, $dbname)
{
    $pdo = new PDO("$engine:host=$host:$port;dbname=$dbname", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    return $pdo;
}

// Function to createEntity
function createEntity($pdo)
{
    // Get content .sql
    $sql = file_get_contents('./db/php-work-schema.sql');
    // Delete commente of file
    $sql = preg_replace('/\-\-.*$/m', '', $sql);
    $sql = preg_replace('/\/\*.*?\*\//ms', '', $sql);
    $queries = explode(';', $sql);
    // execute all query
    foreach ($queries as $query) {
        if (!empty(trim($query))) {
            $stmt = $pdo->prepare($query);
            $stmt->execute();
        }
    }
    $sql = file_get_contents('./db/php-work-data.sql');
    $sql = preg_replace('/\-\-.*$/m', '', $sql);
    $sql = preg_replace('/\/\*.*?\*\//ms', '', $sql);
    $queries = explode(';', $sql);
    foreach ($queries as $query) {
        if (!empty(trim($query))) {
            $pdo->exec($query);
        }
    }
}

// function to register a user
function register($pdo)
{
    session_start();
    $erreur = null;
    $methode = filter_input(INPUT_SERVER, "REQUEST_METHOD");

    if ($methode == "POST") {
        $firstName = filter_input(INPUT_POST, "firstName");
        $lastName = filter_input(INPUT_POST, "lastName");
        $email = filter_input(INPUT_POST, "email");
        $password = filter_input(INPUT_POST, "password");
        $user = getUser($email, $pdo);


        if (isset($user["email"])) {
            $erreur = "Cette email a déja été utiliser, veuillez choisir une autre email !";
        } else {
            if (strlen($password) >= 8) {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare(
                    "INSERT INTO user (first_name, last_name, email, password) VALUES(:firstName, :lastName, :email, :pasword)"
                );

                $stmt->execute([
                    ":firstName" => $firstName,
                    ":lastName" => $lastName,
                    ":email" => $email,
                    ":pasword" => $hash,
                ]);
                $_SESSION["email"] = $email;
                header('Location: accueil.php?registered=' . true);

                exit();
            } else {
                $erreur = "Mot de passe trop court ! (8 min)";
            }
        }
    }
    return $erreur;
}

function getUser($email, $pdo)
{

    $stmt = $pdo->prepare(<<<SQL
        SELECT * from user
        where email = :email
    SQL);

    $stmt->execute([
        ":email" => $email
    ]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function login($pdo)
{
    session_start();
    $erreur = null;
    $methode = filter_input(INPUT_SERVER, "REQUEST_METHOD");

    if ($methode == "POST") {
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
        $user = getUser($email, $pdo);
        // verfier que l'email existe 
        if (isset($user["email"])) {
            $dbPassword = $user["password"];
            if (password_verify($password, $dbPassword)) {
                $_SESSION["email"] = $email;
                header('Location: acceuil.php?login=' . true);
                exit();
            } else {
                $erreur = "Le mail ou le mot de passe est incorrect !";
            }
        } else {
            $erreur = "Le mail ou le mot de passe est incorrect !";
        }
    }
    return $erreur;
}

function cutLink($pdo)
{
    $email = $_SESSION["email"];

    $methode = filter_input(INPUT_SERVER, "REQUEST_METHOD");

    if ($methode == "POST") {
        $lien = filter_input(INPUT_POST, "lien");
        $raccourci = filter_input(INPUT_POST, "raccourci");

        $user = getUser($email, $pdo);
        $stmt = $pdo->prepare(
            "INSERT INTO url (user_id, url, cut_url) VALUES(:userId, :url, :cut_url)"
        );

        $stmt->execute([
            ":userId" => $user["user_id"],
            ":url" => $lien,
            ":cut_url" => $raccourci,

        ]);
    }
}
