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
function register($firstName, $lastName, $email, $password)
{
    $erreur = null;
    $user = getUserWithEmail($email);

    if (isset($user)) {
        echo 'Deja';
        exit;
    } else {
        echo 'ok';
        exit;
    }

    // if (strlen($pseudo) >= 8) {

    //     if (strlen($password) >= 8) {
    //         $hash = password_hash($password, PASSWORD_DEFAULT);
    //         $data = json_decode(file_get_contents('data.json'), true);
    //         $user = [
    //             'pseudo' => $pseudo,
    //             'password' => $hash,
    //         ];
    //         $data[] = $user;
    //         file_put_contents('data.json', json_encode($data));
    //         mkdir('./dropbox/' . $pseudo, 0777, true);
    //         header('Location: connexion.php?registered=' . true);
    //         exit();
    //     } else {
    //         $erreur = "Mot de passe trop court ! (8 min)";
    //     }
    // } else {
    //     $erreur = "Pseudo trop court ! (8 min)";
    // }

    return $erreur;
}


function getUserWithEmail($email)
{
}
