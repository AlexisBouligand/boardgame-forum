<?php
$pseudo = $_POST["pseudo"];
$email = $_POST["email"];
$password = $_POST["password"];
$birthdate = $_POST["birthdate"];
$country = $_POST["country"];
$profile_picture = $_POST["profile_picture"];

try {
    // Se connecter à la base de données
    $bdd = new PDO("mysql:host=localhost;dbname=boardgameforum;charset=utf8", "root", "");
    // Créer une requête INSERT INTO pour insérer un étudiant
    $req = $bdd->prepare("INSERT INTO user (pseudonym, email, password, profile_picture, country, birthdate) VALUES (?,?,?,?,?,?);");
    // Exécuter la requête
    $req->execute([$pseudo, $email, password_hash($password,PASSWORD_BCRYPT), $profile_picture, $country, $birthdate]);
} catch (Exception $exception) {
    echo $exception;
}

header("Location: ../html/index.php");
?>
