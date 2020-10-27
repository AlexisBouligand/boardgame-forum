<?php
function add_user(
    String $pseudo,
    String $email,
    String $password,
    String $birthdate,
    String $country,
    bool $profile_picture
) {
    global $bdd;
    try {
        // Créer une requête INSERT INTO pour insérer un étudiant
        $req = $bdd->prepare("INSERT INTO user (pseudonym, email, password, profile_picture, country, birthdate) VALUES (?, ?, ?, ?, ?, ?);");
        // Exécuter la requête
        if ($req->execute([$pseudo, $email, password_hash($password, PASSWORD_BCRYPT), $profile_picture ? 1 : 0, $country, $birthdate])) {
            return NULL;
        } else {
            return "Uh oh!";
        }
    } catch (Exception $exception) {
        return $exception;
    }
}
?>
