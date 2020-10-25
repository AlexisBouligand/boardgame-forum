<?php
function add_user(
    String $pseudo,
    String $email,
    String $password,
    String $birthdate,
    String $country,
    String $profile_picture
) {
    global $bdd;
    try {
        // Créer une requête INSERT INTO pour insérer un étudiant
        $req = $bdd->prepare("INSERT INTO user (pseudonym, email, password, profile_picture, country, birthdate) VALUES (?, ?, ?, ?, ?, ?);");
        // Exécuter la requête
        $req->execute([$pseudo, $email, password_hash($password, PASSWORD_BCRYPT), $profile_picture, $country, $birthdate]);

        return NULL;
    } catch (Exception $exception) {
        return $exception;
    }
}
?>
